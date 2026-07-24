@extends('layouts.app')

@section('title', 'Serah Terima')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-2xl font-poppins font-semibold text-navy-text">Serah Terima</h2>
        <p class="text-sm text-slate-text">Daftar serah terima barang</p>
    </div>
    <a href="{{ route('web.serah-terima.create') }}" class="px-4 py-2 bg-primary-blue text-white rounded-xl text-sm font-medium hover:bg-blue-600 transition-colors flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Buat Serah Terima
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-text text-xs uppercase tracking-wider">
                <tr>
                    <th class="text-left px-4 py-3 font-semibold">No. Serah Terima</th>
                    <th class="text-left px-4 py-3 font-semibold">Tanggal</th>
                    <th class="text-left px-4 py-3 font-semibold">Dari</th>
                    <th class="text-left px-4 py-3 font-semibold">Kepada</th>
                    <th class="text-center px-4 py-3 font-semibold">Jumlah Item</th>
                    <th class="text-center px-4 py-3 font-semibold">Status</th>
                    <th class="text-center px-4 py-3 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($serah_terimas as $st)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3.5 font-mono text-xs font-medium">{{ $st->no_serah_terima }}</td>
                    <td class="px-4 py-3.5 text-navy-text">{{ \Carbon\Carbon::parse($st->tanggal)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3.5">{{ $st->dari_pihak }}</td>
                    <td class="px-4 py-3.5">{{ $st->kepada_pihak }}</td>
                    <td class="px-4 py-3.5 text-center">{{ $st->details->sum('jumlah') }}</td>
                    <td class="px-4 py-3.5 text-center">
                        @php $colors = ['draft' => 'bg-yellow-50 text-yellow-700', 'selesai' => 'bg-emerald-50 text-emerald-700', 'dibatalkan' => 'bg-rose-50 text-rose-700'] @endphp
                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colors[$st->status] ?? 'bg-slate-50' }}">{{ ucfirst($st->status) }}</span>
                    </td>
                    <td class="px-4 py-3.5">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('web.serah-terima.show', $st) }}" class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-text transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </a>
                            @if($st->status !== 'dibatalkan')
                            <form action="{{ route('web.serah-terima.destroy', $st) }}" method="POST" onsubmit="return confirm('Batalkan serah terima ini? Stok akan dikembalikan.')">
                                @csrf @method('DELETE')
                                <button class="p-1.5 rounded-lg hover:bg-rose-50 text-slate-text hover:text-danger-red transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-12 text-center text-slate-text">
                        <p class="text-sm font-medium">Belum ada serah terima</p>
                        <p class="text-xs mt-1">Klik "Buat Serah Terima" untuk membuat baru</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
