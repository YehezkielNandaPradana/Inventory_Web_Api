<?php

namespace App\Http\Controllers\Web;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController
{
    public function index()
    {
        $gudangs = Gudang::withCount('barangs')->latest()->get();

        return view('gudang.index', compact('gudangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:gudangs,kode'],
            'nama' => ['required', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string', 'max:500'],
        ]);

        try {
            Gudang::create($validated);

            return redirect()->route('web.gudang.index')->with('success', 'Gudang berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('web.gudang.index')->with('error', 'Gagal menambahkan gudang.');
        }
    }

    public function update(Request $request, Gudang $gudang)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:gudangs,kode,'.$gudang->id],
            'nama' => ['required', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string', 'max:500'],
        ]);

        try {
            $gudang->update($validated);

            return redirect()->route('web.gudang.index')->with('success', 'Gudang berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('web.gudang.index')->with('error', 'Gagal memperbarui gudang.');
        }
    }

    public function destroy(Gudang $gudang)
    {
        try {
            $gudang->delete();

            return redirect()->route('web.gudang.index')->with('success', 'Gudang berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('web.gudang.index')->with('error', 'Gagal menghapus gudang. Gudang masih memiliki barang terkait.');
        }
    }
}
