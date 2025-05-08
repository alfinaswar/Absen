<?php

namespace App\Http\Controllers;

use App\Models\MasterPerusahaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterPerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterPerusahaan::with('getKota', 'getProvinsi')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('mp.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>

                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</a>';
                    return $btn;
                })
                ->addColumn('Kontak', function ($row) {
                    $Kontak = $row->Telepon . '<hr>' . $row->Email;
                    return $Kontak;
                })
                ->rawColumns(['action', 'Kontak'])
                ->make(true);
        }
        return view('master.perusahaan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.perusahaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        MasterPerusahaan::create($data);

        return redirect()->route('mp.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterPerusahaan $masterPerusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = MasterPerusahaan::findOrFail($id);
        return view('master.perusahaan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = MasterPerusahaan::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('mp.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = MasterPerusahaan::with('getDataKaryawan')->find($id);
        if ($data->getDataKaryawan->count() > 0) {
            return response()->json(['error' => 'Data tidak bisa dihapus, karena sedang digunakan.']);
        } else {
            $data->delete();
        }

        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
