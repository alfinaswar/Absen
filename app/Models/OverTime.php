<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverTime extends Model
{
    use HasFactory;

    protected $table = 'over_times';

    protected $guarded = ['id'];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'NamaKaryawan', 'id');
    }

    public function getPerusahaan()
    {
        return $this->belongsTo(MasterPerusahaan::class, 'KodePerusahaan', 'id');
    }
}
