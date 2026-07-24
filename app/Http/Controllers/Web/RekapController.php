<?php

namespace App\Http\Controllers\Web;

use App\Models\Barang;
use App\Models\KondisiItem;
use App\Models\SerahTerima;

class RekapController
{
    public function __invoke()
    {
        $total_barang = Barang::count();
        $total_stok = Barang::sum('stok');
        $barang_baik = Barang::where('kondisi', 'baik')->count();
        $barang_rusak = Barang::where('kondisi', 'rusak')->count();
        $barang_perbaikan = Barang::where('kondisi', 'perbaikan')->count();
        $total_rusak = KondisiItem::sum('jumlah_rusak');
        $total_serah_terima = SerahTerima::count();
        $serah_terima_selesai = SerahTerima::where('status', 'selesai')->count();
        $barangs = Barang::with('kategori', 'gudang')->latest()->get();

        return view('rekap.index', compact(
            'total_barang', 'total_stok', 'barang_baik', 'barang_rusak',
            'barang_perbaikan', 'total_rusak', 'total_serah_terima',
            'serah_terima_selesai', 'barangs',
        ));
    }
}
