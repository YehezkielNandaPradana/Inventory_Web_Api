@extends('layouts.app')

@section('title', 'Gudang')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-2xl font-poppins font-semibold text-navy-text">Gudang</h2>
        <p class="text-sm text-slate-text">Kelola data gudang penyimpanan</p>
    </div>
    <button onclick="openModal('addGudangModal')" class="px-4 py-2 bg-primary-blue text-white rounded-xl text-sm font-medium hover:bg-blue-600 transition-colors flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Gudang
    </button>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-text text-xs uppercase tracking-wider">
                <tr>
                    <th class="text-left px-4 py-3 font-semibold">Kode</th>
                    <th class="text-left px-4 py-3 font-semibold">Nama Gudang</th>
                    <th class="text-left px-4 py-3 font-semibold">Lokasi</th>
                    <th class="text-center px-4 py-3 font-semibold">Jumlah Barang</th>
                    <th class="text-center px-4 py-3 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($gudangs as $gudang)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3.5 font-mono text-xs font-medium text-primary-blue">{{ $gudang->kode }}</td>
                    <td class="px-4 py-3.5 font-medium text-navy-text">{{ $gudang->nama }}</td>
                    <td class="px-4 py-3.5 text-slate-text">{{ $gudang->lokasi ?? '-' }}</td>
                    <td class="px-4 py-3.5 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-light-blue-bg text-primary-blue">{{ $gudang->barangs_count }}</span>
                    </td>
                    <td class="px-4 py-3.5">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="editGudang({{ $gudang->id }}, '{{ $gudang->kode }}', '{{ $gudang->nama }}', '{{ $gudang->lokasi ?? '' }}', '{{ addslashes($gudang->keterangan ?? '') }}')" class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-text transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form action="{{ route('web.gudang.destroy', $gudang) }}" method="POST" onsubmit="return confirm('Hapus gudang {{ $gudang->nama }}?')">
                                @csrf @method('DELETE')
                                <button class="p-1.5 rounded-lg hover:bg-rose-50 text-slate-text hover:text-danger-red transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-12 text-center text-slate-text">
                        <p class="text-sm font-medium">Belum ada gudang</p>
                        <p class="text-xs mt-1">Klik "Tambah Gudang" untuk menambahkan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Add Modal --}}
<div id="addGudangModal" class="fixed inset-0 z-50 hidden bg-black/30 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <h3 class="text-lg font-semibold text-navy-text mb-4">Tambah Gudang</h3>
        <form action="{{ route('web.gudang.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Kode Gudang</label>
                    <input type="text" name="kode" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Nama Gudang</label>
                    <input type="text" name="nama" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Lokasi</label>
                    <input type="text" name="lokasi" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Keterangan</label>
                    <textarea name="keterangan" rows="2" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none"></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeModal('addGudangModal')" class="px-4 py-2 text-sm font-medium text-slate-text hover:bg-slate-50 rounded-xl transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 bg-primary-blue text-white text-sm font-medium rounded-xl hover:bg-blue-600 transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div id="editGudangModal" class="fixed inset-0 z-50 hidden bg-black/30 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <h3 class="text-lg font-semibold text-navy-text mb-4">Edit Gudang</h3>
        <form id="editGudangForm" method="POST">
            @csrf @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Kode Gudang</label>
                    <input type="text" name="kode" id="edit_kode" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Nama Gudang</label>
                    <input type="text" name="nama" id="edit_nama" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Lokasi</label>
                    <input type="text" name="lokasi" id="edit_lokasi" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Keterangan</label>
                    <textarea name="keterangan" id="edit_keterangan" rows="2" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none"></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeModal('editGudangModal')" class="px-4 py-2 text-sm font-medium text-slate-text hover:bg-slate-50 rounded-xl transition-colors">Batal</button>
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
function editGudang(id, kode, nama, lokasi, keterangan) {
    document.getElementById('edit_kode').value = kode;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_lokasi').value = lokasi;
    document.getElementById('edit_keterangan').value = keterangan;
    document.getElementById('editGudangForm').action = '/gudang/' + id;
    openModal('editGudangModal');
}
document.querySelectorAll('.fixed').forEach(el => { el.addEventListener('click', function(e) { if(e.target === this) this.classList.add('hidden'); }); });
</script>
@endpush
