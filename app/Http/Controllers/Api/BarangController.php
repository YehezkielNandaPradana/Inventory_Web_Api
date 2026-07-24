<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        return response()->json(Barang::with('kategori', 'gudang')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => ['nullable', 'string', 'max:50', 'unique:barangs,kode_barang'],
            'nama' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'gudang_id' => ['nullable', 'exists:gudangs,id'],
            'stok' => ['required', 'integer', 'min:0'],
            'stok_minimum' => ['required', 'integer', 'min:0'],
            'kondisi' => ['nullable', 'string', 'in:baik,rusak,perbaikan'],
            'gambar' => ['nullable', 'string', 'max:500'],
        ]);

        $barang = Barang::create($validated);

        return response()->json($barang->load('kategori', 'gudang'), 201);
    }

    public function show(Barang $barang)
    {
        return response()->json($barang->load('kategori', 'gudang', 'kondisiItems'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'kode_barang' => ['nullable', 'string', 'max:50', 'unique:barangs,kode_barang,'.$barang->id],
            'nama' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'gudang_id' => ['nullable', 'exists:gudangs,id'],
            'stok' => ['required', 'integer', 'min:0'],
            'stok_minimum' => ['required', 'integer', 'min:0'],
            'kondisi' => ['nullable', 'string', 'in:baik,rusak,perbaikan'],
            'gambar' => ['nullable', 'string', 'max:500'],
        ]);

        $barang->update($validated);

        return response()->json($barang->load('kategori', 'gudang'));
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return response()->json(null, 204);
    }

    public function history(Barang $barang)
    {
        return response()->json($barang->kondisiItems()->with('user')->get());
    }
}
