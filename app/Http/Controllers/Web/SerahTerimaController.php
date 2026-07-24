<?php

namespace App\Http\Controllers\Web;

use App\Models\Barang;
use App\Models\DetailSerahTerima;
use App\Models\SerahTerima;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SerahTerimaController
{
    public function index()
    {
        $serah_terimas = SerahTerima::with('user', 'details.barang')->latest()->get();

        return view('serah-terima.index', compact('serah_terimas'));
    }

    public function create()
    {
        $barangs = Barang::with('kategori', 'gudang')->where('stok', '>', 0)->get();
        $users = User::all();

        return view('serah-terima.create', compact('barangs', 'users'));
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

        try {
            $no = 'ST-'.date('Ymd').'-'.str_pad(SerahTerima::whereDate('created_at', today())->count() + 1, 3, '0', STR_PAD_LEFT);

            $serah_terima = SerahTerima::create([
                'no_serah_terima' => $no,
                'tanggal' => $validated['tanggal'],
                'dari_pihak' => $validated['dari_pihak'],
                'kepada_pihak' => $validated['kepada_pihak'],
                'dari_user_id' => $validated['dari_user_id'] ?? null,
                'kepada_user_id' => $validated['kepada_user_id'] ?? null,
                'user_id' => Auth::id(),
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

            return redirect()->route('web.serah-terima.index')->with('success', 'Serah terima berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->route('web.serah-terima.create')->with('error', 'Gagal membuat serah terima. '.$e->getMessage());
        }
    }

    public function show(SerahTerima $serahTerima)
    {
        $serahTerima->load('details.barang.kategori', 'user', 'dariUser', 'kepadaUser');

        return view('serah-terima.show', compact('serahTerima'));
    }

    public function destroy(SerahTerima $serahTerima)
    {
        try {
            foreach ($serahTerima->details as $detail) {
                $detail->barang()->increment('stok', $detail->jumlah);
            }

            $serahTerima->delete();

            return redirect()->route('web.serah-terima.index')->with('success', 'Serah terima berhasil dibatalkan.');
        } catch (\Exception $e) {
            return redirect()->route('web.serah-terima.index')->with('error', 'Gagal membatalkan serah terima.');
        }
    }
}
