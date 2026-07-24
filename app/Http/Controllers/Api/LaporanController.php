<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\KondisiItem;
use App\Models\SerahTerima;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function barang(Request $request)
    {
        $query = Barang::with('kategori', 'gudang');

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('gudang_id')) {
            $query->where('gudang_id', $request->gudang_id);
        }

        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        return response()->json($query->latest()->get());
    }

    public function serahTerima(Request $request)
    {
        $query = SerahTerima::with('user', 'details.barang');

        if ($request->filled('dari_tanggal')) {
            $query->whereDate('tanggal', '>=', $request->dari_tanggal);
        }

        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('tanggal', '<=', $request->sampai_tanggal);
        }

        return response()->json($query->latest()->get());
    }

    public function kondisiItem(Request $request)
    {
        $query = KondisiItem::with('barang.kategori', 'user');

        if ($request->filled('barang_id')) {
            $query->where('barang_id', $request->barang_id);
        }

        if ($request->filled('dari_tanggal')) {
            $query->whereDate('tanggal_pendataan', '>=', $request->dari_tanggal);
        }

        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('tanggal_pendataan', '<=', $request->sampai_tanggal);
        }

        return response()->json($query->latest()->get());
    }
}
