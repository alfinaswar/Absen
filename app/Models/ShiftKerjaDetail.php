<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftKerjaDetail extends Model
{
    use HasFactory;

    protected $table = 'shift_kerja_details';
    protected $guarded = ['id'];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'id_user', ownerKey: 'id');
    }

    public function getNamaShift()
    {
        return $this->hasOne(ShiftKerja::class, 'id', 'id_shift');
    }
}
