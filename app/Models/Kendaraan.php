<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Kendaraan extends Model
{
    protected $fillable = [
        'tahun_keluaran', 'warna', 'harga'
    ];
}
