<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\QrcodeToken;
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
        $countOntime = Absensi::where('jam_masuk', '<=', '08:00:00')->whereDate('created_at', $tanggalHariIni)->count();
        $CountIzin = Absensi::where('status', 'CUTI')->whereDate('created_at', $tanggalHariIni)->count();
        $total = Absensi::whereDate('created_at', $tanggalHariIni)->count();
        $AbsenKu = Absensi::where('user_id', auth()->user()->id)->whereDate('tanggal', $tanggalHariIni)->first();
        $dataKaryawan = User::with('getPerusahaan')->where('id', auth()->user()->id)->first();

        $token = Str::uuid();  // token unik
        QrcodeToken::create([
            'token' => $token,
            'expires_at' => Carbon::now()->addMinutes(1),  // berlaku 1 menit
        ]);

        $qrCodes = QrCode::size(200)->style('square')->generate(route('absen.store', ['token' => $token]));
        return view('home', compact('qrCodes', 'AbsenKu', 'countKaryawan', 'countOntime', 'total', 'CountIzin', 'dataKaryawan'));
    }
}
