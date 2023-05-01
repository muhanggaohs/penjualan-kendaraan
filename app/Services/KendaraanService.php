<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;

class KendaraanService
{
    protected $kendaraanRepository;

    public function __construct(KendaraanRepository $kendaraanRepository)
    {
        $this->kendaraanRepository = $kendaraanRepository;
    }

    public function getAll()
    {
        return $this->kendaraanRepository->getAll();
    }

    public function getById($id)
    {
        return $this->kendaraanRepository->getById($id);
    }

    public function create($data)
    {
        return $this->kendaraanRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->kendaraanRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->kendaraanRepository->delete($id);
    }
}
