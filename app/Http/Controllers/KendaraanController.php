<?php

namespace App\Http\Controllers;

use App\Services\KendaraanService;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    protected $kendaraanService;

    public function __construct(KendaraanService $kendaraanService)
    {
        $this->kendaraanService = $kendaraanService;
    }

    public function index()
    {
        $kendaraans = $this->kendaraanService->getAllKendaraans();
        return response()->json($kendaraans);
    }

    public function store(Request $request)
    {
        $kendaraan = $this->kendaraanService->createKendaraan($request->all());
        return response()->json($kendaraan);
    }

    public function show($id)
    {
        $kendaraan = $this->kendaraanService->getKendaraanById($id);
        return response()->json($kendaraan);
    }

    public function update(Request $request, $id)
    {
        $kendaraan = $this->kendaraanService->updateKendaraan($id, $request->all());
        return response()->json($kendaraan);
    }

    public function destroy($id)
    {
        $result = $this->kendaraanService->deleteKendaraan($id);
        return response()->json(['result' => $result]);
    }
}
