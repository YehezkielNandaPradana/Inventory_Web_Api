<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->query('jenis');

        $query = Transaksi::with('barang');

        if ($jenis) {
            $query->where('jenis', $jenis);
        }

        return response()->json($query->latest()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => ['required', 'exists:barangs,id'],
            'jenis' => ['required', 'in:masuk,keluar,rusak'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'keterangan' => ['nullable', 'string', 'max:500'],
        ]);

        $transaksi = Transaksi::create($validated);

        $barang = $transaksi->barang;

        if ($transaksi->jenis === 'masuk') {
            $barang->increment('stok', $transaksi->jumlah);
        } else {
            $barang->decrement('stok', $transaksi->jumlah);
        }

        return response()->json($transaksi->load('barang'), 201);
    }
}
