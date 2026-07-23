<?php

namespace App\Http\Controllers\Web;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController
{
    public function index()
    {
        $barangs = Barang::with('kategori')->latest()->get();
        $kategoris = Kategori::all();

        $total_barang = Barang::count();
        $stok_menipis = Barang::whereColumn('stok', '<=', 'stok_minimum')->count();
        $stok_habis = Barang::where('stok', 0)->count();
        $stok_aman = $total_barang - $stok_menipis;
        $stok_menipis_aktif = $stok_menipis - $stok_habis;

        return view('barangs.index', compact('barangs', 'kategoris', 'total_barang', 'stok_aman', 'stok_menipis_aktif', 'stok_habis'));
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

        try {
            Barang::create($validated);

            return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('barangs.index')->with('error', 'Gagal menambahkan barang. Silakan coba lagi.');
        }
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

        try {
            $barang->update($validated);

            return redirect()->route('barangs.index')->with('success', 'Barang berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('barangs.index')->with('error', 'Gagal memperbarui barang. Silakan coba lagi.');
        }
    }

    public function destroy(Barang $barang)
    {
        try {
            $barang->delete();

            return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('barangs.index')->with('error', 'Gagal menghapus barang. Barang masih memiliki data terkait.');
        }
    }
}
