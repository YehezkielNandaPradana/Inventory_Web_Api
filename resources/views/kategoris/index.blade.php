@extends('layouts.app')

@section('title', 'Kategori - Inventaris')

@section('content')
<div class="space-y-6">
    <!-- Header & Breadcrumb -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-poppins font-bold text-navy-text">Manajemen Kategori</h2>
            <p class="text-sm text-slate-text mt-1">Kelola dan kelompokkan inventaris barang dengan kategori yang terstruktur.</p>
        </div>
        <nav class="flex mt-3 sm:mt-0" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 text-xs">
                <li class="inline-flex items-center">
                    <a href="/" class="text-slate-text hover:text-primary-blue transition-colors">Dashboard</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-slate-300 mx-1" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path></svg>
                        <span class="text-primary-blue font-medium">Kategori</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Toolbar (Search & Tambah) -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white p-4 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.02)]">
        <!-- Search (Optional, bisa disesuaikan jika ada fitur pencarian kategori) -->
        <div class="relative flex-1 md:max-w-xs">
            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-text">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </span>
            <input type="text" id="kategori-search" placeholder="Cari nama kategori..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border-0 rounded-xl text-xs focus:ring-1.5 focus:ring-primary-blue transition-all">
        </div>
        
        <button type="button" onclick="openAddModal()" class="bg-primary-blue hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-sm transition-colors flex items-center space-x-1.5 shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>Tambah Kategori</span>
        </button>
    </div>

    <!-- Tabel Kategori -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] overflow-hidden">
        <div class="overflow-x-auto custom-scroll">
            <table class="w-full text-left text-sm min-w-[600px]">
                <thead class="bg-slate-50/80 backdrop-blur-sm text-slate-500 text-[11px] uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-semibold whitespace-nowrap">Nama Kategori</th>
                        <th class="px-6 py-4 font-semibold text-center whitespace-nowrap">Jumlah Barang</th>
                        <th class="px-6 py-4 font-semibold text-right whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($kategoris as $kategori)
                        <tr class="hover:bg-slate-50/70 transition-colors duration-150">
                            <td class="px-6 py-4 text-navy-text font-medium whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-light-blue-bg text-primary-blue flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                    </div>
                                    <span>{{ $kategori->nama }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                    {{ $kategori->barangs_count }} Barang
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <!-- Tombol Edit -->
                                    <button type="button" onclick='openEditModal({{ json_encode(['id' => $kategori->id, 'nama' => $kategori->nama]) }})' class="p-2 rounded-lg text-slate-400 hover:bg-light-blue-bg hover:text-primary-blue transition-colors duration-200" title="Edit Kategori">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4Z"/></svg>
                                    </button>
                                    <!-- Tombol Hapus -->
                                    <form action="/kategoris/{{ $kategori->id }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg text-slate-400 hover:bg-rose-50 hover:text-danger-red transition-colors duration-200" title="Hapus Kategori">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                    </svg>
                                    <div class="space-y-1">
                                        <h4 class="text-sm font-semibold text-navy-text">Belum Ada Kategori</h4>
                                        <p class="text-xs text-slate-text max-w-xs mx-auto">Mulai kelompokkan barang Anda dengan menambahkan kategori pertama.</p>
                                    </div>
                                    <button type="button" onclick="openAddModal()" class="mt-2 inline-flex bg-primary-blue hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-semibold transition-colors shadow-sm">
                                        + Tambah Kategori
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ================= MODAL: TAMBAH KATEGORI ================= -->
<div id="addKategoriModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto transform transition-transform duration-300 scale-95 opacity-0 custom-scroll" id="addKategoriModalContent">
        <div class="flex items-center justify-between p-5 border-b border-slate-100 sticky top-0 bg-white rounded-t-2xl z-10">
            <div>
                <h3 class="text-base font-poppins font-bold text-navy-text">Tambah Kategori Baru</h3>
                <p class="text-xs text-slate-text">Masukkan nama kategori dengan jelas.</p>
            </div>
            <button type="button" onclick="closeAddModal()" class="text-slate-text hover:text-danger-red transition-colors p-1.5 rounded-full hover:bg-slate-100">
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
                <button type="button" onclick="closeAddModal()" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-text bg-slate-50 hover:bg-slate-100 transition-colors">Batal</button>
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-semibold text-white bg-primary-blue hover:bg-blue-600 transition-colors shadow-md flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>Simpan Kategori</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL: EDIT KATEGORI ================= -->
<div id="editKategoriModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto transform transition-transform duration-300 scale-95 opacity-0 custom-scroll" id="editKategoriModalContent">
        <div class="flex items-center justify-between p-5 border-b border-slate-100 sticky top-0 bg-white rounded-t-2xl z-10">
            <div>
                <h3 class="text-base font-poppins font-bold text-navy-text">Edit Kategori</h3>
                <p class="text-xs text-slate-text">Perbarui nama kategori inventaris.</p>
            </div>
            <button type="button" onclick="closeEditModal()" class="text-slate-text hover:text-danger-red transition-colors p-1.5 rounded-full hover:bg-slate-100">
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
                <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-text bg-slate-50 hover:bg-slate-100 transition-colors">Batal</button>
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-semibold text-white bg-primary-blue hover:bg-blue-600 transition-colors shadow-md flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>Perbarui Kategori</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.4s ease-out forwards; }
    .custom-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>

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
    // LIVE SEARCH KATEGORI (Opsional jika dibutuhkan)
    // ==========================================
    const searchInput = document.getElementById('kategori-search');
    const tableRows = document.querySelectorAll('tbody tr');
    
    if(searchInput) {
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            let visibleCount = 0;
            
            tableRows.forEach(row => {
                if(row.cells.length < 3) return; // Skip empty state row
                const namaKategori = row.cells[0].textContent.toLowerCase();
                
                if(namaKategori.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }

    // ==========================================
    // AUTO REFRESH
    // ==========================================
    const refreshBar = document.createElement('div');
    refreshBar.id = 'auto-refresh-bar';
    refreshBar.innerHTML = `
        <div class="flex items-center gap-2 text-[10px] text-slate-text">
            <svg class="w-3 h-3 refresh-icon" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
            <span>Auto refresh in</span>
            <span id="refresh-countdown" class="font-bold text-primary-blue">30</span>
            <span>s</span>
            <button id="refresh-toggle" class="ml-1 p-1 rounded hover:bg-slate-100 transition-colors" title="Jeda auto-refresh">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"/></svg>
            </button>
        </div>
    `;
    refreshBar.className = 'fixed bottom-24 md:bottom-6 right-6 z-40 bg-white/90 backdrop-blur-sm border border-slate-200 rounded-xl px-3 py-2 shadow-lg flex items-center';
    document.body.appendChild(refreshBar);

    let refreshSeconds = 30;
    let refreshPaused = false;
    let refreshIcon = refreshBar.querySelector('.refresh-icon');

    setInterval(() => {
        if (refreshPaused) return;
        refreshSeconds--;
        document.getElementById('refresh-countdown').textContent = refreshSeconds;
        if(refreshSeconds <= 5) {
            refreshIcon.classList.add('animate-spin');
        }
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