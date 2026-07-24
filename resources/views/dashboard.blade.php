@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-text font-medium">Total Barang</p>
                <p class="text-3xl font-bold text-navy-text mt-1">{{ $total_barang }}</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-light-blue-bg flex items-center justify-center">
                <svg class="w-5 h-5 text-primary-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
            </div>
        </div>
        <div class="mt-3 flex items-center gap-2 text-xs">
            <span class="text-slate-text">Total stok:</span>
            <span class="font-semibold text-navy-text">{{ $total_stok }}</span>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-text font-medium">Gudang</p>
                <p class="text-3xl font-bold text-navy-text mt-1">{{ $total_gudang }}</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
        </div>
        <div class="mt-3 flex items-center gap-2 text-xs">
            <span class="text-slate-text">Kategori:</span>
            <span class="font-semibold text-navy-text">{{ $total_kategori }}</span>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-text font-medium">Serah Terima</p>
                <p class="text-3xl font-bold text-navy-text mt-1">{{ $serah_terima_aktif }}</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 014-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
            </div>
        </div>
        <div class="mt-3 flex items-center gap-2 text-xs">
            <span class="text-slate-text">Aktif (draft):</span>
            <span class="font-semibold text-amber-600">{{ $serah_terima_aktif }}</span>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-text font-medium">Barang Rusak</p>
                <p class="text-3xl font-bold text-rose-600 mt-1">{{ $barang_rusak }}</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-rose-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 9v4"/><path d="M12 17h.01"/><path d="M10.29 3.86l-8.6 14.86A2 2 0 003.4 21h17.2a2 2 0 001.71-2.86l-8.6-14.86a2 2 0 00-3.42 0z"/></svg>
            </div>
        </div>
        <div class="mt-3 flex items-center gap-2 text-xs">
            <span class="text-slate-text">Stok menipis:</span>
            <span class="font-semibold text-amber-600">{{ $stok_menipis }}</span>
            <span class="text-slate-text mx-1">|</span>
            <span class="font-semibold text-rose-600">{{ $stok_habis }} habis</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <h3 class="text-sm font-semibold text-navy-text mb-4">Barang Terbaru</h3>
        <div class="space-y-3">
            @forelse($barangs as $barang)
            <div class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-slate-50 flex items-center justify-center text-xs font-semibold text-slate-text">
                        {{ strtoupper(substr($barang->nama, 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-navy-text">{{ $barang->nama }}</p>
                        <p class="text-xs text-slate-text">{{ $barang->kategori?->nama ?? '-' }} @if($barang->gudang) &middot; {{ $barang->gudang->nama }} @endif</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-semibold text-navy-text">{{ $barang->stok }}</p>
                    <p class="text-xs {{ $barang->status === 'Aman' ? 'text-emerald-600' : ($barang->status === 'Menipis' ? 'text-amber-600' : 'text-rose-600') }}">{{ $barang->status }}</p>
                </div>
            </div>
            @empty
            <p class="text-sm text-slate-text text-center py-6">Belum ada barang</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <h3 class="text-sm font-semibold text-navy-text mb-4">Serah Terima Terbaru</h3>
        <div class="space-y-3">
            @forelse($serah_terimas as $st)
            <div class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 transition-colors">
                <div>
                    <p class="text-sm font-medium text-navy-text">{{ $st->no_serah_terima }}</p>
                    <p class="text-xs text-slate-text">{{ $st->dari_pihak }} &rarr; {{ $st->kepada_pihak }}</p>
                </div>
                <div class="text-right">
                    @php $sc = ['draft' => 'text-yellow-600', 'selesai' => 'text-emerald-600', 'dibatalkan' => 'text-rose-600'] @endphp
                    <span class="text-xs font-medium {{ $sc[$st->status] ?? '' }}">{{ ucfirst($st->status) }}</span>
                    <p class="text-xs text-slate-text mt-0.5">{{ $st->details->sum('jumlah') }} item</p>
                </div>
            </div>
            @empty
            <p class="text-sm text-slate-text text-center py-6">Belum ada serah terima</p>
            @endforelse
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
    <h3 class="text-sm font-semibold text-navy-text mb-4">Pendataan Kondisi Item Terbaru</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-text text-xs uppercase tracking-wider">
                <tr>
                    <th class="text-left px-3 py-2 font-semibold">Tanggal</th>
                    <th class="text-left px-3 py-2 font-semibold">Barang</th>
                    <th class="text-center px-3 py-2 font-semibold">Baik</th>
                    <th class="text-center px-3 py-2 font-semibold">Rusak</th>
                    <th class="text-center px-3 py-2 font-semibold">Perbaikan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($kondisi_items as $item)
                <tr>
                    <td class="px-3 py-2.5 text-xs text-slate-text">{{ \Carbon\Carbon::parse($item->tanggal_pendataan)->format('d/m/Y') }}</td>
                    <td class="px-3 py-2.5 font-medium text-navy-text">{{ $item->barang?->nama ?? '-' }}</td>
                    <td class="px-3 py-2.5 text-center text-emerald-600 font-medium">{{ $item->jumlah_baik }}</td>
                    <td class="px-3 py-2.5 text-center text-rose-600 font-medium">{{ $item->jumlah_rusak }}</td>
                    <td class="px-3 py-2.5 text-center text-amber-600 font-medium">{{ $item->jumlah_perbaikan }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-3 py-8 text-center text-slate-text text-sm">Belum ada pendataan kondisi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
