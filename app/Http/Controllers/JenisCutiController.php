<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\JenisCuti;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JenisCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JenisCuti::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('cuti.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('master-cuti.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master-cuti.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        JenisCuti::create($data);
        return redirect()->route('cuti.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisCuti $jenisCuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = JenisCuti::find($id);
        return view('master-cuti.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = JenisCuti::find($id);
        JenisCuti::update($data);
        return redirect()->route('cuti.index')->with('success', 'Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $Cuti = JenisCuti::find($id);
        if ($Cuti) {
            $Cuti->delete();
            return response()->json(['message' => 'Shift berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Shift tidak ditemukan'], 404);
        }
    }
}
