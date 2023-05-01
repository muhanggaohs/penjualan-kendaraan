<?php

namespace App\Repositories;

use App\Models\Mobil;

class MobilRepository implements KendaraanRepositoryInterface
{
    protected $mobil;

    public function __construct(Mobil $mobil)
    {
        $this->mobil = $mobil;
    }

    public function getAll()
    {
        return $this->mobil->all();
    }

    public function getById($id)
    {
        return $this->mobil->find($id);
    }

    public function create($data)
    {
        return $this->mobil->create($data);
    }

    public function update($data, $id)
    {
        $mobil = $this->getById($id);
        if (!$mobil) {
            return null;
        }

        $mobil->tahun_keluaran = $data['tahun_keluaran'];
        $mobil->warna = $data['warna'];
        $mobil->harga = $data['harga'];
        $mobil->tipe_kendaraan = $data['tipe_kendaraan'];
        $mobil->mesin = $data['mesin'];
        $mobil->kapasitas_penumpang = $data['kapasitas_penumpang'];
        $mobil->type = $data['type'];
        $mobil->save();

        return $mobil;
    }

    public function delete($id)
    {
        $mobil = $this->getById($id);
        if ($mobil) {
            $mobil->delete();
        }
    }
}
