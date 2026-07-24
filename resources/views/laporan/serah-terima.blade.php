@extends('layouts.app')

@section('title', 'Laporan Serah Terima')

@section('content')
<div class="mb-6">
    <a href="{{ route('web.laporan.index') }}" class="text-sm text-slate-text hover:text-navy-text flex items-center gap-1.5 mb-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>
    <h2 class="text-2xl font-poppins font-semibold text-navy-text">Laporan Serah Terima</h2>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-text text-xs uppercase tracking-wider">
                <tr>
                    <th class="text-left px-4 py-3 font-semibold">No</th>
                    <th class="text-left px-4 py-3 font-semibold">Tanggal</th>
                    <th class="text-left px-4 py-3 font-semibold">Dari</th>
                    <th class="text-left px-4 py-3 font-semibold">Kepada</th>
                    <th class="text-center px-4 py-3 font-semibold">Jumlah Item</th>
                    <th class="text-center px-4 py-3 font-semibold">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($serah_terimas as $st)
                <tr>
                    <td class="px-4 py-3 font-mono text-xs">{{ $st->no_serah_terima }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($st->tanggal)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">{{ $st->dari_pihak }}</td>
                    <td class="px-4 py-3">{{ $st->kepada_pihak }}</td>
                    <td class="px-4 py-3 text-center">{{ $st->details->sum('jumlah') }}</td>
                    <td class="px-4 py-3 text-center">
                        @php $colors = ['draft' => 'text-yellow-600', 'selesai' => 'text-emerald-600', 'dibatalkan' => 'text-rose-600'] @endphp
                        <span class="{{ $colors[$st->status] ?? '' }}">{{ ucfirst($st->status) }}</span>
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
