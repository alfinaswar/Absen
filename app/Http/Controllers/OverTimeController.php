<?php

namespace App\Http\Controllers;

use App\Models\OverTime;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OverTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = OverTime::with('getUser', 'getPerusahaan')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Delete</a>
                    <a href="' . route('ot.acc', $row->id) . '" class="acc btn btn-success btn-sm">Acc Lembur</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('overt-time.index');
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
        //
    }

    public function storeLembur(Request $request, $id)
    {
        $data = OverTime::find($id);
        if ($data) {
            $data->Status = 'Diterima';
            $data->save();
            return redirect()->back()->with('success', 'Lembur Berhasil Di Acc');
        } else {
            return redirect()->back()->with('error', 'Lembur tidak ditemukan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OverTime $overTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OverTime $overTime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OverTime $overTime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $Shift = OverTime::find($id);
        if ($Shift) {
            $Shift->delete();
            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
