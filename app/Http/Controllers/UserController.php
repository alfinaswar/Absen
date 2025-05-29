<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AturPoin;
use App\Models\Avatar;
use App\Models\FotoProfil;
use App\Models\Lencana;
use App\Models\MasterPerusahaan;
use App\Models\MasterStatusPegawai;
use App\Models\Poin;
use App\Models\ShiftKerja;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('users.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Delete</a>';
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
        $roles = Role::pluck('name', 'name')->all();
        return view('users.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::all();
        $status = MasterStatusPegawai::all();
        $shift = ShiftKerja::all();
        $perusahaan = MasterPerusahaan::orderBy('Nama', 'ASC')->get();
        return view('users.create', compact('roles', 'status', 'shift', 'perusahaan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success', 'User Berhasil Dibuat');
    }

    public function edit($id): View
    {
        $user = User::find($id);
        // dd($user);
        $roles = Role::all();
        $status = MasterStatusPegawai::all();
        $shift = ShiftKerja::all();
        $perusahaan = MasterPerusahaan::orderBy('Nama', 'ASC')->get();

        return view('users.edit', compact('roles', 'status', 'shift', 'perusahaan', 'user'));
    }

    public function UpdateProfile($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit-profile', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi bisa ditambahkan di sini kalau diperlukan
        $input = $request->all();

        // Enkripsi password jika diisi
        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        } else {
            unset($input['password']);
        }
        $user = User::findOrFail($id);
        $user->update($input);

        // Update roles
        if ($request->has('role')) {
            $user->syncRoles($request->input('role'));
        }

        return redirect()->route('users.index')->with('success', 'Data Karyawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'Pengguna berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }
    }
}
