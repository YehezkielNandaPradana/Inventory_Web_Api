@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)]">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-base font-poppins font-semibold text-navy-text">Daftar Kategori</h3>
            <p class="text-xs text-slate-text mt-1">Kelola kategori barang untuk mengelompokkan inventaris.</p>
        </div>
        <button type="button" onclick="openAddModal()" class="bg-primary-blue hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-sm transition-colors flex items-center space-x-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>Tambah Kategori</span>
        </button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead>
                <tr>
                    <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Nama Kategori</th>
                    <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Jumlah Barang</th>
                    <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($kategoris as $kategori)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-3.5 pr-3">
                            <div class="font-medium text-xs text-navy-text">{{ $kategori->nama }}</div>
                        </td>
                        <td class="py-3.5 pr-3 text-xs text-slate-text">
                            {{ $kategori->barangs_count }} barang
                        </td>
                        <td class="py-3.5 text-xs font-medium">
                            <div class="flex items-center space-x-3">
                                <button type="button" onclick='openEditModal({{ json_encode(['id' => $kategori->id, 'nama' => $kategori->nama]) }})' class="text-primary-blue hover:text-blue-600 font-semibold transition-colors flex items-center space-x-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4Z"/></svg>
                                    <span>Edit</span>
                                </button>
                                <form action="/kategoris/{{ $kategori->id }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger-red hover:text-rose-600 font-semibold transition-colors flex items-center space-x-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-6 text-center text-xs text-slate-text">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ================= MODAL: TAMBAH KATEGORI ================= -->
<div id="addKategoriModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto transform transition-transform duration-300 scale-95 opacity-0" id="addKategoriModalContent">
        <div class="flex items-center justify-between p-5 border-b border-slate-100 sticky top-0 bg-white rounded-t-2xl z-10">
            <h3 class="text-base font-poppins font-semibold text-navy-text">Tambah Kategori Baru</h3>
            <button type="button" onclick="closeAddModal()" class="text-slate-text hover:text-danger-red transition-colors p-1 rounded-full hover:bg-slate-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form action="/kategoris" method="POST" class="p-5 space-y-4">
            @csrf
            <div>
                <label for="add_nama" class="block text-xs font-semibold text-slate-text mb-1.5">Nama Kategori <span class="text-danger-red">*</span></label>
                <input type="text" name="nama" id="add_nama" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all" placeholder="Contoh: Elektronik">
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-text bg-slate-50 hover:bg-slate-100 transition-colors">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-white bg-primary-blue hover:bg-blue-600 transition-colors shadow-sm flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL: EDIT KATEGORI ================= -->
<div id="editKategoriModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto transform transition-transform duration-300 scale-95 opacity-0" id="editKategoriModalContent">
        <div class="flex items-center justify-between p-5 border-b border-slate-100 sticky top-0 bg-white rounded-t-2xl z-10">
            <h3 class="text-base font-poppins font-semibold text-navy-text">Edit Kategori</h3>
            <button type="button" onclick="closeEditModal()" class="text-slate-text hover:text-danger-red transition-colors p-1 rounded-full hover:bg-slate-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form id="editKategoriForm" method="POST" class="p-5 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="edit_nama" class="block text-xs font-semibold text-slate-text mb-1.5">Nama Kategori <span class="text-danger-red">*</span></label>
                <input type="text" name="nama" id="edit_nama" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all">
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-text bg-slate-50 hover:bg-slate-100 transition-colors">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-white bg-primary-blue hover:bg-blue-600 transition-colors shadow-sm flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>Perbarui</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // ==========================================
    // MODAL TAMBAH KATEGORI
    // ==========================================
    window.openAddModal = function() {
        const modal = document.getElementById('addKategoriModal');
        const modalContent = document.getElementById('addKategoriModalContent');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.classList.add('bg-black/50');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    window.closeAddModal = function() {
        const modal = document.getElementById('addKategoriModal');
        const modalContent = document.getElementById('addKategoriModalContent');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }, 300);
    }

    document.getElementById('addKategoriModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeAddModal();
    });

    // ==========================================
    // MODAL EDIT KATEGORI
    // ==========================================
    window.openEditModal = function(data) {
        const modal = document.getElementById('editKategoriModal');
        const modalContent = document.getElementById('editKategoriModalContent');

        document.getElementById('editKategoriForm').action = `/kategoris/${data.id}`;
        document.getElementById('edit_nama').value = data.nama;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.classList.add('bg-black/50');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    window.closeEditModal = function() {
        const modal = document.getElementById('editKategoriModal');
        const modalContent = document.getElementById('editKategoriModalContent');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }, 300);
    }

    document.getElementById('editKategoriModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (!document.getElementById('addKategoriModal').classList.contains('hidden')) closeAddModal();
            if (!document.getElementById('editKategoriModal').classList.contains('hidden')) closeEditModal();
        }
    });

    // ==========================================
    // AUTO REFRESH
    // ==========================================
    const refreshBar = document.createElement('div');
    refreshBar.id = 'auto-refresh-bar';
    refreshBar.innerHTML = `
        <div class="flex items-center gap-2 text-[10px] text-slate-text">
            <svg class="w-3 h-3 refresh-icon" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
            <span id="refresh-countdown">30</span>
            <span>detik</span>
            <button id="refresh-toggle" class="ml-1 p-0.5 rounded hover:bg-slate-100 transition-colors" title="Jeda auto-refresh">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"/></svg>
            </button>
        </div>
    `;
    refreshBar.className = 'fixed bottom-24 md:bottom-6 right-6 z-50 bg-white/90 backdrop-blur-sm border border-slate-200 rounded-lg px-3 py-1.5 shadow-md';
    document.body.appendChild(refreshBar);

    let refreshSeconds = 30;
    let refreshPaused = false;
    let refreshIcon = refreshBar.querySelector('.refresh-icon');

    setInterval(() => {
        if (refreshPaused) return;
        refreshSeconds--;
        document.getElementById('refresh-countdown').textContent = refreshSeconds;
        refreshIcon.classList.add('animate-spin');
        if (refreshSeconds <= 0) {
            location.reload();
        }
    }, 1000);

    document.getElementById('refresh-toggle').addEventListener('click', () => {
        refreshPaused = !refreshPaused;
        refreshSeconds = 30;
        document.getElementById('refresh-countdown').textContent = refreshSeconds;
        const icon = document.getElementById('refresh-toggle').querySelector('svg');
        if (refreshPaused) {
            icon.innerHTML = '<polyline points="6 4 20 12 6 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>';
            document.getElementById('refresh-toggle').title = 'Lanjutkan auto-refresh';
        } else {
            icon.innerHTML = '<path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"/>';
            document.getElementById('refresh-toggle').title = 'Jeda auto-refresh';
        }
    });
});
</script>
<style>
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .animate-spin {
        animation: spin 1s linear infinite;
    }
</style>
@endsection