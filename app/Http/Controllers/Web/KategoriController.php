<?php

namespace App\Http\Controllers\Web;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController
{
    public function index()
    {
        $kategoris = Kategori::withCount('barangs')
            ->with(['barangs' => function ($query) {
                $query->select('kategori_id', 'stok', 'stok_minimum');
            }])
            ->latest()
            ->get();

        $totalKategori = $kategoris->count();
        $totalBarang = $kategoris->sum('barangs_count');

        $kategoris->each(function ($kategori) {
            $barangStatus = ['Aman' => 0, 'Menipis' => 0, 'Habis' => 0];
            foreach ($kategori->barangs as $barang) {
                if ($barang->stok === 0) {
                    $barangStatus['Habis']++;
                } elseif ($barang->stok <= $barang->stok_minimum) {
                    $barangStatus['Menipis']++;
                } else {
                    $barangStatus['Aman']++;
                }
            }
            $kategori->status_aman = $barangStatus['Aman'];
            $kategori->status_menipis = $barangStatus['Menipis'];
            $kategori->status_habis = $barangStatus['Habis'];
            $kategori->persen_aman = $kategori->barangs_count > 0 ? round(($barangStatus['Aman'] / $kategori->barangs_count) * 100) : 0;
            $kategori->barang_teratas = $kategori->barangs->take(5);
        });

        return view('kategoris.index', compact('kategoris', 'totalKategori', 'totalBarang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'unique:kategoris,nama'],
        ]);

        try {
            Kategori::create($validated);

            return redirect()->route('web.kategoris.index')->with('success', 'Kategori berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('web.kategoris.index')->with('error', 'Gagal menambahkan kategori. Silakan coba lagi.');
        }
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'unique:kategoris,nama,'.$kategori->id],
        ]);

        try {
            $kategori->update($validated);

            return redirect()->route('web.kategoris.index')->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('web.kategoris.index')->with('error', 'Gagal memperbarui kategori. Silakan coba lagi.');
        }
    }

    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();

            return redirect()->route('web.kategoris.index')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('web.kategoris.index')->with('error', 'Gagal menghapus kategori. Kategori masih memiliki barang terkait.');
        }
    }
}
