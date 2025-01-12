<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensis';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
