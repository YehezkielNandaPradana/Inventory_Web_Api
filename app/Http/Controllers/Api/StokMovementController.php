<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StokMovement;
use Illuminate\Http\Request;

class StokMovementController extends Controller
{
    public function index()
    {
        return response()->json(StokMovement::with('barang', 'user')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => ['required', 'exists:barangs,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'tipe' => ['required', 'in:masuk,keluar'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'keterangan' => ['nullable', 'string', 'max:500'],
        ]);

        $stokMovement = StokMovement::create($validated);

        $barang = $stokMovement->barang;
        if ($stokMovement->tipe === 'masuk') {
            $barang->increment('stok', $stokMovement->jumlah);
        } else {
            $barang->decrement('stok', $stokMovement->jumlah);
        }

        return response()->json($stokMovement->load('barang', 'user'), 201);
    }

    public function show(StokMovement $stok_movement)
    {
        return response()->json($stok_movement->load('barang', 'user'));
    }

    public function update(Request $request, StokMovement $stok_movement)
    {
        $validated = $request->validate([
            'barang_id' => ['required', 'exists:barangs,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'tipe' => ['required', 'in:masuk,keluar'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'keterangan' => ['nullable', 'string', 'max:500'],
        ]);

        $stok_movement->update($validated);

        return response()->json($stok_movement->load('barang', 'user'));
    }

    public function destroy(StokMovement $stok_movement)
    {
        $stok_movement->delete();

        return response()->json(null, 204);
    }
}
