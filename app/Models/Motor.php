<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Motor extends Kendaraan
{
    protected $fillable = [
        'tahun_keluaran', 'warna', 'harga', 'mesin', 'type_suspensi', 'type_transmisi'
    ];
}
