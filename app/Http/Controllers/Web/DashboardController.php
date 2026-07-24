<?php

namespace App\Http\Controllers\Web;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Kategori;
use App\Models\KondisiItem;
use App\Models\SerahTerima;

class DashboardController
{
    public function __invoke()
    {
        $total_gudang = Gudang::count();
        $total_kategori = Kategori::count();
        $total_barang = Barang::count();
        $total_stok = Barang::sum('stok');
        $stok_menipis = Barang::whereColumn('stok', '<=', 'stok_minimum')->count();
        $stok_habis = Barang::where('stok', 0)->count();
        $barang_rusak = KondisiItem::sum('jumlah_rusak');
        $serah_terima_aktif = SerahTerima::where('status', 'draft')->count();
        $barangs = Barang::with('kategori', 'gudang')->latest()->take(10)->get();
        $serah_terimas = SerahTerima::with('user')->latest()->take(5)->get();
        $kondisi_items = KondisiItem::with('barang', 'user')->latest()->take(5)->get();

        return view('dashboard', compact(
            'total_gudang', 'total_kategori', 'total_barang', 'total_stok',
            'stok_menipis', 'stok_habis', 'barang_rusak',
            'serah_terima_aktif', 'barangs', 'serah_terimas', 'kondisi_items',
        ));
    }
}
