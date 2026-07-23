@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="space-y-6">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.06)] flex items-center space-x-4 transition-transform duration-300 hover:-translate-y-1">
            <div class="w-11 h-11 rounded-xl bg-light-blue-bg flex items-center justify-center text-primary-blue shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                    <line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-slate-text tracking-wide uppercase">Total Barang</p>
                <p class="text-xl font-poppins font-semibold text-navy-text mt-0.5">{{ $total_barang }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.06)] flex items-center space-x-4 transition-transform duration-300 hover:-translate-y-1">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center text-success-green shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-slate-text tracking-wide uppercase">Stok Aman</p>
                <p class="text-xl font-poppins font-semibold text-navy-text mt-0.5">{{ $stok_aman }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.06)] flex items-center space-x-4 transition-transform duration-300 hover:-translate-y-1">
            <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center text-warning-amber shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-slate-text tracking-wide uppercase">Stok Menipis</p>
                <p class="text-xl font-poppins font-semibold text-navy-text mt-0.5">{{ $stok_menipis_aktif }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.06)] flex items-center space-x-4 transition-transform duration-300 hover:-translate-y-1">
            <div class="w-11 h-11 rounded-xl bg-rose-50 flex items-center justify-center text-danger-red shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="15" y1="9" x2="9" y2="15"/>
                    <line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-slate-text tracking-wide uppercase">Stok Habis</p>
                <p class="text-xl font-poppins font-semibold text-navy-text mt-0.5">{{ $stok_habis }}</p>
            </div>
        </div>
    </div>

    <!-- Toolbar (Tab Filter + Search + Tambah) -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white p-4 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.02)]">
        <!-- Tab Pills -->
        <div class="flex flex-wrap gap-2">
            <button data-tab="Semua" class="tab-button px-4 py-2 rounded-full text-xs font-semibold transition-all bg-primary-blue text-white shadow-sm">
                Semua
            </button>
            <button data-tab="Stok Aman" class="tab-button px-4 py-2 rounded-full text-xs font-semibold transition-all bg-slate-50 text-slate-text hover:bg-slate-100">
                Stok Aman
            </button>
            <button data-tab="Stok Menipis" class="tab-button px-4 py-2 rounded-full text-xs font-semibold transition-all bg-slate-50 text-slate-text hover:bg-slate-100">
                Stok Menipis
            </button>
            <button data-tab="Stok Habis" class="tab-button px-4 py-2 rounded-full text-xs font-semibold transition-all bg-slate-50 text-slate-text hover:bg-slate-100">
                Stok Habis
            </button>
        </div>

        <!-- Search & Add Button -->
        <div class="flex items-center gap-3">
            <div class="relative flex-1 md:w-64">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-text">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </span>
                <input type="text" id="barang-search" placeholder="Cari di daftar..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border-0 rounded-xl text-xs focus:ring-1.5 focus:ring-primary-blue transition-all">
            </div>
            <button type="button" onclick="openAddModal()" class="bg-primary-blue hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-semibold transition-colors flex items-center space-x-1.5 shadow-sm shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span>Tambah Barang</span>
            </button>
        </div>
    </div>

    <!-- 2 Column Layout (List + Detail) -->
    @if($barangs->isEmpty())
        <!-- Empty State -->
        <div class="bg-white border-2 border-dashed border-slate-200 rounded-3xl p-12 text-center max-w-lg mx-auto my-12 space-y-4">
            <div class="w-16 h-16 bg-light-blue-bg text-sky-blue rounded-full flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                    <line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
            </div>
            <div class="space-y-1">
                <h3 class="text-base font-poppins font-semibold text-navy-text">Belum ada barang</h3>
                <p class="text-xs text-slate-text max-w-xs mx-auto">Mulai kelola inventaris sekolah dengan menambahkan barang pertama Anda.</p>
            </div>
            <button type="button" onclick="openAddModal()" class="inline-flex bg-primary-blue hover:bg-blue-600 text-white px-5 py-2.5 rounded-xl text-xs font-semibold transition-colors shadow-sm">
                Tambah Barang Pertama
            </button>
        </div>
    @else
        <div class="lg:flex lg:items-start lg:space-x-6">
            <!-- Left Column: Item Grid -->
            <div class="flex-1">
                <div id="barang-grid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                    @foreach($barangs as $barang)
                        @php
                            $max_val = max($barang->stok_minimum * 2, 10, $barang->stok);
                            $percentage = $max_val > 0 ? ($barang->stok / $max_val) * 100 : 0;

                            $border_color = 'border-l-success-green';
                            $bar_color = 'bg-success-green';
                            if ($barang->status === 'Habis') {
                                $border_color = 'border-l-danger-red';
                                $bar_color = 'bg-danger-red';
                            } elseif ($barang->status === 'Menipis') {
                                $border_color = 'border-l-warning-amber';
                                $bar_color = 'bg-warning-amber';
                            }
                        @endphp

                        <div data-id="{{ $barang->id }}"
                             data-nama="{{ $barang->nama }}"
                             data-kategori="{{ $barang->kategori->nama ?? '-' }}"
                             data-kategori-id="{{ $barang->kategori_id }}"
                             data-stok="{{ $barang->stok }}"
                             data-stok-minimum="{{ $barang->stok_minimum }}"
                             data-status="{{ $barang->status }}"
                             data-gambar="{{ $barang->gambar }}"
                             class="barang-card bg-white p-5 rounded-2xl border-l-4 {{ $border_color }} border-y border-r border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.03)] cursor-pointer transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_12px_40px_rgba(45,125,210,0.06)] flex flex-col justify-between h-40 opacity-0 animate-fade-in-up">

                            <div class="space-y-1">
                                <span class="text-[10px] font-semibold text-slate-text uppercase tracking-wider block">
                                    {{ $barang->kategori->nama ?? '-' }}
                                </span>
                                <h4 class="text-sm font-poppins font-semibold text-navy-text leading-snug line-clamp-2">
                                    {{ $barang->nama }}
                                </h4>
                            </div>

                            <div class="space-y-3 mt-4">
                                <!-- Progress bar & count -->
                                <div class="space-y-1.5">
                                    <div class="flex items-center justify-between text-[11px]">
                                        <span class="text-slate-text">Stok</span>
                                        <span class="font-bold text-navy-text">{{ $barang->stok }} <span class="text-[9px] text-slate-text font-medium">/ {{ $barang->stok_minimum }} min</span></span>
                                    </div>
                                    <div class="h-2 w-full bg-light-blue-bg rounded-full overflow-hidden">
                                        <div class="h-full {{ $bar_color }} rounded-full transition-all duration-500" style="width: {{ min(100, $percentage) }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- No Results Empty State (Hidden by default) -->
                <div id="no-filter-results" class="hidden bg-white rounded-2xl p-12 text-center border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.02)]">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <p class="text-sm text-slate-text">Tidak ada barang yang cocok dengan filter atau pencarian Anda.</p>
                </div>
            </div>

            <!-- Right Column: Detail Panel (Desktop Sticky) -->
            <div id="detail-panel" class="hidden lg:block w-[340px] shrink-0 bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.05)] sticky top-24">
                <div id="desktop-detail-content" class="min-h-[300px] flex flex-col justify-center items-center text-center text-slate-text space-y-3">
                    <svg class="w-12 h-12 text-light-blue-bg stroke-sky-blue" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    </svg>
                    <p class="text-xs">Pilih salah satu barang untuk melihat detail dan mengelola stok.</p>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Scrim for Bottom Sheet -->
