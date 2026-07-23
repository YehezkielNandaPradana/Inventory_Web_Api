@extends('layouts.app')

@section('title', 'Dashboard - Inventaris')

@section('content')
@php
    $stok_aman_count = $total_barang - $stok_menipis;
    $stok_menipis_count = $stok_menipis - $stok_habis;

    $pct = function ($n) use ($total_barang) {
        return $total_barang > 0 ? round(($n / $total_barang) * 100) : 0;
    };
    $pct_aman = $pct($stok_aman_count);
    $pct_menipis = $pct($stok_menipis_count);
    $pct_habis = $pct($stok_habis);

    // Data untuk Line Chart Tren Pergerakan Stok (7 Hari Terakhir)
    $labels_tren = [];
    $data_masuk = [];
    $data_keluar = [];
    $data_net = [];

    for ($i = 6; $i >= 0; $i--) {
        $date = \Carbon\Carbon::today()->subDays($i);
        $labels_tren[] = $date->format('d M');

        $masuk = 0;
        $keluar = 0;
        foreach ($stok_movements as $movement) {
            if ($movement->created_at->format('Y-m-d') == $date->format('Y-m-d')) {
                if ($movement->tipe == 'masuk') {
                    $masuk += $movement->jumlah;
                } else {
                    $keluar += $movement->jumlah;
                }
            }
        }
        $data_masuk[] = $masuk;
        $data_keluar[] = $keluar;
        $data_net[] = $masuk - $keluar;
    }

    $total_masuk_minggu = array_sum($data_masuk);
    $total_keluar_minggu = array_sum($data_keluar);

    // Filter barang yang perlu restock (Menipis & Habis)
    $barang_restock = $barangs->filter(function ($b) {
        return $b->status === 'Menipis' || $b->status === 'Habis';
    })->take(5);
@endphp

