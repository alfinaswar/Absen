<?php

namespace App\Http\Controllers;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
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
        $countOntime = Absensi::where('jam_masuk', '<=', '08:00:00')->whereDate('created_at', now()->format('Y-m-d'))->count();
        $CountIzin = Absensi::where('status', 'CUTI')->whereDate('created_at', now()->format('Y-m-d'))->count();
        $total = Absensi::whereDate('created_at', now()->format('Y-m-d'))->count();
        $AbsenKu = Absensi::where('user_id', auth()->user()->id)->whereDate('tanggal', now()->format('Y-m-d'))->first();
        $qrCodes = QrCode::size(200)->style('square')->generate(route('absen.store'));
        return view('home', compact('qrCodes', 'AbsenKu', 'countKaryawan', 'countOntime', 'total', 'CountIzin'));
    }
}