<div id="scrim" class="fixed inset-0 bg-black/40 backdrop-blur-xs z-40 hidden transition-opacity duration-300 opacity-0"></div>

<!-- Bottom Sheet (Tablet/Mobile) -->
<div id="bottom-sheet" class="fixed inset-x-0 bottom-0 max-h-[85vh] bg-white rounded-t-3xl border-t border-slate-100 z-50 transform translate-y-full transition-transform duration-300 ease-out overflow-y-auto shadow-2xl pb-10">
    <div class="w-12 h-1 bg-slate-200 rounded-full mx-auto my-3 cursor-pointer" id="bottom-sheet-drag"></div>
    <div class="px-6 pb-6 pt-2" id="bottom-sheet-content">
        <!-- Filled dynamically -->
    </div>
</div>

<!-- ================= MODAL: TAMBAH BARANG ================= -->
<div id="addBarangModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto transform transition-transform duration-300 scale-95 opacity-0" id="addBarangModalContent">
        <div class="flex items-center justify-between p-5 border-b border-slate-100 sticky top-0 bg-white rounded-t-2xl z-10">
            <h3 class="text-base font-poppins font-semibold text-navy-text">Tambah Barang Baru</h3>
            <button type="button" onclick="closeAddModal()" class="text-slate-text hover:text-danger-red transition-colors p-1 rounded-full hover:bg-slate-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form action="/barangs" method="POST" class="p-5 space-y-4">
            @csrf
            <div>
                <label for="add_nama" class="block text-xs font-semibold text-slate-text mb-1.5">Nama Barang <span class="text-danger-red">*</span></label>
                <input type="text" name="nama" id="add_nama" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all" placeholder="Contoh: Proyektor Epson">
            </div>
            <div>
                <label for="add_kategori_id" class="block text-xs font-semibold text-slate-text mb-1.5">Kategori <span class="text-danger-red">*</span></label>
                <select name="kategori_id" id="add_kategori_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="add_stok" class="block text-xs font-semibold text-slate-text mb-1.5">Stok Awal <span class="text-danger-red">*</span></label>
                    <input type="number" name="stok" id="add_stok" required min="0" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all" placeholder="0">
                </div>
                <div>
                    <label for="add_stok_minimum" class="block text-xs font-semibold text-slate-text mb-1.5">Stok Minimum <span class="text-danger-red">*</span></label>
                    <input type="number" name="stok_minimum" id="add_stok_minimum" required min="0" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all" placeholder="0">
                </div>
            </div>
            <div>
                <label for="add_gambar" class="block text-xs font-semibold text-slate-text mb-1.5">Gambar (URL)</label>
                <input type="url" name="gambar" id="add_gambar" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all" placeholder="https://example.com/gambar.jpg">
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-text bg-slate-50 hover:bg-slate-100 transition-colors">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-white bg-primary-blue hover:bg-blue-600 transition-colors shadow-sm flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>Simpan Barang</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL: EDIT BARANG ================= -->
<div id="editBarangModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto transform transition-transform duration-300 scale-95 opacity-0" id="editBarangModalContent">
        <div class="flex items-center justify-between p-5 border-b border-slate-100 sticky top-0 bg-white rounded-t-2xl z-10">
            <h3 class="text-base font-poppins font-semibold text-navy-text">Edit Barang</h3>
            <button type="button" onclick="closeEditModal()" class="text-slate-text hover:text-danger-red transition-colors p-1 rounded-full hover:bg-slate-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form id="editBarangForm" method="POST" class="p-5 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="edit_nama" class="block text-xs font-semibold text-slate-text mb-1.5">Nama Barang <span class="text-danger-red">*</span></label>
                <input type="text" name="nama" id="edit_nama" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all">
            </div>
            <div>
                <label for="edit_kategori_id" class="block text-xs font-semibold text-slate-text mb-1.5">Kategori <span class="text-danger-red">*</span></label>
                <select name="kategori_id" id="edit_kategori_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="edit_stok" class="block text-xs font-semibold text-slate-text mb-1.5">Stok <span class="text-danger-red">*</span></label>
                    <input type="number" name="stok" id="edit_stok" required min="0" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all">
                </div>
                <div>
                    <label for="edit_stok_minimum" class="block text-xs font-semibold text-slate-text mb-1.5">Stok Minimum <span class="text-danger-red">*</span></label>
                    <input type="number" name="stok_minimum" id="edit_stok_minimum" required min="0" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all">
                </div>
            </div>
            <div>
                <label for="edit_gambar" class="block text-xs font-semibold text-slate-text mb-1.5">Gambar (URL)</label>
                <input type="url" name="gambar" id="edit_gambar" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all" placeholder="https://example.com/gambar.jpg">
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-text bg-slate-50 hover:bg-slate-100 transition-colors">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-white bg-primary-blue hover:bg-blue-600 transition-colors shadow-sm flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>Perbarui Barang</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.4s ease-out forwards;
    }

    @media (prefers-reduced-motion: reduce) {
        .animate-fade-in-up {
            animation: none;
            opacity: 1;
        }
        .barang-card {
            transition: none !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const csrfToken = "{{ csrf_token() }}";
        const cards = document.querySelectorAll('.barang-card');
        const scrim = document.getElementById('scrim');
        const bottomSheet = document.getElementById('bottom-sheet');
        const bottomSheetContent = document.getElementById('bottom-sheet-content');
        const desktopContent = document.getElementById('desktop-detail-content');

        let activeId = null;

        // Staggered fade-in for cards
        cards.forEach((card, index) => {
            card.style.animationDelay = `${Math.min(index * 0.04, 0.24)}s`;
        });

        // Render function
        function renderDetailContent(id, name, category, stok, stokMin, status, gambar, kategoriId) {
            const maxVal = Math.max(stokMin * 2, 10, stok);
            const percentage = maxVal > 0 ? (stok / maxVal) * 100 : 0;

            let statusBadge = '';
            let barColor = 'bg-success-green';

            if (status === 'Habis') {
                statusBadge = `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-danger-red border border-rose-100">Stok Habis</span>`;
                barColor = 'bg-danger-red';
            } else if (status === 'Menipis') {
                statusBadge = `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-warning-amber border border-amber-100">Stok Menipis</span>`;
                barColor = 'bg-warning-amber';
            } else {
                statusBadge = `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-success-green border border-emerald-100">Stok Aman</span>`;
            }

            return `
                <div class="space-y-6">
                    <!-- Image -->
                    <div class="h-44 w-full bg-slate-50 rounded-2xl overflow-hidden flex items-center justify-center border border-slate-100 relative">
                        <img src="${gambar || ''}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" class="h-full w-full object-cover">
                        <div class="hidden absolute inset-0 bg-slate-50 flex items-center justify-center text-sky-blue">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="text-left">
                        <span class="text-[10px] font-semibold text-slate-text tracking-wide uppercase">${category}</span>
                        <h3 class="text-base font-poppins font-semibold text-navy-text mt-1 leading-snug">${name}</h3>
                        <div class="mt-2.5">${statusBadge}</div>
                    </div>

                    <!-- Capsule Bar Besar -->
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 space-y-3">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-medium text-slate-text">Stok Saat Ini</span>
                            <span class="font-bold text-navy-text">${stok} <span class="text-[10px] text-slate-text font-medium">/ ${stokMin * 2 || 10}</span></span>
                        </div>
                        <div class="h-2.5 w-full bg-light-blue-bg rounded-full overflow-hidden">
                            <div class="h-full ${barColor} rounded-full transition-all duration-500" style="width: ${Math.min(100, percentage)}%"></div>
                        </div>
                        <div class="flex justify-between text-[10px] text-slate-text">
                            <span>Minimum: ${stokMin}</span>
                            <span>Status: ${status}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-3">
                        <form action="/stok-movements" method="POST">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="barang_id" value="${id}">
                            <input type="hidden" name="tipe" value="keluar">
                            <input type="hidden" name="jumlah" value="1">
                            <input type="hidden" name="keterangan" value="Pengurangan cepat dari detail panel">
                            <button type="submit" ${stok <= 0 ? 'disabled' : ''} class="w-full bg-primary-blue hover:bg-blue-600 disabled:bg-slate-200 disabled:cursor-not-allowed text-white py-3 px-4 rounded-xl text-xs font-semibold transition-colors shadow-sm flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                <span>Kurangi Stok (1)</span>
                            </button>
                        </form>

                        <div class="grid grid-cols-2 gap-3">
                            <button type="button" onclick='openEditModal(${JSON.stringify({id, name, kategoriId, stok, stokMin, gambar})})' class="flex items-center justify-center space-x-1.5 border border-slate-200 hover:bg-slate-50 text-slate-text py-2.5 px-4 rounded-xl text-[11px] font-semibold transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4Z"/></svg>
                                <span>Edit Barang</span>
                            </button>

                            <form action="/barangs/${id}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="w-full flex items-center justify-center space-x-1.5 border border-rose-100 hover:bg-rose-50 text-danger-red py-2.5 px-4 rounded-xl text-[11px] font-semibold transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            `;
        }

        function openBottomSheet() {
            scrim.classList.remove('hidden');
            setTimeout(() => {
                scrim.classList.remove('opacity-0');
                bottomSheet.classList.remove('translate-y-full');
            }, 10);
        }

        function closeBottomSheet() {
            bottomSheet.classList.add('translate-y-full');
            scrim.classList.add('opacity-0');
            setTimeout(() => {
                scrim.classList.add('hidden');
            }, 300);
        }

        scrim.addEventListener('click', closeBottomSheet);
        document.getElementById('bottom-sheet-drag')?.addEventListener('click', closeBottomSheet);

        function selectItem(id) {
            const card = document.querySelector(`.barang-card[data-id="${id}"]`);
            if (!card) return;

            activeId = id;

            // Manage classes
            cards.forEach(c => {
                c.classList.remove('border-primary-blue', 'ring-1', 'ring-primary-blue', 'bg-blue-50/10');
                c.classList.add('border-slate-100');
            });
            card.classList.add('border-primary-blue', 'ring-1', 'ring-primary-blue', 'bg-blue-50/10');
            card.classList.remove('border-slate-100');

            const name = card.dataset.nama;
            const category = card.dataset.kategori;
            const stok = parseInt(card.dataset.stok);
            const stokMin = parseInt(card.dataset.stokMinimum);
            const status = card.dataset.status;
            const gambar = card.dataset.gambar;
            const kategoriId = card.dataset.kategoriId;
            const htmlContent = renderDetailContent(id, name, category, stok, stokMin, status, gambar, kategoriId);

            // Update desktop panel content
            if (desktopContent) {
                desktopContent.innerHTML = htmlContent;
            }

            // Update bottom sheet content
            if (bottomSheetContent) {
                bottomSheetContent.innerHTML = htmlContent;
            }

            // If <= 1080px, open bottom sheet
            if (window.innerWidth <= 1080) {
                openBottomSheet();
            }
        }

        // Attach click listener to each card
        cards.forEach(card => {
            card.addEventListener('click', () => {
                selectItem(card.dataset.id);
            });
        });

        // Select first card on desktop load
        if (window.innerWidth > 1080 && cards.length > 0) {
            selectItem(cards[0].dataset.id);
        }

        // Real-time client-side filter
        const searchInput = document.getElementById('barang-search');
        const tabButtons = document.querySelectorAll('.tab-button');
        let currentTab = 'Semua';
        let searchQuery = '';

        function filterItems() {
            let visibleCount = 0;
            cards.forEach(card => {
                const name = card.dataset.nama.toLowerCase();
                const status = card.dataset.status; // Aman, Menipis, Habis

                const matchesSearch = name.includes(searchQuery);
                const matchesTab = currentTab === 'Semua' ||
                                   (currentTab === 'Stok Aman' && status === 'Aman') ||
                                   (currentTab === 'Stok Menipis' && status === 'Menipis') ||
                                   (currentTab === 'Stok Habis' && status === 'Habis');

                if (matchesSearch && matchesTab) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const emptyFilter = document.getElementById('no-filter-results');
            if (visibleCount === 0) {
                emptyFilter.classList.remove('hidden');
            } else {
                emptyFilter.classList.add('hidden');
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                searchQuery = e.target.value.toLowerCase();
                filterItems();
            });
        }

        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                tabButtons.forEach(b => {
                    b.classList.remove('bg-primary-blue', 'text-white', 'shadow-sm');
                    b.classList.add('bg-slate-50', 'text-slate-text', 'hover:bg-slate-100');
                });
                btn.classList.remove('bg-slate-50', 'text-slate-text', 'hover:bg-slate-100');
                btn.classList.add('bg-primary-blue', 'text-white', 'shadow-sm');

                currentTab = btn.dataset.tab;
                filterItems();
            });
        });

        // ==========================================
        // MODAL LOGIC (TAMBAH BARANG)
        // ==========================================
        window.openAddModal = function() {
            const modal = document.getElementById('addBarangModal');
            const modalContent = document.getElementById('addBarangModalContent');
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
            const modal = document.getElementById('addBarangModal');
            const modalContent = document.getElementById('addBarangModalContent');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = '';
            }, 300);
        }

        document.getElementById('addBarangModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeAddModal();
        });

        // ==========================================
        // MODAL LOGIC (EDIT BARANG)
        // ==========================================
        window.openEditModal = function(data) {
            const modal = document.getElementById('editBarangModal');
            const modalContent = document.getElementById('editBarangModalContent');

            document.getElementById('editBarangForm').action = `/barangs/${data.id}`;
            document.getElementById('edit_nama').value = data.name;
            document.getElementById('edit_kategori_id').value = data.kategoriId;
            document.getElementById('edit_stok').value = data.stok;
            document.getElementById('edit_stok_minimum').value = data.stokMin;
            document.getElementById('edit_gambar').value = data.gambar || '';

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
            const modal = document.getElementById('editBarangModal');
            const modalContent = document.getElementById('editBarangModalContent');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = '';
            }, 300);
        }

        document.getElementById('editBarangModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeEditModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (!document.getElementById('addBarangModal').classList.contains('hidden')) closeAddModal();
                if (!document.getElementById('editBarangModal').classList.contains('hidden')) closeEditModal();
            }
        });

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