<div class="space-y-6">

    <!-- Breadcrumb -->
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 text-xs">
            <li class="inline-flex items-center">
                <a href="/" class="text-slate-text hover:text-primary-blue transition-colors">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-slate-300 mx-1" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path></svg>
                    <span class="text-primary-blue font-medium">Dashboard</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Hero: Control Tower -->
    <div class="relative overflow-hidden rounded-[28px] p-8 sm:p-10 text-white shadow-[0_20px_60px_rgba(27,79,204,0.35)]" style="background: linear-gradient(135deg, #123B99 0%, #2D7DD2 55%, #22B8D8 100%);">
        <div class="absolute inset-0 grid-pattern pointer-events-none"></div>
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-white/10 blur-3xl pointer-events-none"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8">
            <div>
                <span class="inline-flex items-center gap-2 text-[11px] font-semibold tracking-[0.2em] uppercase text-white/70 mb-4">
                    <span class="pulse-dot"></span> Live &middot; Diperbarui {{ \Carbon\Carbon::now()->format('d M, H:i') }}
                </span>
                <h1 class="font-display text-3xl sm:text-4xl font-bold leading-tight">Ringkasan Gudang<br class="hidden sm:block"> Hari Ini</h1>
                <p class="text-sm text-white/70 mt-3 max-w-sm">Pantau ringkasan aset dan pergerakan stok secara real-time dari satu layar.</p>
            </div>

            <div class="flex flex-wrap items-end gap-8 sm:gap-10">
                <div>
                    <p class="text-[11px] uppercase tracking-widest text-white/60 mb-1">Total Barang</p>
                    <p class="font-mono-num text-5xl font-bold leading-none">{{ $total_barang }}</p>
                    <p class="text-[11px] text-white/60 mt-2">item terdaftar</p>
                </div>

                <div class="w-px self-stretch bg-white/20 hidden sm:block"></div>

                <div>
                    <p class="text-[11px] uppercase tracking-widest text-white/60 mb-2">Pergerakan 7 Hari</p>
                    <div class="flex items-center gap-3">
                        <canvas id="heroSparkline" width="110" height="38"></canvas>
                        <div class="text-[11px] leading-relaxed font-mono-num">
                            <p class="text-emerald-200 font-semibold">+{{ $total_masuk_minggu }} masuk</p>
                            <p class="text-rose-200 font-semibold">-{{ $total_keluar_minggu }} keluar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Cards (mengambang di atas tepi hero) -->
    <div class="relative z-10 -mt-2 lg:-mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Barang -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_12px_40px_rgba(27,79,204,0.08)] transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-light-blue-bg flex items-center justify-center text-primary-blue shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                        <line x1="12" y1="22.08" x2="12" y2="12"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-[11px] font-semibold text-slate-text tracking-wide uppercase">Total Barang</p>
                    <p class="font-mono-num text-2xl font-bold text-navy-text mt-0.5">{{ $total_barang }}</p>
                </div>
            </div>
            <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden mt-4">
                <div class="h-full bg-primary-blue rounded-full" style="width: 100%"></div>
            </div>
        </div>

        <!-- Stok Aman -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_12px_40px_rgba(16,185,129,0.08)] transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-success-green shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-[11px] font-semibold text-slate-text tracking-wide uppercase">Stok Aman</p>
                    <p class="font-mono-num text-2xl font-bold text-navy-text mt-0.5">{{ $stok_aman_count }}</p>
                </div>
            </div>
            <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden mt-4">
                <div class="h-full bg-success-green rounded-full" style="width: {{ $pct_aman }}%"></div>
            </div>
        </div>

        <!-- Stok Menipis -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_12px_40px_rgba(245,158,11,0.08)] transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-warning-amber shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-[11px] font-semibold text-slate-text tracking-wide uppercase">Stok Menipis</p>
                    <p class="font-mono-num text-2xl font-bold text-navy-text mt-0.5">{{ $stok_menipis_count }}</p>
                </div>
            </div>
            <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden mt-4">
                <div class="h-full bg-warning-amber rounded-full" style="width: {{ $pct_menipis }}%"></div>
            </div>
        </div>

        <!-- Stok Habis -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_12px_40px_rgba(239,68,68,0.08)] transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center text-danger-red shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-[11px] font-semibold text-slate-text tracking-wide uppercase">Stok Habis</p>
                    <p class="font-mono-num text-2xl font-bold text-navy-text mt-0.5">{{ $stok_habis }}</p>
                </div>
            </div>
            <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden mt-4">
                <div class="h-full bg-danger-red rounded-full" style="width: {{ $pct_habis }}%"></div>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Line Chart: Tren Pergerakan Stok -->
        <div class="bg-white p-6 rounded-[28px] border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] lg:col-span-2">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                <h3 class="font-display text-sm font-bold text-navy-text">Tren Pergerakan Stok</h3>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-semibold text-slate-text">
                        <span class="w-2 h-2 rounded-full bg-success-green"></span> Masuk
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-semibold text-slate-text">
                        <span class="w-2 h-2 rounded-full bg-danger-red"></span> Keluar
                    </span>
                    <span class="text-[10px] text-slate-text font-medium bg-slate-50 px-2 py-1 rounded-full">7 Hari Terakhir</span>
                </div>
            </div>
            <div class="relative" style="min-height: 280px;">
                <canvas id="movementTrendChart"></canvas>
            </div>
        </div>

        <!-- Status Ring: Distribusi Stok -->
        <div class="bg-white p-6 rounded-[28px] border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] flex flex-col">
            <h3 class="font-display text-sm font-bold text-navy-text mb-4">Distribusi Status Stok</h3>
            <div class="relative flex-grow flex items-center justify-center" style="min-height: 180px;">
                <canvas id="stockStatusChart"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <span class="font-mono-num text-3xl font-bold text-navy-text">{{ $total_barang }}</span>
                    <span class="text-[10px] text-slate-text uppercase tracking-wider mt-1">Total Item</span>
                </div>
            </div>
            <div class="mt-5 space-y-2.5">
                <div class="flex items-center justify-between bg-emerald-50/70 rounded-xl px-3 py-2 border border-emerald-100">
                    <span class="flex items-center gap-2 text-[11px] font-semibold text-success-green"><span class="w-2 h-2 rounded-full bg-success-green"></span> Aman</span>
                    <span class="font-mono-num text-xs font-bold text-navy-text">{{ $stok_aman_count }}</span>
                </div>
                <div class="flex items-center justify-between bg-amber-50/70 rounded-xl px-3 py-2 border border-amber-100">
                    <span class="flex items-center gap-2 text-[11px] font-semibold text-warning-amber"><span class="w-2 h-2 rounded-full bg-warning-amber"></span> Menipis</span>
                    <span class="font-mono-num text-xs font-bold text-navy-text">{{ $stok_menipis_count }}</span>
                </div>
                <div class="flex items-center justify-between bg-rose-50/70 rounded-xl px-3 py-2 border border-rose-100">
                    <span class="flex items-center gap-2 text-[11px] font-semibold text-danger-red"><span class="w-2 h-2 rounded-full bg-danger-red"></span> Habis</span>
                    <span class="font-mono-num text-xs font-bold text-navy-text">{{ $stok_habis }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Lists & Tables Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent items -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] overflow-hidden lg:col-span-2">
            <div class="flex items-center justify-between p-6 pb-4">
                <h3 class="font-display text-sm font-bold text-navy-text">Barang Terbaru</h3>
                <a href="{{ route('barangs.index') }}" class="text-[11px] font-semibold text-primary-blue hover:underline flex items-center gap-1">
                    Lihat Semua
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="overflow-x-auto custom-scroll border-t border-slate-100">
                <table class="w-full text-left text-sm min-w-[600px]">
                    <thead class="bg-slate-50/80 text-slate-500 text-[11px] uppercase tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3 font-semibold whitespace-nowrap">Barang</th>
                            <th class="px-6 py-3 font-semibold whitespace-nowrap">Kategori</th>
                            <th class="px-6 py-3 font-semibold whitespace-nowrap">Stok</th>
                            <th class="px-6 py-3 font-semibold text-center whitespace-nowrap">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($barangs->take(5) as $barang)
                            <tr class="hover:bg-light-blue-bg/40 transition-colors duration-150">
                                <td class="px-6 py-4 text-navy-text font-medium whitespace-nowrap">{{ $barang->nama }}</td>
                                <td class="px-6 py-4 text-slate-text whitespace-nowrap">
                                    <span class="text-[10px] font-semibold text-primary-blue uppercase tracking-wider bg-light-blue-bg inline-block px-2 py-0.5 rounded">
                                        {{ $barang->kategori->nama ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col space-y-1.5 w-28">
                                        <span class="font-mono-num text-xs font-bold text-navy-text">{{ $barang->stok }} <span class="text-[9px] text-slate-text font-normal font-sans">/ Min: {{ $barang->stok_minimum }}</span></span>
                                        @php
                                            $max_val = max($barang->stok_minimum * 2, 10, $barang->stok);
                                            $percentage = $max_val > 0 ? ($barang->stok / $max_val) * 100 : 0;
                                            $color_class = 'bg-success-green';
                                            if ($barang->status === 'Habis') $color_class = 'bg-danger-red';
                                            elseif ($barang->status === 'Menipis') $color_class = 'bg-warning-amber';
                                        @endphp
                                        <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                            <div class="h-full {{ $color_class }} rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if($barang->status === 'Habis')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-rose-50 text-danger-red border border-rose-100">
                                            <span class="w-1.5 h-1.5 bg-danger-red rounded-full"></span> Habis
                                        </span>
                                    @elseif($barang->status === 'Menipis')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-amber-50 text-warning-amber border border-amber-100">
                                            <span class="w-1.5 h-1.5 bg-warning-amber rounded-full"></span> Menipis
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-50 text-success-green border border-emerald-100">
                                            <span class="w-1.5 h-1.5 bg-success-green rounded-full"></span> Aman
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                                        <p class="text-xs text-slate-text">Belum ada data barang terbaru.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Need Restock List -->
        <div class="bg-white p-6 rounded-[28px] border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)]">
            <div class="flex items-center justify-between mb-5">
                <h3 class="font-display text-sm font-bold text-navy-text">Perlu Restock</h3>
                <span class="px-2 py-1 bg-rose-50 text-danger-red text-[10px] font-semibold rounded-full border border-rose-100">{{ $barang_restock->count() }} Item</span>
            </div>
            <div class="space-y-3">
                @forelse($barang_restock as $barang)
                    @php
                        $is_habis = $barang->status === 'Habis';
                        $butuh = max(0, $barang->stok_minimum - $barang->stok);
                    @endphp
                    <div class="flex items-center gap-3 rounded-xl border-l-4 {{ $is_habis ? 'border-danger-red bg-rose-50/50' : 'border-warning-amber bg-amber-50/50' }} px-3 py-2.5">
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-semibold text-navy-text truncate">{{ $barang->nama }}</p>
                            <p class="text-[10px] text-slate-text mt-0.5">Butuh {{ $butuh }} unit lagi</p>
                        </div>
                        <p class="font-mono-num text-xs font-bold shrink-0 {{ $is_habis ? 'text-danger-red' : 'text-warning-amber' }}">{{ $barang->stok }}<span class="text-slate-text font-normal">/{{ $barang->stok_minimum }}</span></p>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <svg class="w-12 h-12 text-success-green mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-xs text-slate-text font-medium">Semua stok dalam kondisi aman.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent movements -->
        <div class="bg-white rounded-[28px] border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] overflow-hidden lg:col-span-3">
            <div class="flex items-center justify-between p-6 pb-4">
                <h3 class="font-display text-sm font-bold text-navy-text">Riwayat Pergerakan Stok Terbaru</h3>
                <a href="{{ route('stok-movements.index') }}" class="text-[11px] font-semibold text-primary-blue hover:underline flex items-center gap-1">
                    Lihat Semua
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="overflow-x-auto custom-scroll border-t border-slate-100">
                <table class="w-full text-left text-sm min-w-[800px]">
                    <thead class="bg-slate-50/80 text-slate-500 text-[11px] uppercase tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3 font-semibold whitespace-nowrap">Barang</th>
                            <th class="px-6 py-3 font-semibold whitespace-nowrap">Tipe</th>
                            <th class="px-6 py-3 font-semibold whitespace-nowrap">Jumlah</th>
                            <th class="px-6 py-3 font-semibold text-right whitespace-nowrap">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($stok_movements->take(8) as $movement)
                            <tr class="hover:bg-light-blue-bg/40 transition-colors duration-150">
                                <td class="px-6 py-4 text-navy-text font-medium whitespace-nowrap">{{ $movement->barang->nama ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($movement->tipe === 'masuk')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-50 text-success-green border border-emerald-100">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 19V5m-7 7l7-7 7 7"/></svg> Masuk
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-rose-50 text-danger-red border border-rose-100">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14m-7-7l7 7 7-7"/></svg> Keluar
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-mono-num text-xs font-semibold text-navy-text whitespace-nowrap">{{ $movement->jumlah }} Unit</td>
                                <td class="px-6 py-4 text-xs text-slate-text text-right whitespace-nowrap">{{ $movement->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" /></svg>
                                        <p class="text-xs text-slate-text">Belum ada pergerakan stok.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap');

    .font-display { font-family: 'Sora', ui-sans-serif, sans-serif; }
    .font-mono-num { font-family: 'JetBrains Mono', ui-monospace, monospace; }

    .grid-pattern {
        background-image:
            linear-gradient(rgba(255,255,255,0.08) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.08) 1px, transparent 1px);
        background-size: 28px 28px;
    }

    .pulse-dot {
        position: relative;
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 9999px;
        background: #4ADE80;
    }
    .pulse-dot::after {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 9999px;
        background: #4ADE80;
        opacity: 0.6;
        animation: pulse-ring 1.8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse-ring {
        0% { transform: scale(0.8); opacity: 0.6; }
        70% { transform: scale(2); opacity: 0; }
        100% { opacity: 0; }
    }

    .custom-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

    @media (prefers-reduced-motion: reduce) {
        .pulse-dot::after { animation: none; opacity: 0.3; }
    }
</style>

<script>
    // Chart 1: Tren Pergerakan Stok (Line, gradient area)
    const ctxTrend = document.getElementById('movementTrendChart').getContext('2d');

    const gradMasuk = ctxTrend.createLinearGradient(0, 0, 0, 280);
    gradMasuk.addColorStop(0, 'rgba(16, 185, 129, 0.25)');
    gradMasuk.addColorStop(1, 'rgba(16, 185, 129, 0)');

    const gradKeluar = ctxTrend.createLinearGradient(0, 0, 0, 280);
    gradKeluar.addColorStop(0, 'rgba(239, 68, 68, 0.22)');
    gradKeluar.addColorStop(1, 'rgba(239, 68, 68, 0)');

    new Chart(ctxTrend, {
        type: 'line',
        data: {
            labels: @json($labels_tren),
            datasets: [
                {
                    label: 'Stok Masuk',
                    data: @json($data_masuk),
                    borderColor: '#10b981',
                    backgroundColor: gradMasuk,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 3,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2
                },
                {
                    label: 'Stok Keluar',
                    data: @json($data_keluar),
                    borderColor: '#ef4444',
                    backgroundColor: gradKeluar,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 3,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#ef4444',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0B1B34',
                    padding: 12,
                    titleFont: { size: 12, weight: 'bold' },
                    bodyFont: { size: 11 },
                    cornerRadius: 10,
                    displayColors: true,
                    boxPadding: 4
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { font: { size: 11, family: 'Inter, sans-serif' }, color: '#94a3b8' }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: '#eef2f7', drawBorder: false, borderDash: [4, 4] },
                    border: { display: false },
                    ticks: { font: { size: 11 }, color: '#94a3b8', stepSize: 1 }
                }
            }
        }
    });

    // Chart 2: Distribusi Status Stok (Doughnut / status ring)
    const ctxStatus = document.getElementById('stockStatusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: ['Stok Aman', 'Stok Menipis', 'Stok Habis'],
            datasets: [{
                data: [{{ $stok_aman_count }}, {{ $stok_menipis_count }}, {{ $stok_habis }}],
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                borderWidth: 0,
                hoverOffset: 8,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '78%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0B1B34',
                    padding: 12,
                    titleFont: { size: 12, weight: 'bold' },
                    bodyFont: { size: 11 },
                    cornerRadius: 10,
                    displayColors: false
                }
            }
        }
    });

    // Chart 3: Sparkline pergerakan bersih di hero
    const ctxSpark = document.getElementById('heroSparkline').getContext('2d');
    const gradSpark = ctxSpark.createLinearGradient(0, 0, 0, 38);
    gradSpark.addColorStop(0, 'rgba(255,255,255,0.35)');
    gradSpark.addColorStop(1, 'rgba(255,255,255,0)');

    new Chart(ctxSpark, {
        type: 'line',
        data: {
            labels: @json($labels_tren),
            datasets: [{
                data: @json($data_net),
                borderColor: '#ffffff',
                backgroundColor: gradSpark,
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointRadius: 0
            }]
        },
        options: {
            responsive: false,
            plugins: { legend: { display: false }, tooltip: { enabled: false } },
            scales: { x: { display: false }, y: { display: false } }
        }
    });
</script>
@endsection