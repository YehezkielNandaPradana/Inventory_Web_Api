<?php

namespace App\Http\Controllers\Web;

use App\Models\Barang;
use App\Models\KondisiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KondisiItemController
{
    public function index()
    {
        $kondisi_items = KondisiItem::with('barang.kategori', 'user')->latest()->get();
        $barangs = Barang::with('kategori', 'gudang')->get();

        return view('kondisi-item.index', compact('kondisi_items', 'barangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => ['required', 'exists:barangs,id'],
            'jumlah_baik' => ['required', 'integer', 'min:0'],
            'jumlah_rusak' => ['required', 'integer', 'min:0'],
            'jumlah_perbaikan' => ['required', 'integer', 'min:0'],
            'keterangan' => ['nullable', 'string', 'max:500'],
            'tanggal_pendataan' => ['required', 'date'],
        ]);

        try {
            KondisiItem::create([
                'barang_id' => $validated['barang_id'],
                'user_id' => Auth::id(),
                'jumlah_baik' => $validated['jumlah_baik'],
                'jumlah_rusak' => $validated['jumlah_rusak'],
                'jumlah_perbaikan' => $validated['jumlah_perbaikan'],
                'keterangan' => $validated['keterangan'] ?? null,
                'tanggal_pendataan' => $validated['tanggal_pendataan'],
            ]);

            $barang = Barang::find($validated['barang_id']);
            if ($barang) {
                if ($validated['jumlah_rusak'] > 0) {
                    $barang->update(['kondisi' => 'rusak']);
                } elseif ($validated['jumlah_perbaikan'] > 0) {
                    $barang->update(['kondisi' => 'perbaikan']);
                } else {
                    $barang->update(['kondisi' => 'baik']);
                }
            }

            return redirect()->route('web.kondisi-item.index')->with('success', 'Data kondisi item berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('web.kondisi-item.index')->with('error', 'Gagal menyimpan data kondisi item.');
        }
    }

    public function destroy(KondisiItem $kondisiItem)
    {
        try {
            $kondisiItem->delete();

            return redirect()->route('web.kondisi-item.index')->with('success', 'Data kondisi item berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('web.kondisi-item.index')->with('error', 'Gagal menghapus data kondisi item.');
        }
    }
}
