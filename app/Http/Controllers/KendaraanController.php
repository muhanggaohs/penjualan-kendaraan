<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Kendaraan;
use App\Models\Motor;
use App\Models\Mobil;
use App\Repositories\KendaraanRepository;

class KendaraanController extends Controller
{
    protected $kendaraanRepository;

    public function __construct(KendaraanRepository $kendaraanRepository)
    {
        $this->kendaraanRepository = $kendaraanRepository;
    }

    public function index()
    {
        $kendaraans = $this->kendaraanRepository->getAll();
        return response()->json([
            'success' => true,
            'message' => 'Stok kendaraan berhasil diambil',
            'data' => $kendaraans
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'tahun_keluaran' => 'required',
            'warna' => 'required',
            'harga' => 'required',
            'tipe_kendaraan' => 'required',
            'mesin' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $kendaraanData = [
            'tahun_keluaran' => $request->input('tahun_keluaran'),
            'warna' => $request->input('warna'),
            'harga' => $request->input('harga'),
            'tipe_kendaraan' => $request->input('tipe_kendaraan'),
            'mesin' => $request->input('mesin'),
            'created_by' => $user->id
        ];

        if ($request->input('tipe_kendaraan') == 'motor') {
            $kendaraanData['type_suspensi'] = $request->input('type_suspensi');
            $kendaraanData['type_transmisi'] = $request->input('type_transmisi');
            $kendaraan = $this->kendaraanRepository->create(new Motor($kendaraanData));
        } else {
            $kendaraanData['kapasitas_penumpang'] = $request->input('kapasitas_penumpang');
            $kendaraanData['type'] = $request->input('type');
            $kendaraan = $this->kendaraanRepository->create(new Mobil($kendaraanData));
        }

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan berhasil ditambahkan',
            'data' => $kendaraan
        ]);
    }

    public function show($id)
    {
        $kendaraan = $this->kendaraanRepository->getById($id);
        if (!$kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Kendaraan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $kendaraan
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $kendaraan = $this->kendaraanRepository->getById($id);
        if (!$kendaraan) {
        return response()->json([
        'success' => false,
        'message' => 'Kendaraan tidak ditemukan'
        ], 404);
        }
        $validator = Validator::make($request->all(), [
            'tahun_keluaran' => 'required',
            'warna' => 'required',
            'harga' => 'required',
            'tipe_kendaraan' => 'required',
            'mesin' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        if ($kendaraan->created_by != $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk mengubah kendaraan ini'
            ], 403);
        }

        $kendaraanData = [
            'tahun_keluaran' => $request->input('tahun_keluaran'),
            'warna' => $request->input('warna'),
            'harga' => $request->input('harga'),
            'tipe_kendaraan' => $request->input('tipe_kendaraan'),
            'mesin' => $request->input('mesin'),
        ];

        if ($request->input('tipe_kendaraan') == 'motor') {
            $kendaraanData['type_suspensi'] = $request->input('type_suspensi');
            $kendaraanData['type_transmisi'] = $request->input('type_transmisi');
            $kendaraan = $this->kendaraanRepository->update(new Motor($kendaraanData), $id);
        } else {
            $kendaraanData['kapasitas_penumpang'] = $request->input('kapasitas_penumpang');
            $kendaraanData['type'] = $request->input('type');
            $kendaraan = $this->kendaraanRepository->update(new Mobil($kendaraanData), $id);
        }

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan berhasil diupdate',
            'data' => $kendaraan
        ]);
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $kendaraan = $this->kendaraanRepository->getById($id);
        if (!$kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Kendaraan tidak ditemukan'
            ], 404);
        }

        if ($kendaraan->created_by != $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk menghapus kendaraan ini'
            ], 403);
        }

        $this->kendaraanRepository->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'Kendaraan berhasil dihapus'
        ]);
    }

    public function getMotor()
    {
        $kendaraans = $this->kendaraanRepository->getMotor();
        return response()->json([
            'success' => true,
            'message' => 'Data motor berhasil diambil',
            'data' => $kendaraans
        ]);
    }

    public function getMobil()
    {
        $kendaraans = $this->kendaraanRepository->getMobil();
        return response()->json([
            'success' => true,
            'message' => 'Data mobil berhasil diambil',
            'data' => $kendaraans
        ]);
    }
}
