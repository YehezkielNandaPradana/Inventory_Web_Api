<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DetailSerahTerima;
use App\Models\SerahTerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SerahTerimaController extends Controller
{
    public function index()
    {
        return response()->json(SerahTerima::with('user', 'details.barang.kategori')->latest()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'dari_pihak' => ['required', 'string', 'max:255'],
            'kepada_pihak' => ['required', 'string', 'max:255'],
            'dari_user_id' => ['nullable', 'exists:users,id'],
            'kepada_user_id' => ['nullable', 'exists:users,id'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.barang_id' => ['required', 'exists:barangs,id'],
            'items.*.jumlah' => ['required', 'integer', 'min:1'],
            'items.*.kondisi' => ['nullable', 'string', 'in:baik,rusak'],
        ]);

        $no = 'ST-'.date('Ymd').'-'.str_pad(SerahTerima::whereDate('created_at', today())->count() + 1, 3, '0', STR_PAD_LEFT);

        $serah_terima = SerahTerima::create([
            'no_serah_terima' => $no,
            'tanggal' => $validated['tanggal'],
            'dari_pihak' => $validated['dari_pihak'],
            'kepada_pihak' => $validated['kepada_pihak'],
            'dari_user_id' => $validated['dari_user_id'] ?? null,
            'kepada_user_id' => $validated['kepada_user_id'] ?? null,
            'user_id' => Auth::id() ?? 1,
            'keterangan' => $validated['keterangan'] ?? null,
            'status' => 'selesai',
        ]);

        foreach ($validated['items'] as $item) {
            DetailSerahTerima::create([
                'serah_terima_id' => $serah_terima->id,
                'barang_id' => $item['barang_id'],
                'jumlah' => $item['jumlah'],
                'kondisi' => $item['kondisi'] ?? 'baik',
            ]);

            $barang = Barang::find($item['barang_id']);
            if ($barang && $barang->stok >= $item['jumlah']) {
                $barang->decrement('stok', $item['jumlah']);
            }
        }

        return response()->json($serah_terima->load('details.barang', 'user'), 201);
    }

    public function show(SerahTerima $serahTerima)
    {
        return response()->json($serahTerima->load('details.barang.kategori', 'user', 'dariUser', 'kepadaUser'));
    }

    public function destroy(SerahTerima $serahTerima)
    {
        foreach ($serahTerima->details as $detail) {
            $detail->barang()->increment('stok', $detail->jumlah);
        }

        $serahTerima->delete();

        return response()->json(null, 204);
    }
}
