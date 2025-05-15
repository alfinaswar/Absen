<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\QrcodeToken;
use App\Models\ShiftKerja;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $countKaryawan = User::count();
        $tanggalHariIni = now()->format('Y-m-d');
        $countOntime = Absensi::where('waktu_absen', '<=', '08:00:00')->whereDate('created_at', $tanggalHariIni)->count();
        $CountIzin = 0;
        $total = Absensi::whereDate('created_at', $tanggalHariIni)->count();
        $AbsenKu = Absensi::where('user_id', auth()->user()->id)->whereDate('tanggal', $tanggalHariIni)->first();
        $CekMasuk = Absensi::where('user_id', auth()->user()->id)->where('jenis_absen', '=', 'Masuk')->whereDate('tanggal', $tanggalHariIni)->first();
        $CekKeluar = Absensi::where('user_id', auth()->user()->id)->where('jenis_absen', '=', 'Keluar')->whereDate('tanggal', $tanggalHariIni)->first();
        $dataKaryawan = User::with('getPerusahaan')->where('id', auth()->user()->id)->first();
        $shift = ShiftKerja::get();


        return view('home', compact('AbsenKu', 'countKaryawan', 'countOntime', 'total', 'CountIzin', 'dataKaryawan', 'shift', 'CekMasuk', 'CekKeluar'));
    }
}
