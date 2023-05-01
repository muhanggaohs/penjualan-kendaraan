<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Mobil extends Kendaraan
{
    protected $fillable = [
        'tahun_keluaran', 'warna', 'harga', 'mesin', 'kapasitas_penumpang', 'type'
    ];
}
