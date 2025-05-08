<?php

namespace App\Http\Controllers;

use App\Models\ShiftKerja;
use App\Models\ShiftKerjaDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ShiftKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ShiftKerja::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('shift.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('shift.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawan = User::get();
        return view('shift.create', compact('karyawan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ShiftKerja::create([
            'nama_shift' => $request->nama_shift,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
        ]);


        return redirect()->route('shift.index')->with('success', 'Shift Kerja Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShiftKerja $shiftKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $karyawan = User::get();
        $data = ShiftKerja::with([
            'DetailShiftKerja' => function ($query) {
                $query->with('getUser');
            }
        ])->find($id);
        // dd($data);
        return view('shift.edit', compact('data', 'karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $shiftKerja = ShiftKerja::find($id);
        $shiftKerja->update([
            'nama_shift' => $request->nama_shift,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
        ]);

        ShiftKerjaDetail::where('id_shift', $shiftKerja->id)->delete();

        foreach ($request->id_user as $key => $karyawan) {
            ShiftKerjaDetail::create([
                'id_shift' => $shiftKerja->id,
                'id_user' => $request->id_user[$key],
            ]);
        }

        return redirect()->route('shift.index')->with('success', 'Shift Kerja Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $Shift = ShiftKerja::find($id);
        $detail = ShiftKerjaDetail::where('id_shift', $id)->delete();
        if ($Shift) {
            $Shift->delete();
            return response()->json(['message' => 'Shift berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Shift tidak ditemukan'], 404);
        }
    }
}
