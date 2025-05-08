<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStatusPegawai extends Model
{
    use HasFactory;
    protected $table = 'master_status_pegawais';
    protected $guarded = ['id'];

}
