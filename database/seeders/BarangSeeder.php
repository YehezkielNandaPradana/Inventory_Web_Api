<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $alatTulis = Kategori::where('nama', 'Alat Tulis')->first();
        $perlengkapanKantor = Kategori::where('nama', 'Perlengkapan Kantor')->first();

        $barangs = [
            ['nama' => 'Kertas A4 80gsm', 'kategori_id' => $alatTulis?->id, 'stok' => 50, 'stok_minimum' => 10],
            ['nama' => 'Spidol Hitam', 'kategori_id' => $alatTulis?->id, 'stok' => 20, 'stok_minimum' => 5],
            ['nama' => 'Stapler', 'kategori_id' => $perlengkapanKantor?->id, 'stok' => 8, 'stok_minimum' => 2],
            ['nama' => 'Map Folder', 'kategori_id' => $perlengkapanKantor?->id, 'stok' => 15, 'stok_minimum' => 5],
            ['nama' => 'Pulpen Biru', 'kategori_id' => $alatTulis?->id, 'stok' => 0, 'stok_minimum' => 10],
        ];

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}
