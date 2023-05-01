<?php

namespace Tests\Feature;

use App\Models\Kendaraan;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KendaraanTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    public function testGetAllKendaraan()
    {
        Kendaraan::factory(3)->create();

        $response = $this->getJson('/api/kendaraan');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function testCreateKendaraan()
    {
        $payload = [
            'nama' => $this->faker->name(),
            'tahun_pembuatan' => $this->faker->year(),
            'plat_nomor' => $this->faker->unique()->regexify('[A-Z]{2} [0-9]{4} [A-Z]{2}'),
            'jenis_kendaraan' => $this->faker->randomElement(['Mobil', 'Motor']),
        ];

        $response = $this->postJson('/api/kendaraan', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment($payload);
    }

    public function testGetKendaraanById()
    {
        $kendaraan = Kendaraan::factory()->create();

        $response = $this->getJson('/api/kendaraan/' . $kendaraan->id);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id' => $kendaraan->id,
                'nama' => $kendaraan->nama,
                'tahun_pembuatan' => $kendaraan->tahun_pembuatan,
                'plat_nomor' => $kendaraan->plat_nomor,
                'jenis_kendaraan' => $kendaraan->jenis_kendaraan,
            ]);
    }

    public function testUpdateKendaraan()
    {
        $kendaraan = Kendaraan::factory()->create();

        $payload = [
            'nama' => $this->faker->name(),
            'tahun_pembuatan' => $this->faker->year(),
            'plat_nomor' => $this->faker->unique()->regexify('[A-Z]{2} [0-9]{4} [A-Z]{2}'),
            'jenis_kendaraan' => $this->faker->randomElement(['Mobil', 'Motor']),
        ];

        $response = $this->putJson('/api/kendaraan/' . $kendaraan->id, $payload);

        $response->assertStatus(200)
            ->assertJsonFragment($payload);
    }

    public function testDeleteKendaraan()
    {
        $kendaraan = Kendaraan::factory()->create();

        $response = $this->deleteJson('/api/kendaraan/' . $kendaraan->id);

        $response->assertStatus(204);

        $this->assertNull(Kendaraan::find($kendaraan->id));
    }
}
