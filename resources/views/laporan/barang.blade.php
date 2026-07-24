@extends('layouts.app')

@section('title', 'Laporan Barang')

@section('content')
<div class="mb-6">
    <a href="{{ route('web.laporan.index') }}" class="text-sm text-slate-text hover:text-navy-text flex items-center gap-1.5 mb-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>
    <h2 class="text-2xl font-poppins font-semibold text-navy-text">Laporan Barang</h2>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="p-4 border-b border-slate-50">
        <form class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-semibold text-slate-text mb-1">Kategori</label>
                <select name="kategori_id" class="px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white">
                    <option value="">Semua</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-primary-blue text-white text-sm font-medium rounded-xl hover:bg-blue-600 transition-colors">Filter</button>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-text text-xs uppercase tracking-wider">
                <tr>
                    <th class="text-left px-4 py-3 font-semibold">Kode</th>
                    <th class="text-left px-4 py-3 font-semibold">Nama</th>
                    <th class="text-left px-4 py-3 font-semibold">Kategori</th>
                    <th class="text-left px-4 py-3 font-semibold">Gudang</th>
                    <th class="text-center px-4 py-3 font-semibold">Stok</th>
                    <th class="text-center px-4 py-3 font-semibold">Kondisi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($barangs as $barang)
                <tr>
                    <td class="px-4 py-3 font-mono text-xs">{{ $barang->kode_barang ?? '-' }}</td>
                    <td class="px-4 py-3 font-medium text-navy-text">{{ $barang->nama }}</td>
                    <td class="px-4 py-3 text-slate-text">{{ $barang->kategori?->nama ?? '-' }}</td>
                    <td class="px-4 py-3 text-slate-text">{{ $barang->gudang?->nama ?? '-' }}</td>
                    <td class="px-4 py-3 text-center font-semibold">{{ $barang->stok }}</td>
                    <td class="px-4 py-3 text-center">
                        @php $c = ['baik' => 'text-emerald-600', 'rusak' => 'text-rose-600', 'perbaikan' => 'text-amber-600'] @endphp
                        <span class="{{ $c[$barang->kondisi] ?? '' }}">{{ ucfirst($barang->kondisi) }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-4 py-12 text-center text-slate-text">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
