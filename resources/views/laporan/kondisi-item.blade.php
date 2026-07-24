@extends('layouts.app')

@section('title', 'Laporan Kondisi Item')

@section('content')
<div class="mb-6">
    <a href="{{ route('web.laporan.index') }}" class="text-sm text-slate-text hover:text-navy-text flex items-center gap-1.5 mb-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>
    <h2 class="text-2xl font-poppins font-semibold text-navy-text">Laporan Kondisi Item</h2>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-text text-xs uppercase tracking-wider">
                <tr>
                    <th class="text-left px-4 py-3 font-semibold">Tanggal</th>
                    <th class="text-left px-4 py-3 font-semibold">Barang</th>
                    <th class="text-center px-4 py-3 font-semibold">Baik</th>
                    <th class="text-center px-4 py-3 font-semibold">Rusak</th>
                    <th class="text-center px-4 py-3 font-semibold">Perbaikan</th>
                    <th class="text-left px-4 py-3 font-semibold">Petugas</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($kondisi_items as $item)
                <tr>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_pendataan)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3 font-medium text-navy-text">{{ $item->barang?->nama ?? '-' }}</td>
                    <td class="px-4 py-3 text-center text-emerald-600 font-medium">{{ $item->jumlah_baik }}</td>
                    <td class="px-4 py-3 text-center text-rose-600 font-medium">{{ $item->jumlah_rusak }}</td>
                    <td class="px-4 py-3 text-center text-amber-600 font-medium">{{ $item->jumlah_perbaikan }}</td>
                    <td class="px-4 py-3 text-slate-text">{{ $item->user?->name ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-4 py-12 text-center text-slate-text">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
