<?php

namespace App\Http\Controllers\Web;

use App\Models\Barang;
use App\Models\StokMovement;
use Illuminate\Http\Request;

class StokMovementController
{
    public function index()
    {
        $stokMovements = StokMovement::with('barang', 'user')->latest()->get();
        $barangs = Barang::all();

        return view('stok-movements.index', compact('stokMovements', 'barangs'));
    }

    public function create()
    {
        $barangs = Barang::all();

        return view('stok-movements.create', compact('barangs'));
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

        return redirect()->back()->with('success', 'Pergerakan stok berhasil dicatat.');
    }

    public function destroy(StokMovement $stok_movement)
    {
        $stok_movement->delete();

        return redirect('/stok-movements')->with('success', 'Pergerakan stok berhasil dihapus.');
    }
}
