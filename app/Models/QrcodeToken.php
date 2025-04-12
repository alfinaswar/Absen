<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrcodeToken extends Model
{
    use HasFactory;

    protected $table = 'qrcode_tokens';
    protected $guarded = ['id'];
}
