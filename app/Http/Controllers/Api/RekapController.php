<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\KondisiItem;
use App\Models\SerahTerima;

class RekapController extends Controller
{
    public function __invoke()
    {
        $data = [
            'total_barang' => Barang::count(),
            'total_stok' => Barang::sum('stok'),
            'barang_baik' => Barang::where('kondisi', 'baik')->count(),
            'barang_rusak' => Barang::where('kondisi', 'rusak')->count(),
            'barang_perbaikan' => Barang::where('kondisi', 'perbaikan')->count(),
            'stok_menipis' => Barang::where(function ($q) {
                $q->where('stok', 0)->orWhereColumn('stok', '<=', 'stok_minimum');
            })->count(),
            'total_rusak' => KondisiItem::sum('jumlah_rusak'),
            'total_serah_terima' => SerahTerima::count(),
            'serah_terima_selesai' => SerahTerima::where('status', 'selesai')->count(),
        ];

        return response()->json($data);
    }
}
