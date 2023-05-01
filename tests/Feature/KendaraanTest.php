<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\Kendaraan;
use App\Models\User;

class KendaraanTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllKendaraan()
    {
        Kendaraan::factory()->count(10)->create();

        $response = $this->get('/api/kendaraan');

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    public function testGetKendaraanById()
    {
        $kendaraan = Kendaraan::factory()->create();

        $response = $this->get('/api/kendaraan/' . $kendaraan->id);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $kendaraan->id,
                    'tahun_keluaran' => $kendaraan->tahun_keluaran,
                    'warna' => $kendaraan->warna,
                    'harga' => $kendaraan->harga,
                    'tipe_kendaraan' => $kendaraan->tipe_kendaraan,
                    'mesin' => $kendaraan->mesin,
                ]
            ]);
    }

    public function testCreateKendaraan()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $data = [
            'tahun_keluaran' => '2021',
            'warna' => 'Merah',
            'harga' => '150000000',
            'tipe_kendaraan' => 'mobil',
            'mesin' => '2000cc',
            'kapasitas_penumpang' => '5',
            'type' => 'SUV',
        ];

        $response = $this->post('/api/kendaraan', $data);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Kendaraan berhasil ditambahkan',
                'data' => [
                    'tahun_keluaran' => $data['tahun_keluaran'],
                    'warna' => $data['warna'],
                    'harga' => $data['harga'],
                    'tipe_kendaraan' => $data['tipe_kendaraan'],
                    'mesin' => $data['mesin'],
                    'kapasitas_penumpang' => $data['kapasitas_penumpang'],
                    'type' => $data['type'],
                    'created_by' => $user->id,
                ]
            ]);
    }

    public function testUpdateKendaraan()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $kendaraan = Kendaraan::factory()->create([
            'tahun_keluaran' => '2019',
            'warna' => 'Hitam',
            'harga' => '120000000',
            'tipe_kendaraan' => 'mobil',
            'mesin' => '1500cc',
            'kapasitas_penumpang' => '5',
            'type' => 'SUV',
            'created_by' => $user->id,
        ]);

        $data = [
            'tahun_keluaran' => '2022',
            'warna' => 'Putih',
            'harga' => '130000000',
            'tipe_kendaraan' => 'motor',
            'mesin' => '200cc',
            'kapasitas_penumpang' => '2',
            'type' => 'Sport',
            ];

            $response = $this->put('/api/kendaraan/' . $kendaraan->id, $data);

            $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Kendaraan berhasil diupdate',
                    'data' => [
                        'id' => $kendaraan->id,
                        'tahun_keluaran' => $data['tahun_keluaran'],
                        'warna' => $data['warna'],
                        'harga' => $data['harga'],
                        'tipe_kendaraan' => $data['tipe_kendaraan'],
                        'mesin' => $data['mesin'],
                        'kapasitas_penumpang' => $data['kapasitas_penumpang'],
                        'type' => $data['type'],
                        'created_by' => $user->id,
                    ]
                ]);
        }

        public function testDeleteKendaraan()
        {
            $user = User::factory()->create();
            Auth::login($user);

            $kendaraan = Kendaraan::factory()->create([
                'created_by' => $user->id,
            ]);

            $response = $this->delete('/api/kendaraan/' . $kendaraan->id);

            $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Kendaraan berhasil dihapus',
                ]);
        }
    }

