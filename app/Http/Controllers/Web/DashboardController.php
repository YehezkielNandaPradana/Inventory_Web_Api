<?php

namespace App\Http\Controllers\Web;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\StokMovement;

class DashboardController
{
    public function __invoke()
    {
        $data = [
            'total_kategori' => Kategori::count(),
            'total_barang' => Barang::count(),
            'total_stok' => Barang::sum('stok'),
            'stok_menipis' => Barang::whereColumn('stok', '<=', 'stok_minimum')->count(),
            'stok_habis' => Barang::where('stok', 0)->count(),
            'barangs' => Barang::with('kategori')->latest()->take(10)->get(),
            'stok_movements' => StokMovement::with('barang', 'user')->latest()->take(10)->get(),
        ];

        return view('dashboard', $data);
    }
}
