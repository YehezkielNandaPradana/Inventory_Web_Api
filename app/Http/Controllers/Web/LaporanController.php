<?php

namespace App\Http\Controllers\Web;

use App\Models\Barang;
use App\Models\KondisiItem;
use App\Models\SerahTerima;
use Illuminate\Http\Request;

class LaporanController
{
    public function index()
    {
        return view('laporan.index');
    }

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

        if ($request->filled('status')) {
            if ($request->status === 'habis') {
                $query->where('stok', 0);
            } elseif ($request->status === 'menipis') {
                $query->whereColumn('stok', '<=', 'stok_minimum')->where('stok', '>', 0);
            } elseif ($request->status === 'aman') {
                $query->whereColumn('stok', '>', 'stok_minimum');
            }
        }

        $barangs = $query->latest()->get();

        return view('laporan.barang', compact('barangs'));
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

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $serah_terimas = $query->latest()->get();

        return view('laporan.serah-terima', compact('serah_terimas'));
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

        $kondisi_items = $query->latest()->get();

        return view('laporan.kondisi-item', compact('kondisi_items'));
    }
}
