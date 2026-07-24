<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriMap = Kategori::all()->pluck('id', 'nama');

        $barangs = [
            // Alat Tulis
            ['nama' => 'Kertas A4 80gsm', 'kategori_id' => $kategoriMap['Alat Tulis'] ?? null, 'stok' => 50, 'stok_minimum' => 10, 'gambar' => 'kertas-a4.jpg'],
            ['nama' => 'Spidol Hitam', 'kategori_id' => $kategoriMap['Alat Tulis'] ?? null, 'stok' => 20, 'stok_minimum' => 5, 'gambar' => 'spidol-hitam.jpg'],
            ['nama' => 'Pulpen Biru', 'kategori_id' => $kategoriMap['Alat Tulis'] ?? null, 'stok' => 0, 'stok_minimum' => 10, 'gambar' => 'pulpen-biru.jpg'],
            ['nama' => 'Pensil 2B', 'kategori_id' => $kategoriMap['Alat Tulis'] ?? null, 'stok' => 35, 'stok_minimum' => 10, 'gambar' => 'pensil-2b.jpg'],
            ['nama' => 'Stabilo', 'kategori_id' => $kategoriMap['Alat Tulis'] ?? null, 'stok' => 15, 'stok_minimum' => 5, 'gambar' => 'stabilo.jpg'],

            // Perlengkapan Kantor
            ['nama' => 'Stapler', 'kategori_id' => $kategoriMap['Perlengkapan Kantor'] ?? null, 'stok' => 8, 'stok_minimum' => 2, 'gambar' => 'stapler.jpg'],
            ['nama' => 'Map Folder', 'kategori_id' => $kategoriMap['Perlengkapan Kantor'] ?? null, 'stok' => 15, 'stok_minimum' => 5, 'gambar' => 'map-folder.jpg'],
            ['nama' => 'Paperclip', 'kategori_id' => $kategoriMap['Perlengkapan Kantor'] ?? null, 'stok' => 100, 'stok_minimum' => 20, 'gambar' => 'paperclip.jpg'],
            ['nama' => 'Pembaris', 'kategori_id' => $kategoriMap['Perlengkapan Kantor'] ?? null, 'stok' => 12, 'stok_minimum' => 3, 'gambar' => 'pembaris.jpg'],

            // Perlengkapan Sekolah
            ['nama' => 'Buku Tulis', 'kategori_id' => $kategoriMap['Perlengkapan Sekolah'] ?? null, 'stok' => 30, 'stok_minimum' => 10, 'gambar' => 'buku-tulis.jpg'],
            ['nama' => 'Penghapus', 'kategori_id' => $kategoriMap['Perlengkapan Sekolah'] ?? null, 'stok' => 25, 'stok_minimum' => 8, 'gambar' => 'penghapus.jpg'],
            ['nama' => 'Spidol Warna', 'kategori_id' => $kategoriMap['Perlengkapan Sekolah'] ?? null, 'stok' => 10, 'stok_minimum' => 4, 'gambar' => 'spidol-warna.jpg'],

            // Peralatan Elektronik
            ['nama' => 'Printer Laser', 'kategori_id' => $kategoriMap['Peralatan Elektronik'] ?? null, 'stok' => 3, 'stok_minimum' => 1, 'gambar' => 'printer-laser.jpg'],
            ['nama' => 'Mouse Wireless', 'kategori_id' => $kategoriMap['Peralatan Elektronik'] ?? null, 'stok' => 7, 'stok_minimum' => 2, 'gambar' => 'mouse-wireless.jpg'],
            ['nama' => 'Keyboard USB', 'kategori_id' => $kategoriMap['Peralatan Elektronik'] ?? null, 'stok' => 5, 'stok_minimum' => 2, 'gambar' => 'keyboard-usb.jpg'],
            ['nama' => 'USB Flashdisk 32GB', 'kategori_id' => $kategoriMap['Peralatan Elektronik'] ?? null, 'stok' => 0, 'stok_minimum' => 5, 'gambar' => 'usb-flashdisk.jpg'],

            // Perabotan Kantor
            ['nama' => 'Meja Kantor', 'kategori_id' => $kategoriMap['Perabotan Kantor'] ?? null, 'stok' => 4, 'stok_minimum' => 1, 'gambar' => 'meja-kantor.jpg'],
            ['nama' => 'Kursi Kantor', 'kategori_id' => $kategoriMap['Perabotan Kantor'] ?? null, 'stok' => 6, 'stok_minimum' => 2, 'gambar' => 'kursi-kantor.jpg'],
            ['nama' => 'Lemari Arsip', 'kategori_id' => $kategoriMap['Perabotan Kantor'] ?? null, 'stok' => 2, 'stok_minimum' => 1, 'gambar' => 'lemari-arsip.jpg'],

            // Bahan Habis Pakai
            ['nama' => 'Toner Printer', 'kategori_id' => $kategoriMap['Bahan Habis Pakai'] ?? null, 'stok' => 8, 'stok_minimum' => 3, 'gambar' => 'toner-printer.jpg'],
            ['nama' => 'Baterai AA', 'kategori_id' => $kategoriMap['Bahan Habis Pakai'] ?? null, 'stok' => 40, 'stok_minimum' => 10, 'gambar' => 'baterai-aa.jpg'],
            ['nama' => 'Lampu TL', 'kategori_id' => $kategoriMap['Bahan Habis Pakai'] ?? null, 'stok' => 12, 'stok_minimum' => 5, 'gambar' => 'lampu-tl.jpg'],
        ];

        foreach ($barangs as $barang) {
            Barang::updateOrCreate(
                ['nama' => $barang['nama']],
                $barang
            );
        }
    }
}
