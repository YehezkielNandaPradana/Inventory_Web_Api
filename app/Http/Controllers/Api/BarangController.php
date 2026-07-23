<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        return response()->json(Barang::with('kategori')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'stok' => ['required', 'integer', 'min:0'],
            'stok_minimum' => ['required', 'integer', 'min:0'],
            'gambar' => ['nullable', 'string', 'max:500'],
        ]);

        $barang = Barang::create($validated);

        return response()->json($barang->load('kategori'), 201);
    }

    public function show(Barang $barang)
    {
        return response()->json($barang->load('kategori', 'stokMovements'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'stok' => ['required', 'integer', 'min:0'],
            'stok_minimum' => ['required', 'integer', 'min:0'],
            'gambar' => ['nullable', 'string', 'max:500'],
        ]);

        $barang->update($validated);

        return response()->json($barang->load('kategori'));
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return response()->json(null, 204);
    }

    public function history(Barang $barang)
    {
        return response()->json($barang->stokMovements()->with('user')->get());
    }
}
