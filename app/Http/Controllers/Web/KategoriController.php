<?php

namespace App\Http\Controllers\Web;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController
{
    public function index()
    {
        $kategoris = Kategori::withCount('barangs')->latest()->get();

        return view('kategoris.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'unique:kategoris,nama'],
        ]);

        try {
            Kategori::create($validated);

            return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('kategoris.index')->with('error', 'Gagal menambahkan kategori. Silakan coba lagi.');
        }
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'unique:kategoris,nama,'.$kategori->id],
        ]);

        try {
            $kategori->update($validated);

            return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('kategoris.index')->with('error', 'Gagal memperbarui kategori. Silakan coba lagi.');
        }
    }

    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();

            return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('kategoris.index')->with('error', 'Gagal menghapus kategori. Kategori masih memiliki barang terkait.');
        }
    }
}
