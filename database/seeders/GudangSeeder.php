<?php

namespace Database\Seeders;

use App\Models\Gudang;
use Illuminate\Database\Seeder;

class GudangSeeder extends Seeder
{
    public function run(): void
    {
        $gudangs = [
            ['kode' => 'GDG-001', 'nama' => 'Gudang Utama', 'lokasi' => 'Lantai 1, Gedung A'],
            ['kode' => 'GDG-002', 'nama' => 'Gudang ATK', 'lokasi' => 'Lantai 2, Gedung A'],
            ['kode' => 'GDG-003', 'nama' => 'Gudang Elektronik', 'lokasi' => 'Lantai 1, Gedung B'],
        ];

        foreach ($gudangs as $gudang) {
            Gudang::updateOrCreate(['kode' => $gudang['kode']], $gudang);
        }
    }
}
