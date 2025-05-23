<?php

namespace App\Http\Controllers;

use App\Exports\AbsenExport;
use App\Models\Absensi;
use App\Models\MasterPerusahaan;
use App\Models\QrcodeToken;
use App\Models\ShiftKerja;
use App\Models\ShiftKerjaDetail;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    /**
     * Menampilkan daftar absensi.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('absensis as masuk')
                ->select(
                    'masuk.id as id_masuk',
                    'masuk.user_id',
                    'users.name as nama_karyawan',
                    'masuk.tanggal',
                    'masuk.waktu_absen as jam_masuk',
                    'masuk.jenis_absen as jenis_absen_masuk',
                    'masuk.ontime as ontime_masuk',
                    'masuk.keterangan as keterangan_masuk',
                    'masuk.approval as approval_masuk',
                    'masuk.file_pendukung as file_pendukung_masuk',
                    'masuk.selfie_photo as selfie_photo_masuk',
                    'masuk.lokasi as lokasi_masuk',
                    'masuk.latitude as latitude_masuk',
                    'masuk.longitude as longitude_masuk',
                    'masuk.ip_address as ip_address_masuk',
                    'keluar.id as id_keluar',
                    'keluar.waktu_absen as jam_keluar',
                    'keluar.jenis_absen as jenis_absen_keluar',
                    'keluar.ontime as ontime_keluar',
                    'keluar.keterangan as keterangan_keluar',
                    'keluar.approval as approval_keluar',
                    'keluar.file_pendukung as file_pendukung_keluar',
                    'keluar.selfie_photo as selfie_photo_keluar',
                    'keluar.lokasi as lokasi_keluar',
                    'keluar.latitude as latitude_keluar',
                    'keluar.longitude as longitude_keluar',
                    'keluar.ip_address as ip_address_keluar'
                )
                ->join('users', 'masuk.user_id', '=', 'users.id')
                ->leftJoin('absensis as keluar', function ($join) {
                    $join->on('masuk.user_id', '=', 'keluar.user_id')
                        ->on('masuk.tanggal', '=', 'keluar.tanggal')
                        ->where('keluar.jenis_absen', '=', 'Keluar');
                })
                ->where('masuk.jenis_absen', 'Masuk')
                // Filter tanggal jika ada
                ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                    $query->whereBetween('masuk.tanggal', [$request->start_date, $request->end_date]);
                })
                // Filter karyawan jika ada
                ->when($request->filled('karyawan'), function ($query) use ($request) {
                    $query->where('masuk.user_id', $request->karyawan);
                })
                // Filter shift jika ada
                ->when($request->filled('shift') && Schema::hasColumn('absensis', 'shift_id'), function ($query) use ($request) {
                    $query->where('masuk.shift_id', $request->shift);
                })
                ->orderBy('masuk.tanggal', 'desc')
                ->orderBy('masuk.user_id');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="btn-group" role="group">';

                    // Edit button (menggunakan id masuk sebagai referensi)
                    $actionBtn .= '<a href="' . route('absen.edit', $row->id_masuk) . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>';

                    // Delete button
                    $actionBtn .= '<a href="javascript:void(0)" data-id="' . $row->id_masuk . '" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>';

                    // ACC Cuti button jika diperlukan (disesuaikan dengan logika Anda)
                    if (isset($row->jenis_absen_masuk) && $row->jenis_absen_masuk == 'Cuti') {
                        $actionBtn .= '<a href="javascript:void(0)" data-id="' . $row->id_masuk . '" class="acc-cuti btn btn-success btn-sm"><i class="fas fa-check"></i> ACC Cuti</a>';
                    }

                    $actionBtn .= '</div>';
                    return $actionBtn;
                })
                ->addColumn('status_masuk', function ($row) {
                    if ($row->ontime_masuk == 'Y') {
                        return '<span class="badge bg-green text-green-fg">Tepat Waktu</span>';
                    } else {
                        return '<span class="badge bg-red text-red-fg">Terlambat</span>';
                    }
                })
                // ->addColumn('status_keluar', function ($row) {
                //     if (!isset($row->jam_keluar)) {
                //         return '<span class="badge bg-red text-red-fg">Belum Absen</span>';
                //     } elseif ($row->ontime_keluar == 'Y') {
                //         return '<span class="badge bg-green text-green-fg">Tepat Waktu</span>';
                //     } else {
                //         return '<span class="badge bg-red text-red-fg">Terlambat</span>';
                //     }
                // })
                ->addColumn('foto_masuk', function ($row) {
                    $foto = $row->selfie_photo_masuk;
                    $lokasi = $row->lokasi_masuk;

                    if ($foto) {
                        return '<button class="btn btn-sm btn-info preview-foto"
                        data-foto="' . $foto . '"
                        data-lokasi="' . e($lokasi) . '"
                        data-title="Foto Masuk">
                    <i class="fas fa-eye"></i> Preview
                </button>';
                    }

                    return '<span class="badge bg-secondary text-dark">Tidak Ada Foto</span>';
                })
                ->addColumn('foto_keluar', function ($row) {
                    $foto = $row->selfie_photo_keluar;
                    $lokasi = $row->lokasi_keluar;

                    if ($foto) {
                        return '<button class="btn btn-sm btn-info preview-foto"
                        data-foto="' . $foto . '"
                        data-lokasi="' . e($lokasi) . '"
                        data-title="Foto Keluar">
                    <i class="fas fa-eye"></i> Preview
                </button>';
                    }

                    return '<span class="badge bg-secondary text-dark">Tidak Ada Foto</span>';
                })


                ->editColumn('tanggal', function ($row) {
                    return Carbon::parse($row->tanggal)->format('d/m/Y');
                })
                ->editColumn('jam_masuk', function ($row) {
                    return $row->jam_masuk ?? '-';
                })
                ->editColumn('jam_keluar', function ($row) {
                    return $row->jam_keluar ?? '-';
                })
                ->rawColumns(['action', 'status_masuk', 'foto_masuk', 'foto_keluar'])
                ->make(true);
        }

        // Load data untuk filter
        $users = User::orderBy('name', 'ASC')->get();
        $shifts = ShiftKerja::all();
        $company = MasterPerusahaan::orderBy('Nama')->get();

        return view('absensi.index', compact('users', 'shifts', 'company'));
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
            $data = DB::table('absensis as masuk')
                ->select(
                    'masuk.id as id_masuk',
                    'masuk.user_id',
                    'users.name as nama_karyawan',
                    'masuk.tanggal',
                    'masuk.waktu_absen as jam_masuk',
                    'masuk.jenis_absen as jenis_absen_masuk',
                    'masuk.ontime as ontime_masuk',
                    'masuk.keterangan as keterangan_masuk',
                    'masuk.approval as approval_masuk',
                    'masuk.file_pendukung as file_pendukung_masuk',
                    'masuk.selfie_photo as selfie_photo_masuk',
                    'masuk.lokasi as lokasi_masuk',
                    'masuk.latitude as latitude_masuk',
                    'masuk.longitude as longitude_masuk',
                    'masuk.ip_address as ip_address_masuk',
                    'keluar.id as id_keluar',
                    'keluar.waktu_absen as jam_keluar',
                    'keluar.jenis_absen as jenis_absen_keluar',
                    'keluar.ontime as ontime_keluar',
                    'keluar.keterangan as keterangan_keluar',
                    'keluar.approval as approval_keluar',
                    'keluar.file_pendukung as file_pendukung_keluar',
                    'keluar.selfie_photo as selfie_photo_keluar',
                    'keluar.lokasi as lokasi_keluar',
                    'keluar.latitude as latitude_keluar',
                    'keluar.longitude as longitude_keluar',
                    'keluar.ip_address as ip_address_keluar'
                )
                ->join('users', 'masuk.user_id', '=', 'users.id')
                ->leftJoin('absensis as keluar', function ($join) {
                    $join->on('masuk.user_id', '=', 'keluar.user_id')
                        ->on('masuk.tanggal', '=', 'keluar.tanggal')
                        ->where('keluar.jenis_absen', '=', 'Keluar');
                })
                ->where('masuk.jenis_absen', 'Masuk')
                ->where('masuk.user_id', auth()->user()->id)
                ->orderBy('masuk.tanggal', 'desc')
                ->orderBy('masuk.user_id');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status_masuk', function ($row) {
                    if ($row->ontime_masuk == 'Y') {
                        return '<span class="badge bg-green text-green-fg">Tepat Waktu</span>';
                    } else {
                        return '<span class="badge bg-red text-red-fg">Terlambat</span>';
                    }
                })
                ->addColumn('foto_masuk', function ($row) {
                    $foto = $row->selfie_photo_masuk;
                    $lokasi = $row->lokasi_masuk;

                    if ($foto) {
                        return '<button class="btn btn-sm btn-info preview-foto"
                        data-foto="' . $foto . '"
                        data-lokasi="' . e($lokasi) . '"
                        data-title="Foto Masuk">
                    <i class="fas fa-eye"></i> Preview
                </button>';
                    }

                    return '<span class="badge bg-secondary text-dark">Tidak Ada Foto</span>';
                })
                ->addColumn('foto_keluar', function ($row) {
                    $foto = $row->selfie_photo_keluar;
                    $lokasi = $row->lokasi_keluar;

                    if ($foto) {
                        return '<button class="btn btn-sm btn-info preview-foto"
                        data-foto="' . $foto . '"
                        data-lokasi="' . e($lokasi) . '"
                        data-title="Foto Keluar">
                    <i class="fas fa-eye"></i> Preview
                </button>';
                    }

                    return '<span class="badge bg-secondary text-dark">Tidak Ada Foto</span>';
                })

                ->editColumn('tanggal', function ($row) {
                    return \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y');
                })
                ->editColumn('jam_masuk', function ($row) {
                    return $row->jam_masuk ?? '-';
                })
                ->editColumn('jam_keluar', function ($row) {
                    return $row->jam_keluar ?? '-';
                })
                ->rawColumns(['status_masuk', 'foto_masuk', 'foto_keluar'])
                ->make(true);
        }

        return view('absensi.history');
    }


    /**
     * Menyimpan absensi baru.
     */
    // public function store(Request $request)
    // {
    //     dd($request->all());
    //     $UserData = User::with('getShift')->where('id', auth()->user()->id)->first();
    //     $waktu_absen = '';
    //     $shift = ShiftKerja::find($request->shift_id);
    //     if ($request->jenis_absen == 'Masuk') {
    //         $waktu_absen = $shift->jam_masuk->format('H:i:s');
    //     } elseif ($request->jenis_absen == 'Keluar') {
    //         $waktu_absen = $shift->jam_keluar->format('H:i:s');
    //     }

    //     if ($request->hasFile('file_pendukung')) {
    //         $file = $request->file('file_pendukung');
    //         $filename = time() . '.' . $file->getClientOriginalExtension();
    //         $file->move(public_path('uploads/absensi'), $filename);
    //         $data['file_pendukung'] = $filename;
    //     }
    //     if (now()->format('H:i:s') < $waktu_absen) {
    //         $ontime = 'Y';
    //     } else {
    //         $ontime = 'N';
    //     }
    //     $image = explode('base64,', $request->selfie_photo);
    //     $image = end($image);
    //     $image = str_replace(' ', '+', $image);
    //     $file = "A" . uniqid() . '.png';
    //     Storage::disk('public/foto_absen')->put($file, base64_decode($image));

    //     $data['shift_id'] = $request->shift_id;
    //     $data['tanggal'] = now()->format('Y-m-d');
    //     $data['waktu_absen'] = now()->format('H:i:s');
    //     $data['jenis_absen'] = $request->tipe_absen;
    //     $data['ontime'] = $ontime;
    //     $data['keterangan'] = $request->keterangan ?? null;
    //     $data['selfie_photo'] = $request->selfie_photo;
    //     $data['foto_karyawan'] = $file;
    //     $data['ip_address'] = $request->ip();
    //     $data['lokasi'] = $request->lokasi ?? null;
    //     $data['latitude'] = $request->latitude ?? null;
    //     $data['longitude'] = $request->longitude ?? null;
    //     $data['user_id'] = auth()->user()->id;
    //     Absensi::create($data);

    //     return view('absensi.sukses');
    // }
    public function store(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();
        $now = Carbon::now();

        // Check existing attendance for today
        $todayAttendances = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->get();

        if ($request->type === 'Masuk') {
            // Check if already checked in today
            $hasCheckin = $todayAttendances->where('jenis_absen', 'Masuk')->first();
            if ($hasCheckin) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah melakukan check-in hari ini.'
                ], 400);
            }

            // Get shift info
            $shift = ShiftKerja::find($request->shift_id);
            if (!$shift) {
                return response()->json([
                    'success' => false,
                    'message' => 'Shift tidak ditemukan.'
                ], 404);
            }

            // Check if within allowed time (example: 30 minutes before shift start)
            $shiftStart = Carbon::createFromFormat('H:i:s', $shift->jam_masuk);
            $allowedCheckinTime = $shiftStart->subMinutes(30);

            // Determine if on time or late
            $shiftStartOriginal = Carbon::createFromFormat('H:i:s', $shift->jam_masuk);
            $ontime = $now->format('H:i:s') <= $shiftStartOriginal->format('H:i:s') ? 'Y' : 'N';

        } else { // checkout
            // Check if has checked in today
            $hasCheckin = $todayAttendances->where('jenis_absen', 'Masuk')->first();
            if (!$hasCheckin) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda belum melakukan check-in hari ini.'
                ], 400);
            }

            // Check if already checked out
            $hasCheckout = $todayAttendances->where('jenis_absen', 'Keluar')->first();
            if ($hasCheckout) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah melakukan check-out hari ini.'
                ], 400);
            }

            $ontime = 'Y'; // Checkout is always considered on time
        }

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = 'absen_' . $user->id . '_' . $request->type . '_' . $now->format('Y-m-d_H-i-s') . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('attendance_photos', $fileName, 'public');
        }

        // Get IP Address
        $ipAddress = $request->ip();

        // Create new attendance record
        $attendance = Absensi::create([
            'user_id' => $user->id,
            'shift_id' => $request->shift_id ?? null,
            'tanggal' => $today,
            'waktu_absen' => $now,
            'jenis_absen' => $request->type,
            'ontime' => $ontime,
            'keterangan' => null,
            'file_pendukung' => null,
            'selfie_photo' => $photoPath,
            'foto_karyawan' => $photoPath, // Same as selfie_photo or different logic
            'lokasi' => $request->location_name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'ip_addres' => $ipAddress, // Note: keeping your column name as is
        ]);

        // Prepare response message
        $timeString = $now->format('H:i:s');
        $statusText = $ontime ? 'tepat waktu' : 'terlambat';

        if ($request->type === 'Masuk') {
            $message = "Check-in berhasil dicatat pada {$timeString} ({$statusText})";
        } else {
            $message = "Check-out berhasil dicatat pada {$timeString}";
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => [
                'id' => $attendance->id,
                'type' => $request->type,
                'time' => $timeString,
                'date' => $today->format('Y-m-d'),
                'location' => $request->location_name,
                'ontime' => $ontime,
                'status' => $statusText
            ]
        ]);
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
    public function PageAbsen()
    {
        $user = User::with([
            'getAbsensi' => function ($query) {
                $query->whereDate('tanggal', now()->format('Y-m-d'));
            },
            'getShift',
            'getPerusahaan'
        ])->find(auth()->user()->id);
        // dd($user);
        $shift = ShiftKerja::get();
        return view('karyawan.absen.index', compact('user', 'shift'));
    }

    /**
     * Mengunduh laporan absensi dalam format Excel.
     */
    public function download(Request $request)
    {
        $data = DB::table('absensis as masuk')
            ->select(
                'masuk.id as id_masuk',
                'masuk.user_id',
                'shift_kerjas.nama_shift as NamaShifitMasuk',
                'users.name as nama_karyawan',
                'masuk.tanggal',
                'masuk.waktu_absen as jam_masuk',
                'masuk.jenis_absen as jenis_absen_masuk',
                'masuk.ontime as ontime_masuk',
                'masuk.keterangan as keterangan_masuk',
                'masuk.approval as approval_masuk',
                'masuk.file_pendukung as file_pendukung_masuk',
                'masuk.selfie_photo as selfie_photo_masuk',
                'masuk.lokasi as lokasi_masuk',
                'masuk.latitude as latitude_masuk',
                'masuk.longitude as longitude_mas_masuk',
                'masuk.ip_address as ip_address_masuk',
                'keluar.id as id_keluar',
                'keluar.shift_id as NamaShifitKeluar',
                'keluar.waktu_absen as jam_keluar',
                'keluar.jenis_absen as jenis_absen_keluar',
                'keluar.ontime as ontime_keluar',
                'keluar.keterangan as keterangan_keluar',
                'keluar.approval as approval_keluar',
                'keluar.file_pendukung as file_pendukung_keluar',
                'keluar.selfie_photo as selfie_photo_keluar',
                'keluar.lokasi as lokasi_keluar',
                'keluar.latitude as latitude_keluar',
                'keluar.longitude as longitude_keluar',
                'keluar.ip_address as ip_address_keluar'
            )->join('users', 'masuk.user_id', '=', 'users.id')
            ->join('shift_kerjas', 'masuk.shift_id', '=', 'shift_kerjas.id')
            ->leftJoin('absensis as keluar', function ($join) {
                $join->on('masuk.user_id', '=', 'keluar.user_id')
                    ->on('masuk.tanggal', '=', 'keluar.tanggal')
                    ->where('keluar.jenis_absen', '=', 'Keluar');
            })
            ->where('masuk.jenis_absen', 'Masuk')
            ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                $query->whereBetween('masuk.tanggal', [$request->start_date, $request->end_date]);
            })
            ->when($request->filled('karyawan'), function ($query) use ($request) {
                $query->where('masuk.user_id', $request->karyawan);
            })
            ->when($request->filled('shift') && Schema::hasColumn('absensis', 'shift_id'), function ($query) use ($request) {
                $query->where('masuk.shift_id', $request->shift);
            })
            ->orderBy('masuk.tanggal', 'desc')
            ->orderBy('masuk.user_id')
            ->get();

        // Hapus dd() yang tidak diperlukan

        $filename = 'Laporan_Absensi';
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $filename .= '_' . $request->start_date . '_' . $request->end_date;
        } else {
            $filename .= '_' . date('Y-m-d');
        }

        if ($request->jenis_laporan == 'excel') {
            return Excel::download(new AbsenExport($data, $request), $filename . '.xlsx');
        } elseif ($request->jenis_laporan == 'pdf') {
            $pdf = Pdf::loadView('laporan.absen.index', compact('data', 'request'));
            return $pdf->download($filename . '.pdf');
        } else {
            return redirect()->back()->with('error', 'Format laporan tidak valid.');
        }
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
            'ontime' => 'required|in:Y,N',
        ]);

        $absensi = Absensi::findOrFail($id);
        // dd($absensi);
        $absensi->update([
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
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
