<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Province;

class MasterPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'master_perusahaans';
    protected $guarded = ['id'];

    public function getDataKaryawan()
    {
        return $this->belongsTo(User::class, 'IdPerusahaan', 'id');
    }
    public function getProvinsi()
    {
        return $this->hasOne(Province::class, 'id', 'Provinsi');
    }
    public function getKota()
    {
        return $this->hasOne(City::class, 'id', 'Kota');
    }
}
