<?php

namespace App\Http\Controllers;

use App\Exports\AbsenExport;
use App\Models\Absensi;
use App\Models\QrcodeToken;
use App\Models\ShiftKerjaDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AbsensiController extends Controller
{
    /**
     * Menampilkan daftar absensi.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Absensi::with('user')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Tombol default
                    $btn = '<a href="' . route('absen.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>
                        <a href="javascript:void(0)"  data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a> ';
                    if ($row->status == 'CUTI') {
                        $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="acc-cuti btn btn-success btn-sm">ACC Cuti</a>';
                    }

                    return $btn;
                })
                ->addColumn('ontime', function ($row) {
                    if ($row->ontime == 'Y') {
                        $ontime = '<span class="badge badge-success">Ontime</span>';
                    } else {
                        $ontime = '<span class="badge badge-danger">Terlambat</span>';
                    }
                    return $ontime;
                })
                ->rawColumns(['action', 'ontime'])
                ->make(true);
        }
        return view('absensi.index');
    }

    /**
     * Mengubah status cuti menjadi di-ACC.
     */
    public function accCuti(Request $request)
    {
        $absensi = Absensi::findOrFail($request->id);

        if ($absensi->status == 'CUTI') {
            $absensi->Approval = 'Y';
            $absensi->save();

            return response()->json(['message' => 'Cuti berhasil di-ACC.']);
        }

        return response()->json(['message' => 'Data tidak valid atau bukan status CUTI.'], 400);
    }

    /**
     * Menampilkan riwayat absensi.
     */
    public function history(Request $request)
    {
        if ($request->ajax()) {
            $data = Absensi::with('user')
                ->where('user_id', auth()->user()->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('ontime', function ($row) {
                    if ($row->ontime == 'Y') {
                        $ontime = '<span class="badge badge-success">Ontime</span>';
                    } else {
                        $ontime = '<span class="badge badge-danger">Terlambat</span>';
                    }
                    return $ontime;
                })
                ->rawColumns(['ontime'])
                ->make(true);
        }
        return view('absensi.history');
    }

    /**
     * Menyimpan absensi baru.
     */
    public function store(Request $request, $token)
    {
        // Mencari token QR yang sesuai dan belum digunakan
        $qr = QrcodeToken::where('token', $token)
            ->where('used', false)
            ->where('expires_at', '>=', now())
            ->first();

        // Jika token QR tidak ditemukan atau sudah kadaluarsa, maka absensi gagal
        if (!$qr) {
            return view('absensi.absen-gagal');
        }

        // Mengecek apakah user sudah melakukan absensi hari ini
        $cek = Absensi::where('user_id', auth()->user()->id)
            ->whereDate('tanggal', now()->format('Y-m-d'))
            ->first();

        // Jika user sudah melakukan absensi masuk dan belum melakukan absensi pulang, maka update jam keluar
        if ($cek) {
            if ($cek->jam_masuk && !$cek->jam_keluar) {
                $cek->update([
                    'jam_keluar' => now()->format('H:i:s'),
                    'JenisAbsen' => 'Pulang'
                ]);
                return view('absensi.sukses');
            }
            // Jika user sudah melakukan absensi masuk dan pulang, maka tidak perlu absensi lagi
            return view('absensi.sudah-absen');
        }

        // Mengecek detail shift kerja untuk menentukan keterlambatan
        $cekshift = ShiftKerjaDetail::with([
            'getNamaShift' => function ($query) {
                $query->whereDate('tanggal', now()->format('Y-m-d'));
            }
        ])->where('id_user', auth()->user()->id)->first();
        // Jika detail shift kerja tidak ditemukan, maka shift belum dibuat
        if (!$qr) {
            return view('absensi.shift-belum-dibuat');
        }
        // Menentukan apakah user datang ontime atau tidak berdasarkan jam masuk shift
        $ontime = now()->format('H:i:s') < $cekshift->getNamaShift->jam_masuk ? 'Y' : 'N';

        // Membuat absensi baru untuk user
        Absensi::create([
            'tanggal' => now()->format('Y-m-d'),
            'jam_masuk' => now()->format('H:i:s'),
            'jam_keluar' => null,
            'status' => 'HADIR',
            'ontime' => $ontime,
            'keterangan' => $request->keterangan,
            'user_id' => auth()->user()->id,
            'ip_address' => $request->ip(),
            'JenisAbsen' => 'Masuk'
        ]);

        // Menandai token QR sebagai sudah digunakan
        $qr->used = true;
        $qr->save();

        // Menampilkan view sukses setelah absensi berhasil
        return view('absensi.sukses');
    }

    /**
     * Menyimpan absensi cuti.
     */
    public function Cutistore(Request $request)
    {
        $cek = Absensi::where('user_id', auth()->user()->id)
            ->whereDate('tanggal', now()->format('Y-m-d'))
            ->first();
        if (now()->format('H:i:s') < '08:00:00') {
            $ontime = 'Y';
        } else {
            $ontime = 'N';
        }
        if ($cek) {
            return redirect()->back()->with('error', 'Anda Sudah Absen Hari Ini');
        }
        $data = $request->all();
        $data['tanggal'] = now()->format('Y-m-d');
        $data['jam_masuk'] = now()->format('H:i:s');
        $data['jam_keluar'] = null;
        $data['status'] = 'CUTI';
        $data['Approval'] = 'N';
        $data['ontime'] = $ontime;
        $data['keterangan'] = $request->keterangan;
        $data['user_id'] = auth()->user()->id;
        $data['ip_address'] = $request->ip();
        Absensi::create($data);
        return redirect()->back()->with('success', 'Absensi Berhasil Ditambahkan');
    }

    /**
     * Menampilkan detail absensi.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Mengunduh laporan absensi dalam format Excel.
     */
    public function downloadExcel(Request $request)
    {
        return Excel::download(new AbsenExport, 'laporan_absensi.xlsx');
    }

    /**
     * Menampilkan form edit absensi.
     */
    public function edit($id)
    {
        $data = Absensi::find($id);
        return view('absensi.edit', compact('data'));
    }

    /**
     * Memperbarui absensi.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_keluar' => 'nullable',
            'status' => 'required',
            'ontime' => 'required|in:Y,N',
        ]);

        $absensi = Absensi::findOrFail($id);
        // dd($absensi);
        $absensi->update([
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'status' => $request->status,
            'ontime' => $request->ontime,
        ]);

        return redirect()->route('absen.index')->with('success', 'Data absensi berhasil diperbarui.');
    }

    /**
     * Menghapus absensi.
     */
    public function destroy($id)
    {
        $absensi = Absensi::find($id);
        $absensi->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }
}
