<?php

namespace App\Repositories;

use App\Models\Kendaraan;

class EloquentKendaraanRepository implements KendaraanRepository
{
    protected $model;

    public function __construct(Kendaraan $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $kendaraan = $this->model->find($id);
        if (!$kendaraan) {
            return false;
        }
        $kendaraan->update($data);
        return $kendaraan;
    }

    public function delete($id)
    {
        $kendaraan = $this->model->find($id);
        if (!$kendaraan) {
            return false;
        }
        $kendaraan->delete();
        return true;
    }
}
