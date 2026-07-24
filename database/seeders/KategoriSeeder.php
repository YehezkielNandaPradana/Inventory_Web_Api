<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            'Alat Tulis',
            'Perlengkapan Kantor',
            'Perlengkapan Sekolah',
            'Peralatan Elektronik',
            'Perabotan Kantor',
            'Bahan Habis Pakai',
        ];

        foreach ($kategoris as $nama) {
            Kategori::updateOrCreate(
                ['nama' => $nama],
                []
            );
        }
    }
}
