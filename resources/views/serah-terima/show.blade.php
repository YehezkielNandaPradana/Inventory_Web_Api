@extends('layouts.app')

@section('title', 'Detail Serah Terima')

@section('content')
<div class="mb-6">
    <a href="{{ route('web.serah-terima.index') }}" class="text-sm text-slate-text hover:text-navy-text flex items-center gap-1.5 mb-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>
    <h2 class="text-2xl font-poppins font-semibold text-navy-text">Detail Serah Terima</h2>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-navy-text">Informasi</h3>
                @php $colors = ['draft' => 'bg-yellow-50 text-yellow-700', 'selesai' => 'bg-emerald-50 text-emerald-700', 'dibatalkan' => 'bg-rose-50 text-rose-700'] @endphp
                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colors[$serahTerima->status] ?? 'bg-slate-50' }}">{{ ucfirst($serahTerima->status) }}</span>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-slate-text">No. Serah Terima</span><p class="font-mono font-semibold text-navy-text mt-0.5">{{ $serahTerima->no_serah_terima }}</p></div>
                <div><span class="text-slate-text">Tanggal</span><p class="font-semibold text-navy-text mt-0.5">{{ \Carbon\Carbon::parse($serahTerima->tanggal)->format('d F Y') }}</p></div>
                <div><span class="text-slate-text">Dari</span><p class="font-semibold text-navy-text mt-0.5">{{ $serahTerima->dari_pihak }}</p></div>
                <div><span class="text-slate-text">Kepada</span><p class="font-semibold text-navy-text mt-0.5">{{ $serahTerima->kepada_pihak }}</p></div>
                @if($serahTerima->keterangan)
                <div class="col-span-2"><span class="text-slate-text">Keterangan</span><p class="text-navy-text mt-0.5">{{ $serahTerima->keterangan }}</p></div>
                @endif
                <div><span class="text-slate-text">Dibuat oleh</span><p class="text-navy-text mt-0.5">{{ $serahTerima->user?->name ?? '-' }}</p></div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h3 class="text-sm font-semibold text-navy-text mb-4">Daftar Barang</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-text text-xs uppercase tracking-wider">
                        <tr>
                            <th class="text-left px-3 py-2 font-semibold">Barang</th>
                            <th class="text-center px-3 py-2 font-semibold">Jumlah</th>
                            <th class="text-center px-3 py-2 font-semibold">Kondisi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($serahTerima->details as $detail)
                        <tr>
                            <td class="px-3 py-2.5">{{ $detail->barang?->nama ?? '-' }}</td>
                            <td class="px-3 py-2.5 text-center font-semibold">{{ $detail->jumlah }}</td>
                            <td class="px-3 py-2.5 text-center">
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $detail->kondisi === 'baik' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">{{ ucfirst($detail->kondisi) }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h3 class="text-sm font-semibold text-navy-text mb-4">Ringkasan</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between"><span class="text-slate-text">Total Item</span><span class="font-semibold">{{ $serahTerima->details->count() }}</span></div>
                <div class="flex justify-between"><span class="text-slate-text">Total Barang</span><span class="font-semibold">{{ $serahTerima->details->sum('jumlah') }}</span></div>
                <div class="flex justify-between"><span class="text-slate-text">Status</span><span class="font-semibold capitalize">{{ $serahTerima->status }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection
