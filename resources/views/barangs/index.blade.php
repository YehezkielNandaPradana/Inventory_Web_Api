@extends('layouts.app')

@section('title', 'Daftar Barang - Inventaris')

@section('content')
<div class="space-y-6">
    <!-- Header & Breadcrumb -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-poppins font-bold text-navy-text">Manajemen Inventaris</h2>
            <p class="text-sm text-slate-text mt-1">Kelola, pantau, dan lacak seluruh aset dan barang sekolah dengan mudah.</p>
        </div>
        <nav class="flex mt-3 sm:mt-0" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 text-xs">
                <li class="inline-flex items-center">
                    <a href="/" class="text-slate-text hover:text-primary-blue transition-colors">Dashboard</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-slate-300 mx-1" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path></svg>
                        <span class="text-primary-blue font-medium">Daftar Barang</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Quick Access Menu (Pengganti Stat Cards) -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
        <!-- Menu: Kategori -->
        <a href="/kategoris" class="group bg-white p-4 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] flex flex-col items-center text-center space-y-2 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(45,125,210,0.1)]">
            <div class="w-10 h-10 rounded-xl bg-light-blue-bg flex items-center justify-center text-primary-blue group-hover:bg-primary-blue group-hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            </div>
            <span class="text-xs font-semibold text-navy-text">Kategori</span>
        </a>
        
        <!-- Menu: Riwayat Stok -->
        <a href="/stok-movements" class="group bg-white p-4 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] flex flex-col items-center text-center space-y-2 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(45,125,210,0.1)]">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-success-green group-hover:bg-success-green group-hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
            </div>
            <span class="text-xs font-semibold text-navy-text">Riwayat Stok</span>
        </a>

        <!-- Menu: Peminjaman -->
        <a href="/peminjaman" class="group bg-white p-4 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] flex flex-col items-center text-center space-y-2 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(45,125,210,0.1)]">
            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-warning-amber group-hover:bg-warning-amber group-hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <span class="text-xs font-semibold text-navy-text">Peminjaman</span>
        </a>

        <!-- Menu: Laporan -->
        <a href="/laporan" class="group bg-white p-4 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] flex flex-col items-center text-center space-y-2 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(45,125,210,0.1)]">
            <div class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center text-danger-red group-hover:bg-danger-red group-hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <span class="text-xs font-semibold text-navy-text">Laporan</span>
        </a>

        <!-- Menu: Supplier -->
        <a href="/supplier" class="group bg-white p-4 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] flex flex-col items-center text-center space-y-2 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(45,125,210,0.1)]">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-500 group-hover:bg-indigo-500 group-hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 7l9-4 9 4M4 10v10a1 1 0 001 1h14a1 1 0 001-1V10M9 21V12h6v9"/></svg>
            </div>
            <span class="text-xs font-semibold text-navy-text">Supplier</span>
        </a>

        <!-- Menu: Pengaturan -->
        <a href="/settings" class="group bg-white p-4 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] flex flex-col items-center text-center space-y-2 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(45,125,210,0.1)]">
            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 group-hover:bg-slate-800 group-hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="text-xs font-semibold text-navy-text">Pengaturan</span>
        </a>
    </div>

    <!-- Toolbar (Tab Filter + Search + Tambah + Export) -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 bg-white p-4 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.02)]">
        <div class="flex flex-wrap gap-2">
            <button data-tab="Semua" class="tab-button px-4 py-2 rounded-full text-xs font-semibold transition-all bg-primary-blue text-white shadow-sm flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Semua
            </button>
            <button data-tab="Stok Aman" class="tab-button px-4 py-2 rounded-full text-xs font-semibold transition-all bg-slate-50 text-slate-text hover:bg-slate-100 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-success-green"></span> Stok Aman
            </button>
            <button data-tab="Stok Menipis" class="tab-button px-4 py-2 rounded-full text-xs font-semibold transition-all bg-slate-50 text-slate-text hover:bg-slate-100 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-warning-amber"></span> Stok Menipis
            </button>
            <button data-tab="Stok Habis" class="tab-button px-4 py-2 rounded-full text-xs font-semibold transition-all bg-slate-50 text-slate-text hover:bg-slate-100 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-danger-red"></span> Stok Habis
            </button>
        </div>

        <div class="flex items-center gap-3 flex-wrap">
            <!-- Category Filter -->
            <div class="relative flex-1 md:w-48">
                <select id="kategori-filter" class="w-full pl-4 pr-8 py-2 bg-slate-50 border-0 rounded-xl text-xs focus:ring-1.5 focus:ring-primary-blue appearance-none cursor-pointer">
                    <option value="all">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->nama }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-text" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
            </div>
            <!-- Search -->
            <div class="relative flex-1 md:w-64">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-text">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </span>
                <input type="text" id="barang-search" placeholder="Cari nama / kode..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border-0 rounded-xl text-xs focus:ring-1.5 focus:ring-primary-blue transition-all">
            </div>
            <!-- Export Button -->
            <button type="button" onclick="exportToCSV()" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-xl text-xs font-semibold transition-colors flex items-center space-x-1.5 shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                <span>Export</span>
            </button>
            <button type="button" onclick="openAddModal()" class="bg-primary-blue hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-semibold transition-colors flex items-center space-x-1.5 shadow-sm shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span>Tambah</span>
            </button>
        </div>
    </div>

    <!-- 2 Column Layout (List + Detail) -->
    @if($barangs->isEmpty())
        <div class="bg-white border-2 border-dashed border-slate-200 rounded-3xl p-16 text-center max-w-lg mx-auto my-12 space-y-4">
            <div class="w-20 h-20 bg-light-blue-bg text-sky-blue rounded-full flex items-center justify-center mx-auto">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                    <line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
            </div>
            <div class="space-y-1.5">
                <h3 class="text-lg font-poppins font-bold text-navy-text">Inventaris Masih Kosong</h3>
                <p class="text-sm text-slate-text max-w-xs mx-auto">Mulai kelola inventaris dengan menambahkan barang pertama Anda. Catat stok, kondisi, dan lokasi dengan mudah.</p>
            </div>
            <button type="button" onclick="openAddModal()" class="inline-flex bg-primary-blue hover:bg-blue-600 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-colors shadow-md">
                + Tambah Barang Pertama
            </button>
        </div>
    @else
        <div class="lg:flex lg:items-start lg:space-x-6">
            <!-- Left Column: Item Table -->
            <div class="flex-1">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.02)] overflow-hidden">
                    <div class="overflow-x-auto custom-scroll">
                        <table class="w-full text-left border-collapse min-w-[800px]">
                            <thead>
                                <tr class="bg-slate-50 text-slate-text text-[10px] uppercase tracking-wider border-b border-slate-100">
                                    <th class="px-6 py-4 font-semibold">Kode</th>
                                    <th class="px-6 py-4 font-semibold">Nama Barang</th>
                                    <th class="px-6 py-4 font-semibold">Kategori</th>
                                    <th class="px-6 py-4 font-semibold text-center">Stok</th>
                                    <th class="px-6 py-4 font-semibold text-center">Kondisi</th>
                                    <th class="px-6 py-4 font-semibold text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody id="barang-table-body" class="divide-y divide-slate-100">
                                @foreach($barangs as $index => $barang)
                                    @php
                                        $bar_color = 'bg-success-green';
                                        if ($barang->status === 'Habis') {
                                            $bar_color = 'bg-danger-red';
                                        } elseif ($barang->status === 'Menipis') {
                                            $bar_color = 'bg-warning-amber';
                                        }
                                    @endphp

                                    <tr data-id="{{ $barang->id }}"
                                        data-nama="{{ $barang->nama }}"
                                        data-kategori="{{ $barang->kategori->nama ?? '-' }}"
                                        data-kategori-id="{{ $barang->kategori_id }}"
                                        data-stok="{{ $barang->stok }}"
                                        data-stok-minimum="{{ $barang->stok_minimum }}"
                                        data-status="{{ $barang->status }}"
                                        data-gambar="{{ $barang->gambar }}"
                                        data-kode="{{ $barang->kode ?? 'PRD-' . str_pad($barang->id, 4, '0', STR_PAD_LEFT) }}"
                                        data-lokasi="{{ $barang->lokasi ?? 'Gudang Utama' }}"
                                        data-kondisi="{{ $barang->kondisi ?? 'Baik' }}"
                                        data-updated="{{ $barang->updated_at ? $barang->updated_at->diffForHumans() : 'Baru saja' }}"
                                        class="barang-row cursor-pointer transition-colors hover:bg-slate-50 opacity-0 animate-fade-in-up" 
                                        style="animation-delay: {{ min($index * 0.04, 0.24) }}s;">
                                        
                                        <td class="px-6 py-4 text-[11px] text-slate-400 font-mono whitespace-nowrap">
                                            {{ $barang->kode ?? 'PRD-' . str_pad($barang->id, 4, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-poppins font-semibold text-navy-text">
                                            {{ $barang->nama }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-[10px] font-semibold text-primary-blue uppercase tracking-wider bg-light-blue-bg inline-block px-2 py-0.5 rounded">
                                                {{ $barang->kategori->nama ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="font-bold text-navy-text text-sm">{{ $barang->stok }}</span>
                                            <span class="text-[9px] text-slate-text font-medium block">/ Min: {{ $barang->stok_minimum }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if(($barang->kondisi ?? 'Baik') == 'Baik')
                                                <span class="text-[10px] bg-emerald-50 text-success-green px-2 py-1 rounded border border-emerald-100 whitespace-nowrap">Baik</span>
                                            @else
                                                <span class="text-[10px] bg-rose-50 text-danger-red px-2 py-1 rounded border border-rose-100 whitespace-nowrap">{{ $barang->kondisi ?? 'Baik' }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <span class="w-2 h-2 rounded-full {{ $bar_color }}"></span>
                                                <span class="text-[11px] font-semibold text-slate-text">{{ $barang->status }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="no-filter-results" class="hidden bg-white rounded-2xl p-12 text-center border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.02)]">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <p class="text-sm text-slate-text">Tidak ada barang yang cocok dengan filter atau pencarian Anda.</p>
                </div>
            </div>

            <!-- Right Column: Detail Panel -->
            <div id="detail-panel" class="hidden lg:block w-[360px] shrink-0 bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.05)] sticky top-24 max-h-[calc(100vh-7rem)] overflow-y-auto custom-scroll">
                <div id="desktop-detail-content" class="min-h-[300px] flex flex-col justify-center items-center text-center text-slate-text space-y-3">
                    <svg class="w-14 h-14 text-light-blue-bg stroke-sky-blue" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    </svg>
                    <p class="text-xs font-medium">Pilih salah satu barang untuk melihat detail lengkap dan mengelola stok.</p>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Scrim for Bottom Sheet -->
<div id="scrim" class="fixed inset-0 bg-black/40 backdrop-blur-xs z-40 hidden transition-opacity duration-300 opacity-0"></div>

<!-- Bottom Sheet (Tablet/Mobile) -->
<div id="bottom-sheet" class="fixed inset-x-0 bottom-0 max-h-[85vh] bg-white rounded-t-3xl border-t border-slate-100 z-50 transform translate-y-full transition-transform duration-300 ease-out overflow-y-auto shadow-2xl pb-10 custom-scroll">
    <div class="w-12 h-1.5 bg-slate-200 rounded-full mx-auto my-3 cursor-pointer hover:bg-slate-300 transition-colors" id="bottom-sheet-drag"></div>
    <div class="px-6 pb-6 pt-2" id="bottom-sheet-content"></div>
</div>

<!-- MODAL: TAMBAH BARANG -->
<div id="addBarangModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl max-h-[90vh] overflow-y-auto transform transition-transform duration-300 scale-95 opacity-0 custom-scroll" id="addBarangModalContent">
        <div class="flex items-center justify-between p-5 border-b border-slate-100 sticky top-0 bg-white rounded-t-2xl z-10">
            <div>
                <h3 class="text-base font-poppins font-bold text-navy-text">Tambah Barang Baru</h3>
                <p class="text-xs text-slate-text">Lengkapi data barang dengan akurat.</p>
            </div>
            <button type="button" onclick="closeAddModal()" class="text-slate-text hover:text-danger-red transition-colors p-1.5 rounded-full hover:bg-slate-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form action="/barangs" method="POST" enctype="multipart/form-data" class="p-5 space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
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
                <div>
                    <label for="add_lokasi" class="block text-xs font-semibold text-slate-text mb-1.5">Lokasi Penyimpanan</label>
                    <input type="text" name="lokasi" id="add_lokasi" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all" placeholder="Contoh: Gudang A / Ruang Guru">
                </div>
                <div>
                    <label for="add_stok" class="block text-xs font-semibold text-slate-text mb-1.5">Stok Awal <span class="text-danger-red">*</span></label>
                    <input type="number" name="stok" id="add_stok" required min="0" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all" placeholder="0">
                </div>
                <div>
                    <label for="add_stok_minimum" class="block text-xs font-semibold text-slate-text mb-1.5">Stok Minimum <span class="text-danger-red">*</span></label>
                    <input type="number" name="stok_minimum" id="add_stok_minimum" required min="0" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all" placeholder="0">
                </div>
                <div>
                    <label for="add_kondisi" class="block text-xs font-semibold text-slate-text mb-1.5">Kondisi Barang</label>
                    <select name="kondisi" id="add_kondisi" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all">
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Gambar Barang</label>
                    <div class="flex gap-1 p-1 bg-slate-100 rounded-xl mb-3 w-fit">
                        <button type="button" id="addGambarUrlTab" class="px-4 py-1.5 rounded-lg text-xs font-semibold transition-all bg-white text-navy-text shadow-sm">URL</button>
                        <button type="button" id="addGambarUploadTab" class="px-4 py-1.5 rounded-lg text-xs font-semibold transition-all text-slate-text hover:text-navy-text">Upload</button>
                    </div>
                    <div id="addGambarUrlInput">
                        <input type="url" name="gambar_url" id="add_gambar_url" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all" placeholder="https://example.com/gambar.jpg">
                    </div>
                    <div id="addGambarUploadInput" class="hidden">
                        <div class="flex items-center gap-3">
                            <label for="add_gambar_file" class="flex-1 flex items-center gap-3 px-4 py-3 bg-slate-50 border border-dashed border-slate-300 rounded-xl text-sm cursor-pointer hover:bg-slate-100 transition-all">
                                <svg class="w-5 h-5 text-slate-text shrink-0" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                <span class="text-slate-text text-xs" id="addGambarFileName">Pilih file gambar...</span>
                            </label>
                            <input type="file" name="gambar_file" id="add_gambar_file" accept="image/jpeg,image/png,image/webp,image/gif" class="hidden">
                        </div>
                        <div id="addGambarPreview" class="hidden mt-2 relative w-20 h-20 rounded-xl overflow-hidden border border-slate-200">
                            <img id="addGambarPreviewImg" class="w-full h-full object-cover" src="" alt="preview">
                            <button type="button" id="addGambarPreviewRemove" class="absolute top-0.5 right-0.5 w-5 h-5 bg-danger-red text-white rounded-full flex items-center justify-center text-xs hover:bg-rose-600 transition-colors">&times;</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeAddModal()" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-text bg-slate-50 hover:bg-slate-100 transition-colors">Batal</button>
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-semibold text-white bg-primary-blue hover:bg-blue-600 transition-colors shadow-md flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>Simpan Barang</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL: EDIT BARANG -->
<div id="editBarangModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl max-h-[90vh] overflow-y-auto transform transition-transform duration-300 scale-95 opacity-0 custom-scroll" id="editBarangModalContent">
        <div class="flex items-center justify-between p-5 border-b border-slate-100 sticky top-0 bg-white rounded-t-2xl z-10">
            <div>
                <h3 class="text-base font-poppins font-bold text-navy-text">Edit Detail Barang</h3>
                <p class="text-xs text-slate-text">Perbarui informasi inventaris.</p>
            </div>
            <button type="button" onclick="closeEditModal()" class="text-slate-text hover:text-danger-red transition-colors p-1.5 rounded-full hover:bg-slate-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form id="editBarangForm" method="POST" enctype="multipart/form-data" class="p-5 space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
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
                <div>
                    <label for="edit_lokasi" class="block text-xs font-semibold text-slate-text mb-1.5">Lokasi Penyimpanan</label>
                    <input type="text" name="lokasi" id="edit_lokasi" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all">
                </div>
                <div>
                    <label for="edit_stok" class="block text-xs font-semibold text-slate-text mb-1.5">Stok <span class="text-danger-red">*</span></label>
                    <input type="number" name="stok" id="edit_stok" required min="0" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all">
                </div>
                <div>
                    <label for="edit_stok_minimum" class="block text-xs font-semibold text-slate-text mb-1.5">Stok Minimum <span class="text-danger-red">*</span></label>
                    <input type="number" name="stok_minimum" id="edit_stok_minimum" required min="0" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all">
                </div>
                <div>
                    <label for="edit_kondisi" class="block text-xs font-semibold text-slate-text mb-1.5">Kondisi Barang</label>
                    <select name="kondisi" id="edit_kondisi" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all">
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-slate-text mb-1.5">Gambar Barang</label>
                    <div class="flex gap-1 p-1 bg-slate-100 rounded-xl mb-3 w-fit">
                        <button type="button" id="editGambarUrlTab" class="px-4 py-1.5 rounded-lg text-xs font-semibold transition-all bg-white text-navy-text shadow-sm">URL</button>
                        <button type="button" id="editGambarUploadTab" class="px-4 py-1.5 rounded-lg text-xs font-semibold transition-all text-slate-text hover:text-navy-text">Upload</button>
                    </div>
                    <div id="editGambarUrlInput">
                        <input type="url" name="gambar_url" id="edit_gambar_url" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all" placeholder="https://example.com/gambar.jpg">
                    </div>
                    <div id="editGambarUploadInput" class="hidden">
                        <div class="flex items-center gap-3">
                            <label for="edit_gambar_file" class="flex-1 flex items-center gap-3 px-4 py-3 bg-slate-50 border border-dashed border-slate-300 rounded-xl text-sm cursor-pointer hover:bg-slate-100 transition-all">
                                <svg class="w-5 h-5 text-slate-text shrink-0" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                <span class="text-slate-text text-xs" id="editGambarFileName">Pilih file gambar...</span>
                            </label>
                            <input type="file" name="gambar_file" id="edit_gambar_file" accept="image/jpeg,image/png,image/webp,image/gif" class="hidden">
                        </div>
                        <div id="editGambarPreview" class="hidden mt-2 relative w-20 h-20 rounded-xl overflow-hidden border border-slate-200">
                            <img id="editGambarPreviewImg" class="w-full h-full object-cover" src="" alt="preview">
                            <button type="button" id="editGambarPreviewRemove" class="absolute top-0.5 right-0.5 w-5 h-5 bg-danger-red text-white rounded-full flex items-center justify-center text-xs hover:bg-rose-600 transition-colors">&times;</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-text bg-slate-50 hover:bg-slate-100 transition-colors">Batal</button>
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-semibold text-white bg-primary-blue hover:bg-blue-600 transition-colors shadow-md flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>Perbarui Barang</span>
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
    
    @media (prefers-reduced-motion: reduce) {
        .animate-fade-in-up { animation: none; opacity: 1; }
        .barang-row { transition: none !important; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const csrfToken = "{{ csrf_token() }}";
        const rows = document.querySelectorAll('.barang-row');
        const scrim = document.getElementById('scrim');
        const bottomSheet = document.getElementById('bottom-sheet');
        const bottomSheetContent = document.getElementById('bottom-sheet-content');
        const desktopContent = document.getElementById('desktop-detail-content');

        let activeId = null;

        function renderDetailContent(id, name, category, stok, stokMin, status, gambar, kategoriId, kode, lokasi, kondisi, updated) {
            const maxVal = Math.max(stokMin * 2, 10, stok);
            const percentage = maxVal > 0 ? (stok / maxVal) * 100 : 0;

            let statusBadge = '';
            let barColor = 'bg-success-green';

            if (status === 'Habis') {
                statusBadge = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-rose-50 text-danger-red border border-rose-100"><span class="w-1.5 h-1.5 bg-danger-red rounded-full"></span> Stok Habis</span>`;
                barColor = 'bg-danger-red';
            } else if (status === 'Menipis') {
                statusBadge = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-amber-50 text-warning-amber border border-amber-100"><span class="w-1.5 h-1.5 bg-warning-amber rounded-full"></span> Stok Menipis</span>`;
                barColor = 'bg-warning-amber';
            } else {
                statusBadge = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-50 text-success-green border border-emerald-100"><span class="w-1.5 h-1.5 bg-success-green rounded-full"></span> Stok Aman</span>`;
            }

            let kondisiBadge = '';
            if(kondisi === 'Baik') {
                kondisiBadge = `<span class="text-[10px] bg-emerald-50 text-success-green px-2 py-0.5 rounded border border-emerald-100">${kondisi}</span>`;
            } else {
                kondisiBadge = `<span class="text-[10px] bg-rose-50 text-danger-red px-2 py-0.5 rounded border border-rose-100">${kondisi}</span>`;
            }

            const imgSrc = gambar ? (gambar.startsWith('http') ? gambar : '/storage/' + gambar) : '';
            return `
                <div class="space-y-5">
                    <!-- Image -->
                    <div class="h-48 w-full bg-slate-50 rounded-2xl overflow-hidden flex items-center justify-center border border-slate-100 relative">
                        <img src="${imgSrc}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" class="h-full w-full object-cover">
                        <div class="hidden absolute inset-0 bg-slate-50 flex items-center justify-center text-sky-blue">
                            <svg class="w-14 h-14" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            </svg>
                        </div>
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-lg shadow-sm p-1.5 cursor-pointer hover:bg-white" title="Cetak Barcode">
                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5h2v14H3zM7 5h1v14H7zM10 5h2v14h-2zM14 5h1v14h-1zM17 5h2v14h-2z"/></svg>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="text-left">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-semibold text-primary-blue tracking-wide uppercase bg-light-blue-bg px-2 py-0.5 rounded">${category}</span>
                            ${kondisiBadge}
                        </div>
                        <h3 class="text-lg font-poppins font-bold text-navy-text mt-2 leading-snug">${name}</h3>
                        <p class="text-[11px] text-slate-400 font-mono mt-0.5">${kode}</p>
                        <div class="mt-3">${statusBadge}</div>
                    </div>

                    <!-- Detailed Info Grid -->
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <p class="text-slate-400 text-[10px] mb-0.5 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="2.5"/></svg>
                                Lokasi
                            </p>
                            <p class="font-semibold text-navy-text">${lokasi}</p>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <p class="text-slate-400 text-[10px] mb-0.5 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                Diperbarui
                            </p>
                            <p class="font-semibold text-navy-text">${updated}</p>
                        </div>
                    </div>

                    <!-- Stok Bar -->
                    <div class="bg-white p-4 rounded-xl border border-slate-100 space-y-2 shadow-sm">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-medium text-slate-text">Total Stok Saat Ini</span>
                            <span class="font-bold text-navy-text text-base">${stok} <span class="text-[10px] text-slate-text font-medium">/ Max ${stokMin * 2 || 10}</span></span>
                        </div>
                        <div class="h-3 w-full bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full ${barColor} rounded-full transition-all duration-500" style="width: ${Math.min(100, percentage)}%"></div>
                        </div>
                        <div class="flex justify-between text-[10px] text-slate-text">
                            <span>Minimum: ${stokMin}</span>
                            <span>Status: ${status}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-2">
                        <div class="grid grid-cols-2 gap-3">
                            <form action="/stok-movements" method="POST">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <input type="hidden" name="barang_id" value="${id}">
                                <input type="hidden" name="tipe" value="masuk">
                                <input type="hidden" name="jumlah" value="1">
                                <input type="hidden" name="keterangan" value="Penambahan cepat via panel detail">
                                <button type="submit" class="w-full bg-emerald-50 text-success-green hover:bg-emerald-100 py-2.5 px-4 rounded-xl text-[11px] font-semibold transition-colors flex items-center justify-center space-x-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                    <span>Tambah Stok</span>
                                </button>
                            </form>
                            <form action="/stok-movements" method="POST">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <input type="hidden" name="barang_id" value="${id}">
                                <input type="hidden" name="tipe" value="keluar">
                                <input type="hidden" name="jumlah" value="1">
                                <input type="hidden" name="keterangan" value="Pengurangan cepat via panel detail">
                                <button type="submit" ${stok <= 0 ? 'disabled' : ''} class="w-full bg-rose-50 text-danger-red hover:bg-rose-100 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed py-2.5 px-4 rounded-xl text-[11px] font-semibold transition-colors flex items-center justify-center space-x-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                    <span>Kurangi Stok</span>
                                </button>
                            </form>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <button type="button" onclick='openEditModal(${JSON.stringify({id, name, kategoriId, stok, stokMin, gambar, lokasi, kondisi})})' class="flex items-center justify-center space-x-1.5 border border-slate-200 hover:bg-slate-50 text-navy-text py-2.5 px-4 rounded-xl text-[11px] font-semibold transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4Z"/></svg>
                                <span>Edit Info</span>
                            </button>

                            <form action="/barangs/${id}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini secara permanen?')">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="w-full flex items-center justify-center space-x-1.5 border border-rose-100 bg-rose-50/50 hover:bg-rose-50 text-danger-red py-2.5 px-4 rounded-xl text-[11px] font-semibold transition-colors">
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
            const row = document.querySelector(`.barang-row[data-id="${id}"]`);
            if (!row) return;

            activeId = id;

            rows.forEach(r => {
                r.classList.remove('bg-blue-50/50');
                r.classList.remove('text-primary-blue');
            });
            row.classList.add('bg-blue-50/50');

            const name = row.dataset.nama;
            const category = row.dataset.kategori;
            const stok = parseInt(row.dataset.stok);
            const stokMin = parseInt(row.dataset.stokMinimum);
            const status = row.dataset.status;
            const gambar = row.dataset.gambar;
            const kategoriId = row.dataset.kategoriId;
            const kode = row.dataset.kode;
            const lokasi = row.dataset.lokasi;
            const kondisi = row.dataset.kondisi;
            const updated = row.dataset.updated;
            
            const htmlContent = renderDetailContent(id, name, category, stok, stokMin, status, gambar, kategoriId, kode, lokasi, kondisi, updated);

            if (desktopContent) desktopContent.innerHTML = htmlContent;
            if (bottomSheetContent) bottomSheetContent.innerHTML = htmlContent;

            if (window.innerWidth <= 1080) {
                openBottomSheet();
            }
        }

        rows.forEach(row => {
            row.addEventListener('click', () => {
                selectItem(row.dataset.id);
            });
        });

        if (window.innerWidth > 1080 && rows.length > 0) {
            selectItem(rows[0].dataset.id);
        }

        // Filter Logic
        const searchInput = document.getElementById('barang-search');
        const kategoriFilter = document.getElementById('kategori-filter');
        const tabButtons = document.querySelectorAll('.tab-button');
        let currentTab = 'Semua';
        let searchQuery = '';
        let currentKategori = 'all';

        function filterItems() {
            let visibleCount = 0;
            rows.forEach(row => {
                const name = row.dataset.nama.toLowerCase();
                const kode = (row.dataset.kode || '').toLowerCase();
                const status = row.dataset.status; 
                const kategori = row.dataset.kategori;

                const matchesSearch = name.includes(searchQuery) || kode.includes(searchQuery);
                const matchesTab = currentTab === 'Semua' ||
                                   (currentTab === 'Stok Aman' && status === 'Aman') ||
                                   (currentTab === 'Stok Menipis' && status === 'Menipis') ||
                                   (currentTab === 'Stok Habis' && status === 'Habis');
                const matchesKategori = currentKategori === 'all' || kategori === currentKategori;

                if (matchesSearch && matchesTab && matchesKategori) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
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

        if (kategoriFilter) {
            kategoriFilter.addEventListener('change', (e) => {
                currentKategori = e.target.value;
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

        // MODAL LOGIC
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

        window.openEditModal = function(data) {
            const modal = document.getElementById('editBarangModal');
            const modalContent = document.getElementById('editBarangModalContent');

            document.getElementById('editBarangForm').action = `/barangs/${data.id}`;
            document.getElementById('edit_nama').value = data.name;
            document.getElementById('edit_kategori_id').value = data.kategoriId;
            document.getElementById('edit_stok').value = data.stok;
            document.getElementById('edit_stok_minimum').value = data.stokMin;
            document.getElementById('edit_gambar_url').value = data.gambar || '';
            if (data.gambar && !data.gambar.startsWith('blob:')) {
                document.getElementById('editGambarUrlTab').click();
            }
            document.getElementById('edit_lokasi').value = data.lokasi || '';
            document.getElementById('edit_kondisi').value = data.kondisi || 'Baik';

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

        // ==========================================
        // GAMBAR TOGGLE & PREVIEW (ADD MODAL)
        // ==========================================
        function setupGambarTabs(prefix) {
            const urlTab = document.getElementById(prefix + 'GambarUrlTab');
            const uploadTab = document.getElementById(prefix + 'GambarUploadTab');
            const urlInput = document.getElementById(prefix + 'GambarUrlInput');
            const uploadInput = document.getElementById(prefix + 'GambarUploadInput');
            const fileInput = document.getElementById(prefix + '_gambar_file');
            const fileName = document.getElementById(prefix + 'GambarFileName');
            const preview = document.getElementById(prefix + 'GambarPreview');
            const previewImg = document.getElementById(prefix + 'GambarPreviewImg');
            const previewRemove = document.getElementById(prefix + 'GambarPreviewRemove');
            const urlField = document.getElementById(prefix + '_gambar_url');

            function activateUrl() {
                urlTab.classList.add('bg-white', 'text-navy-text', 'shadow-sm');
                urlTab.classList.remove('text-slate-text');
                uploadTab.classList.remove('bg-white', 'text-navy-text', 'shadow-sm');
                uploadTab.classList.add('text-slate-text');
                urlInput.classList.remove('hidden');
                uploadInput.classList.add('hidden');
                fileInput.value = '';
                preview.classList.add('hidden');
                fileName.textContent = 'Pilih file gambar...';
            }

            function activateUpload() {
                uploadTab.classList.add('bg-white', 'text-navy-text', 'shadow-sm');
                uploadTab.classList.remove('text-slate-text');
                urlTab.classList.remove('bg-white', 'text-navy-text', 'shadow-sm');
                urlTab.classList.add('text-slate-text');
                uploadInput.classList.remove('hidden');
                urlInput.classList.add('hidden');
                urlField.value = '';
            }

            urlTab.addEventListener('click', activateUrl);
            uploadTab.addEventListener('click', activateUpload);

            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    fileName.textContent = this.files[0].name;
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            previewRemove.addEventListener('click', function() {
                fileInput.value = '';
                preview.classList.add('hidden');
                fileName.textContent = 'Pilih file gambar...';
            });
        }

        setupGambarTabs('add');
        setupGambarTabs('edit');

        // Reset add modal gambar on close
        const origCloseAdd = window.closeAddModal;
        window.closeAddModal = function() {
            const fileInput = document.getElementById('add_gambar_file');
            const preview = document.getElementById('addGambarPreview');
            const fileName = document.getElementById('addGambarFileName');
            const urlInput = document.getElementById('add_gambar_url');
            fileInput.value = '';
            preview.classList.add('hidden');
            fileName.textContent = 'Pilih file gambar...';
            urlInput.value = '';
            document.getElementById('addGambarUrlTab').click();
            origCloseAdd();
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (!document.getElementById('addBarangModal').classList.contains('hidden')) closeAddModal();
                if (!document.getElementById('editBarangModal').classList.contains('hidden')) closeEditModal();
            }
        });

        // ==========================================
        // EXPORT TO CSV LOGIC
        // ==========================================
        window.exportToCSV = function() {
            let csv = [];
            csv.push(["Kode", "Nama Barang", "Kategori", "Stok", "Stok Minimum", "Status", "Kondisi", "Lokasi"].join(","));
            
            rows.forEach(row => {
                if (row.style.display !== 'none') {
                    let rowData = [
                        `"${row.dataset.kode}"`,
                        `"${row.dataset.nama}"`,
                        `"${row.dataset.kategori}"`,
                        row.dataset.stok,
                        row.dataset.stokMinimum,
                        `"${row.dataset.status}"`,
                        `"${row.dataset.kondisi}"`,
                        `"${row.dataset.lokasi}"`
                    ].join(",");
                    csv.push(rowData);
                }
            });

            if (csv.length <= 1) {
                alert("Tidak ada data untuk diekspor.");
                return;
            }

            const csvString = csv.join("\n");
            const blob = new Blob([csvString], { type: "text/csv;charset=utf-8;" });
            const url = URL.createObjectURL(blob);
            const link = document.createElement("a");
            link.setAttribute("href", url);
            link.setAttribute("download", "Inventaris_Barang_" + new Date().toISOString().slice(0,10) + ".csv");
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    });

    // AUTO REFRESH
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