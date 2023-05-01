<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Kendaraan extends Model
{
    protected $fillable = [
        'tahun_keluaran', 'warna', 'harga', 'tipe_kendaraan', 'mesin', 'kapasitas_penumpang', 'type', 'type_suspensi', 'type_transmisi', 'created_by'
    ];
}
