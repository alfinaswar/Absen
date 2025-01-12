<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Absensi::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Default buttons
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
     * Show the form for creating a new resource.
     */
    public function history(Request $request)
    {
        if ($request->ajax()) {
            $data = Absensi::where('user_id', auth()->user()->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year);

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cek = Absensi::where('user_id', auth()->user()->id)
            ->whereDate('tanggal', now()->format('Y-m-d'))
            ->first();
        if (now()->format('H:i:s') > '08:00:00') {
            $ontime = 'Y';
        } else {
            $ontime = 'N';
        }
        if ($cek) {
            return redirect()->back()->with('error', 'Anda Sudah Absen Hari Ini');
        }
        $data = [];
        $data['tanggal'] = now()->format('Y-m-d');
        $data['jam_masuk'] = now()->format('H:i:s');
        $data['jam_keluar'] = null;
        $data['status'] = 'HADIR';
        $data['ontime'] = $ontime;
        $data['keterangan'] = $request->keterangan;
        $data['user_id'] = auth()->user()->id;
        // dd($data);
        Absensi::create($data);
        return redirect()->back()->with('success', 'Absensi Berhasil Ditambahkan');
    }

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

        Absensi::create($data);
        return redirect()->back()->with('success', 'Absensi Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    public function downloadPDF(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $absenData = Absensi::with('user')
            ->whereBetween('tanggal', [$request->start_date, $request->end_date])
            ->orderBy('tanggal', 'asc')
            ->get();
        $pdf = Pdf::loadView('laporan.absensi', ['absenData' => $absenData, 'request' => $request]);
        $fileName = 'Laporan_Absensi_' . $request->start_date . '_to_' . $request->end_date . '.pdf';
        return $pdf->download($fileName);
    }

    public function edit($id)
    {
        $data = Absensi::find($id);
        return view('absensi.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $absensi = Absensi::find($id);
        $absensi->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }
}
