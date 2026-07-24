@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-poppins font-semibold text-navy-text">Laporan</h2>
    <p class="text-sm text-slate-text">Pilih jenis laporan yang ingin dilihat</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <a href="{{ route('web.laporan.barang') }}" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 hover:shadow-md hover:border-primary-blue/30 transition-all group">
        <div class="w-12 h-12 rounded-xl bg-light-blue-bg flex items-center justify-center mb-4 group-hover:bg-primary-blue/10 transition-colors">
            <svg class="w-6 h-6 text-primary-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
        </div>
        <h3 class="text-sm font-semibold text-navy-text">Laporan Barang</h3>
        <p class="text-xs text-slate-text mt-1">Data stok, kondisi, dan kategori barang</p>
    </a>

    <a href="{{ route('web.laporan.serah-terima') }}" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 hover:shadow-md hover:border-primary-blue/30 transition-all group">
        <div class="w-12 h-12 rounded-xl bg-light-blue-bg flex items-center justify-center mb-4 group-hover:bg-primary-blue/10 transition-colors">
            <svg class="w-6 h-6 text-primary-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 014-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
        </div>
        <h3 class="text-sm font-semibold text-navy-text">Laporan Serah Terima</h3>
        <p class="text-xs text-slate-text mt-1">Riwayat serah terima barang</p>
    </a>

    <a href="{{ route('web.laporan.kondisi-item') }}" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 hover:shadow-md hover:border-primary-blue/30 transition-all group">
        <div class="w-12 h-12 rounded-xl bg-light-blue-bg flex items-center justify-center mb-4 group-hover:bg-primary-blue/10 transition-colors">
            <svg class="w-6 h-6 text-primary-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 9v4"/><path d="M12 17h.01"/><path d="M10.29 3.86l-8.6 14.86A2 2 0 003.4 21h17.2a2 2 0 001.71-2.86l-8.6-14.86a2 2 0 00-3.42 0z"/></svg>
        </div>
        <h3 class="text-sm font-semibold text-navy-text">Laporan Kondisi Item</h3>
        <p class="text-xs text-slate-text mt-1">Pendataan kondisi barang baik/rusak</p>
    </a>

    <a href="{{ route('web.rekap') }}" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 hover:shadow-md hover:border-primary-blue/30 transition-all group">
        <div class="w-12 h-12 rounded-xl bg-light-blue-bg flex items-center justify-center mb-4 group-hover:bg-primary-blue/10 transition-colors">
            <svg class="w-6 h-6 text-primary-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21.21 15.89A10 10 0 118 2.83"/><path d="M22 12A10 10 0 0012 2v10z"/></svg>
        </div>
        <h3 class="text-sm font-semibold text-navy-text">Rekap Data</h3>
        <p class="text-xs text-slate-text mt-1">Rekapitulasi untuk TU/Waka/Ka.Prodi</p>
    </a>
</div>
@endsection
