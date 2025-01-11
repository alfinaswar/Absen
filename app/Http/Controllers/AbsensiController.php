<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
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
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $data['status'] = 'absen';
        $data['ontime'] = $ontime;
        $data['keterangan'] = $request->keterangan;
        $data['user_id'] = auth()->user()->id;
        // dd($data);
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
