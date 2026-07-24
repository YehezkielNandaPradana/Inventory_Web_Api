@extends('layouts.app')

@section('title', 'Kondisi Item')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-2xl font-poppins font-semibold text-navy-text">Kondisi Item</h2>
        <p class="text-sm text-slate-text">Pendataan kondisi item (rusak & stock)</p>
    </div>
    <button onclick="openModal('addKondisiModal')" class="px-4 py-2 bg-primary-blue text-white rounded-xl text-sm font-medium hover:bg-blue-600 transition-colors flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Pendataan
    </button>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4">
        <p class="text-xs text-slate-text">Total Pendataan</p>
        <p class="text-2xl font-bold text-navy-text mt-1">{{ $kondisi_items->count() }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-emerald-100 shadow-sm p-4">
        <p class="text-xs text-slate-text">Total Baik</p>
        <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $kondisi_items->sum('jumlah_baik') }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-rose-100 shadow-sm p-4">
        <p class="text-xs text-slate-text">Total Rusak</p>
        <p class="text-2xl font-bold text-rose-600 mt-1">{{ $kondisi_items->sum('jumlah_rusak') }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-4">
        <p class="text-xs text-slate-text">Total Perbaikan</p>
        <p class="text-2xl font-bold text-amber-600 mt-1">{{ $kondisi_items->sum('jumlah_perbaikan') }}</p>
    </div>
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
                    <th class="text-center px-4 py-3 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($kondisi_items as $item)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3.5 text-navy-text">{{ \Carbon\Carbon::parse($item->tanggal_pendataan)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3.5">
                        <span class="font-medium text-navy-text">{{ $item->barang?->nama ?? '-' }}</span>
                        <span class="text-xs text-slate-text block">{{ $item->barang?->kategori?->nama ?? '' }}</span>
                    </td>
                    <td class="px-4 py-3.5 text-center font-semibold text-emerald-600">{{ $item->jumlah_baik }}</td>
                    <td class="px-4 py-3.5 text-center font-semibold text-rose-600">{{ $item->jumlah_rusak }}</td>
                    <td class="px-4 py-3.5 text-center font-semibold text-amber-600">{{ $item->jumlah_perbaikan }}</td>
                    <td class="px-4 py-3.5 text-slate-text">{{ $item->user?->name ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-center">
                        <form action="{{ route('web.kondisi-item.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus data kondisi item ini?')">
                            @csrf @method('DELETE')
                            <button class="p-1.5 rounded-lg hover:bg-rose-50 text-slate-text hover:text-danger-red transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-12 text-center text-slate-text">
                        <p class="text-sm font-medium">Belum ada data kondisi item</p>
                        <p class="text-xs mt-1">Klik "Tambah Pendataan" untuk menambahkan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Add Modal --}}
<div id="addKondisiModal" class="fixed inset-0 z-50 hidden bg-black/30 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6">
        <h3 class="text-lg font-semibold text-navy-text mb-4">Tambah Pendataan Kondisi</h3>
        <form action="{{ route('web.kondisi-item.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Barang</label>
                    <select name="barang_id" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                        <option value="">Pilih Barang</option>
                        @foreach($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama }} ({{ $barang->kategori?->nama ?? '-' }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-text mb-1.5">Jumlah Baik</label>
                        <input type="number" name="jumlah_baik" value="0" min="0" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-text mb-1.5">Jumlah Rusak</label>
                        <input type="number" name="jumlah_rusak" value="0" min="0" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-text mb-1.5">Jumlah Perbaikan</label>
                        <input type="number" name="jumlah_perbaikan" value="0" min="0" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Tanggal Pendataan</label>
                    <input type="date" name="tanggal_pendataan" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Keterangan</label>
                    <textarea name="keterangan" rows="2" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none"></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeModal('addKondisiModal')" class="px-4 py-2 text-sm font-medium text-slate-text hover:bg-slate-50 rounded-xl transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 bg-primary-blue text-white text-sm font-medium rounded-xl hover:bg-blue-600 transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
document.querySelectorAll('.fixed').forEach(el => { el.addEventListener('click', function(e) { if(e.target === this) this.classList.add('hidden'); }); });
</script>
@endpush
