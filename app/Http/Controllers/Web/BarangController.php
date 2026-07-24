<?php

namespace App\Http\Controllers\Web;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController
{
    public function index()
    {
        $barangs = Barang::with('kategori', 'gudang')->latest()->get();
        $kategoris = Kategori::all();
        $gudangs = Gudang::all();

        $total_barang = Barang::count();
        $stok_menipis = Barang::whereColumn('stok', '<=', 'stok_minimum')->count();
        $stok_habis = Barang::where('stok', 0)->count();
        $stok_aman = $total_barang - $stok_menipis;
        $stok_menipis_aktif = $stok_menipis - $stok_habis;

        return view('barangs.index', compact('barangs', 'kategoris', 'gudangs', 'total_barang', 'stok_aman', 'stok_menipis_aktif', 'stok_habis'));
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
            'gambar_url' => ['nullable', 'string', 'max:500'],
            'gambar_file' => ['nullable', 'image', 'mimes:jpeg,png,webp,gif', 'max:2048'],
        ]);

        try {
            $data = [
                'kode_barang' => $validated['kode_barang'] ?? null,
                'nama' => $validated['nama'],
                'kategori_id' => $validated['kategori_id'],
                'gudang_id' => $validated['gudang_id'] ?? null,
                'stok' => $validated['stok'],
                'stok_minimum' => $validated['stok_minimum'],
                'kondisi' => $validated['kondisi'] ?? 'baik',
            ];

            if ($request->hasFile('gambar_file')) {
                $data['gambar'] = $request->file('gambar_file')->store('barang', 'public');
            } elseif ($request->filled('gambar_url')) {
                $data['gambar'] = $validated['gambar_url'];
            }

            Barang::create($data);

            return redirect()->route('web.barangs.index')->with('success', 'Barang berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('web.barangs.index')->with('error', 'Gagal menambahkan barang. Silakan coba lagi.');
        }
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
            'gambar_url' => ['nullable', 'string', 'max:500'],
            'gambar_file' => ['nullable', 'image', 'mimes:jpeg,png,webp,gif', 'max:2048'],
        ]);

        try {
            $data = [
                'kode_barang' => $validated['kode_barang'] ?? null,
                'nama' => $validated['nama'],
                'kategori_id' => $validated['kategori_id'],
                'gudang_id' => $validated['gudang_id'] ?? null,
                'stok' => $validated['stok'],
                'stok_minimum' => $validated['stok_minimum'],
                'kondisi' => $validated['kondisi'] ?? 'baik',
            ];

            if ($request->hasFile('gambar_file')) {
                if ($barang->gambar && ! str_starts_with($barang->gambar, 'http')) {
                    Storage::disk('public')->delete($barang->gambar);
                }
                $data['gambar'] = $request->file('gambar_file')->store('barang', 'public');
            } elseif ($request->filled('gambar_url')) {
                if ($barang->gambar && ! str_starts_with($barang->gambar, 'http')) {
                    Storage::disk('public')->delete($barang->gambar);
                }
                $data['gambar'] = $validated['gambar_url'];
            }

            $barang->update($data);

            return redirect()->route('web.barangs.index')->with('success', 'Barang berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('web.barangs.index')->with('error', 'Gagal memperbarui barang. Silakan coba lagi.');
        }
    }

    public function destroy(Barang $barang)
    {
        try {
            if ($barang->gambar && ! str_starts_with($barang->gambar, 'http')) {
                Storage::disk('public')->delete($barang->gambar);
            }

            $barang->delete();

            return redirect()->route('web.barangs.index')->with('success', 'Barang berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('web.barangs.index')->with('error', 'Gagal menghapus barang. Barang masih memiliki data terkait.');
        }
    }
}
