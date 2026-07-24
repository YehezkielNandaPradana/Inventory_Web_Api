<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = [
            'total_barang' => Barang::count(),
            'total_stok' => Barang::sum('stok'),
            'stok_menipis' => Barang::where('stok', 0)
                ->orWhereColumn('stok', '<=', 'stok_minimum')
                ->count(),
            'total_rusak' => Transaksi::where('jenis', 'rusak')->sum('jumlah'),
        ];

        return response()->json($data);
    }
}
