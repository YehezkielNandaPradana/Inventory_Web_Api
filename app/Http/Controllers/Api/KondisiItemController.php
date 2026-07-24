<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\KondisiItem;
use Illuminate\Http\Request;

class KondisiItemController extends Controller
{
    public function index()
    {
        return response()->json(KondisiItem::with('barang.kategori', 'user')->latest()->get());
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

        $kondisiItem = KondisiItem::create([
            'barang_id' => $validated['barang_id'],
            'user_id' => $request->user()?->id,
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
            }
        }

        return response()->json($kondisiItem->load('barang', 'user'), 201);
    }

    public function show(KondisiItem $kondisiItem)
    {
        return response()->json($kondisiItem->load('barang.kategori', 'user'));
    }

    public function destroy(KondisiItem $kondisiItem)
    {
        $kondisiItem->delete();

        return response()->json(null, 204);
    }
}
