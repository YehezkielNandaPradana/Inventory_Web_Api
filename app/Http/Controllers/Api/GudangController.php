<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        return response()->json(Gudang::withCount('barangs')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:gudangs,kode'],
            'nama' => ['required', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string', 'max:500'],
        ]);

        $gudang = Gudang::create($validated);

        return response()->json($gudang, 201);
    }

    public function show(Gudang $gudang)
    {
        return response()->json($gudang->load('barangs.kategori'));
    }

    public function update(Request $request, Gudang $gudang)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:gudangs,kode,'.$gudang->id],
            'nama' => ['required', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string', 'max:500'],
        ]);

        $gudang->update($validated);

        return response()->json($gudang);
    }

    public function destroy(Gudang $gudang)
    {
        $gudang->delete();

        return response()->json(null, 204);
    }
}
