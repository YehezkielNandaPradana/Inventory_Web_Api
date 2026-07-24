@extends('layouts.app')

@section('title', 'Rekap Data')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-poppins font-semibold text-navy-text">Rekap Data</h2>
    <p class="text-sm text-slate-text">Rekapitulasi data untuk TU, Waka, dan Ka.Prodi</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <p class="text-xs text-slate-text">Total Barang</p>
        <p class="text-3xl font-bold text-navy-text mt-1">{{ $total_barang }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <p class="text-xs text-slate-text">Total Stok</p>
        <p class="text-3xl font-bold text-primary-blue mt-1">{{ $total_stok }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <p class="text-xs text-slate-text">Total Serah Terima</p>
        <p class="text-3xl font-bold text-navy-text mt-1">{{ $total_serah_terima }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <p class="text-xs text-slate-text">Serah Terima Selesai</p>
        <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $serah_terima_selesai }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <h3 class="text-sm font-semibold text-navy-text mb-3">Kondisi Barang</h3>
        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <span class="text-sm flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500 inline-block"></span>Baik</span>
                <span class="font-semibold text-lg">{{ $barang_baik }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-rose-500 inline-block"></span>Rusak</span>
                <span class="font-semibold text-lg">{{ $barang_rusak }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-amber-500 inline-block"></span>Perbaikan</span>
                <span class="font-semibold text-lg">{{ $barang_perbaikan }}</span>
            </div>
            <div class="pt-2 border-t border-slate-50">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-slate-text">Total Rusak (terdata)</span>
                    <span class="font-semibold text-rose-600">{{ $total_rusak }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 lg:col-span-2">
        <h3 class="text-sm font-semibold text-navy-text mb-3">Daftar Barang</h3>
        <div class="overflow-y-auto max-h-80">
            <table class="w-full text-sm">
                <thead class="text-slate-text text-xs uppercase tracking-wider">
                    <tr>
                        <th class="text-left py-2 font-semibold">Nama</th>
                        <th class="text-center py-2 font-semibold">Stok</th>
                        <th class="text-center py-2 font-semibold">Kondisi</th>
                        <th class="text-left py-2 font-semibold">Kategori</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($barangs as $barang)
                    <tr>
                        <td class="py-2 text-navy-text font-medium">{{ $barang->nama }}</td>
                        <td class="py-2 text-center">{{ $barang->stok }}</td>
                        <td class="py-2 text-center">
                            @php $kondisiColors = ['baik' => 'text-emerald-600', 'rusak' => 'text-rose-600', 'perbaikan' => 'text-amber-600'] @endphp
                            <span class="{{ $kondisiColors[$barang->kondisi] ?? '' }} font-medium">{{ ucfirst($barang->kondisi) }}</span>
                        </td>
                        <td class="py-2 text-slate-text">{{ $barang->kategori?->nama ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
