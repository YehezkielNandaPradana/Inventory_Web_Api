@extends('layouts.app')

@section('title', 'Buat Serah Terima')

@section('content')
<div class="mb-6">
    <a href="{{ route('web.serah-terima.index') }}" class="text-sm text-slate-text hover:text-navy-text flex items-center gap-1.5 mb-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>
    <h2 class="text-2xl font-poppins font-semibold text-navy-text">Buat Serah Terima Baru</h2>
</div>

<form action="{{ route('web.serah-terima.store') }}" method="POST" id="serahTerimaForm">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-navy-text mb-4">Informasi Serah Terima</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-text mb-1.5">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                    </div>
                    <div></div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-text mb-1.5">Dari Pihak</label>
                        <input type="text" name="dari_pihak" required placeholder="Nama/Unit pengirim" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-text mb-1.5">Kepada Pihak</label>
                        <input type="text" name="kepada_pihak" required placeholder="Nama/Unit penerima" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-text mb-1.5">Dari User (Opsional)</label>
                        <select name="dari_user_id" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none bg-white">
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-text mb-1.5">Kepada User (Opsional)</label>
                        <select name="kepada_user_id" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none bg-white">
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Keterangan</label>
                    <textarea name="keterangan" rows="2" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none" placeholder="Catatan serah terima (opsional)"></textarea>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-navy-text mb-4">Ringkasan</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between"><span class="text-slate-text">Jumlah Item</span><span class="font-semibold" id="totalItems">0</span></div>
                    <div class="flex justify-between"><span class="text-slate-text">Total Barang</span><span class="font-semibold" id="totalQty">0</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-navy-text">Daftar Barang</h3>
            <button type="button" onclick="addItem()" class="px-3 py-1.5 bg-light-blue-bg text-primary-blue text-xs font-medium rounded-xl hover:bg-blue-100 transition-colors flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Item
            </button>
        </div>
        <div id="itemsContainer">
            <div class="text-center py-8 text-slate-text text-sm" id="emptyItems">Belum ada item. Klik "Tambah Item" untuk menambahkan barang.</div>
        </div>
        <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-slate-50">
            <a href="{{ route('web.serah-terima.index') }}" class="px-4 py-2 text-sm font-medium text-slate-text hover:bg-slate-50 rounded-xl transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2 bg-primary-blue text-white text-sm font-medium rounded-xl hover:bg-blue-600 transition-colors">Simpan Serah Terima</button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
let itemCount = 0;
const barangs = @json($barangs);

function addItem() {
    const container = document.getElementById('itemsContainer');
    document.getElementById('emptyItems')?.remove();

    const html = `
    <div class="item-row grid grid-cols-1 md:grid-cols-4 gap-3 p-4 bg-slate-50 rounded-xl mb-3 relative" data-index="${itemCount}">
        <div>
            <label class="block text-xs text-slate-text mb-1">Barang</label>
            <select name="items[${itemCount}][barang_id]" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none" onchange="updateStockInfo(this)">
                <option value="">Pilih Barang</option>
                ${barangs.map(b => `<option value="${b.id}" data-stok="${b.stok}" data-kode="${b.kode_barang || ''}">${b.nama} (${b.kode_barang || 'no code'})</option>`).join('')}
            </select>
        </div>
        <div>
            <label class="block text-xs text-slate-text mb-1">Jumlah</label>
            <input type="number" name="items[${itemCount}][jumlah]" min="1" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none" onchange="updateSummary()">
        </div>
        <div>
            <label class="block text-xs text-slate-text mb-1">Kondisi</label>
            <select name="items[${itemCount}][kondisi]" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none">
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>
            </select>
        </div>
        <div class="flex items-end">
            <button type="button" onclick="removeItem(this)" class="px-3 py-2 bg-rose-50 text-danger-red text-sm rounded-xl hover:bg-rose-100 transition-colors">Hapus</button>
        </div>
    </div>`;

    container.insertAdjacentHTML('beforeend', html);
    itemCount++;
}

function removeItem(btn) {
    btn.closest('.item-row').remove();
    updateSummary();
    if (document.querySelectorAll('.item-row').length === 0) {
        document.getElementById('itemsContainer').innerHTML = '<div class="text-center py-8 text-slate-text text-sm" id="emptyItems">Belum ada item. Klik "Tambah Item" untuk menambahkan barang.</div>';
    }
}

function updateSummary() {
    const items = document.querySelectorAll('.item-row');
    document.getElementById('totalItems').textContent = items.length;
    let total = 0;
    items.forEach(row => { const val = parseInt(row.querySelector('[name$="[jumlah]"]').value) || 0; total += val; });
    document.getElementById('totalQty').textContent = total;
}

function updateStockInfo(select) {
    const opt = select.options[select.selectedIndex];
    const stok = opt.dataset.stok || 0;
    const info = select.parentElement.querySelector('.stok-info') || document.createElement('p');
    info.className = 'text-xs text-slate-text mt-1 stok-info';
    info.textContent = `Stok tersedia: ${stok}`;
    select.parentElement.appendChild(info);
}
</script>
@endpush
