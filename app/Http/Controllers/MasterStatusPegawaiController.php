<?php

namespace App\Http\Controllers;

use App\Models\MasterStatusPegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterStatusPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterStatusPegawai::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('master-status-pegawai.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>

                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'Kontak'])
                ->make(true);
        }
        return view('master.status-pegawai.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.status-pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        MasterStatusPegawai::create($data);
        return redirect()->route('master-status-pegawai.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterStatusPegawai $masterStatusPegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = MasterStatusPegawai::find($id);
        return view('master.status-pegawai.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        MasterStatusPegawai::find($id)->update($data);
        return redirect()->route('master-status-pegawai.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = MasterStatusPegawai::find($id);
        $data->delete();
        return redirect()->route('master-status-pegawai.index')->with('success', 'Data berhasil dihapus.');
    }
}

