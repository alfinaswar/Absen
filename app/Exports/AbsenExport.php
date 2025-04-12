<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbsenExport implements FromView
{
    public function view(): View
    {
        return view('laporan.absensi', [
            'absensi' => Absensi::with('user')->get()
        ]);
    }
}
