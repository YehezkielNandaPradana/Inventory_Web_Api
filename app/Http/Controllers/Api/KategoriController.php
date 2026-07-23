<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index()
    {
        return response()->json(Kategori::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'unique:kategoris,nama'],
        ]);
        $kategori = Kategori::create($validated);

        return response()->json($kategori, 201);
    }

    public function show(Kategori $kategori)
    {
        return response()->json($kategori->load('barangs'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', Rule::unique('kategoris', 'nama')->ignore($kategori->id)],
        ]);
        $kategori->update($validated);

        return response()->json($kategori);
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return response()->json(null, 204);
    }
}
