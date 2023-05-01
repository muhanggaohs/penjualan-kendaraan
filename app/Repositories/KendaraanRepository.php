<?php

namespace App\Repositories;

use App\Models\Kendaraan;
use App\Models\Motor;
use App\Models\Mobil;
use Illuminate\Support\Facades\Auth;

class KendaraanRepository
{
    public function getAll()
    {
        return Kendaraan::all();
    }

    public function getById($id)
    {
        return Kendaraan::find($id);
    }

    public function create(Kendaraan $kendaraan)
    {
        $user = Auth::user();
        $kendaraan->created_by = $user->id;
        $kendaraan->save();
        return $kendaraan;
    }

    public function update(Kendaraan $kendaraan, $id)
    {
        $existingKendaraan = Kendaraan::find($id);
        if (!$existingKendaraan) {
            return null;
        }
        $existingKendaraan->tahun_keluaran = $kendaraan->tahun_keluaran;
        $existingKendaraan->warna = $kendaraan->warna;
        $existingKendaraan->harga = $kendaraan->harga;
        $existingKendaraan->tipe_kendaraan = $kendaraan->tipe_kendaraan;
        $existingKendaraan->mesin = $kendaraan->mesin;
        if ($kendaraan instanceof Motor) {
            $existingKendaraan->type_suspensi = $kendaraan->type_suspensi;
            $existingKendaraan->type_transmisi = $kendaraan->type_transmisi;
        } else {
            $existingKendaraan->kapasitas_penumpang = $kendaraan->kapasitas_penumpang;
            $existingKendaraan->type = $kendaraan->type;
        }
        $existingKendaraan->save();
        return $existingKendaraan;
    }

    public function delete($id)
    {
        Kendaraan::destroy($id);
    }

    public function getMotor()
    {
        return Motor::all();
    }
}
