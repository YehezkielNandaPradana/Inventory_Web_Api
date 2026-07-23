@extends('layouts.app')

@section('title', 'Dashboard - Inventaris')

@section('content')
@php
    $stok_aman_count = $total_barang - $stok_menipis;
    $stok_menipis_count = $stok_menipis - $stok_habis;
    
    // Data untuk Chart Tren Pergerakan Stok (7 Hari Terakhir)
    $labels_tren = [];
    $data_masuk = [];
    $data_keluar = [];
    
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
    }

    // Filter barang yang perlu restock (Menipis & Habis)
    $barang_restock = $barangs->filter(function($b) {
        return $b->status === 'Menipis' || $b->status === 'Habis';
    })->take(5);
@endphp

<div class="space-y-6">
    <!-- Header & Breadcrumb -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-poppins font-bold text-navy-text">Dashboard Inventaris</h2>
            <p class="text-sm text-slate-text mt-1">Pantau ringkasan aset dan pergerakan stok secara real-time.</p>
        </div>
        <nav class="flex mt-3 sm:mt-0" aria-label="Breadcrumb">
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
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Barang -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] flex items-center gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(45,125,210,0.08)]">
            <div class="w-14 h-14 rounded-2xl bg-light-blue-bg flex items-center justify-center text-primary-blue shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                    <line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] font-medium text-slate-text tracking-wide uppercase">Total Barang</p>
                <p class="text-2xl font-poppins font-bold text-navy-text mt-0.5">{{ $total_barang }}</p>
                <p class="text-[10px] text-slate-400 mt-0.5 hidden sm:block">Item terdaftar</p>
            </div>
        </div>

        <!-- Stok Aman -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] flex items-center gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(16,185,129,0.08)]">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-success-green shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] font-medium text-slate-text tracking-wide uppercase">Stok Aman</p>
                <p class="text-2xl font-poppins font-bold text-navy-text mt-0.5">{{ $stok_aman_count }}</p>
                <p class="text-[10px] text-slate-400 mt-0.5 hidden sm:block">Tidak perlu tindakan</p>
            </div>
        </div>

        <!-- Stok Menipis -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] flex items-center gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(245,158,11,0.08)]">
            <div class="w-14 h-14 rounded-2xl bg-amber-50 flex items-center justify-center text-warning-amber shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] font-medium text-slate-text tracking-wide uppercase">Stok Menipis</p>
                <p class="text-2xl font-poppins font-bold text-navy-text mt-0.5">{{ $stok_menipis_count }}</p>
                <p class="text-[10px] text-slate-400 mt-0.5 hidden sm:block">Perlu segera restock</p>
            </div>
        </div>

        <!-- Stok Habis -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] flex items-center gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(239,68,68,0.08)]">
            <div class="w-14 h-14 rounded-2xl bg-rose-50 flex items-center justify-center text-danger-red shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] font-medium text-slate-text tracking-wide uppercase">Stok Habis</p>
                <p class="text-2xl font-poppins font-bold text-navy-text mt-0.5">{{ $stok_habis }}</p>
                <p class="text-[10px] text-slate-400 mt-0.5 hidden sm:block">Tindakan darurat</p>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Doughnut Chart: Distribusi Stok -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] flex flex-col">
            <h3 class="text-sm font-poppins font-bold text-navy-text mb-4">Distribusi Status Stok</h3>
            <div class="relative flex-grow flex items-center justify-center" style="min-height: 220px;">
                <canvas id="stockStatusChart"></canvas>
                <!-- Center Text Overlay -->
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <span class="text-3xl font-poppins font-bold text-navy-text">{{ $total_barang }}</span>
                    <span class="text-[10px] text-slate-text uppercase tracking-wider mt-1">Total Item</span>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-3 gap-2 text-center">
                <div class="bg-emerald-50/70 rounded-lg p-2 border border-emerald-100">
                    <p class="text-[10px] font-semibold text-success-green uppercase">Aman</p>
                    <p class="text-sm font-bold text-navy-text mt-0.5">{{ $stok_aman_count }}</p>
                </div>
                <div class="bg-amber-50/70 rounded-lg p-2 border border-amber-100">
                    <p class="text-[10px] font-semibold text-warning-amber uppercase">Menipis</p>
                    <p class="text-sm font-bold text-navy-text mt-0.5">{{ $stok_menipis_count }}</p>
                </div>
                <div class="bg-rose-50/70 rounded-lg p-2 border border-rose-100">
                    <p class="text-[10px] font-semibold text-danger-red uppercase">Habis</p>
                    <p class="text-sm font-bold text-navy-text mt-0.5">{{ $stok_habis }}</p>
                </div>
            </div>
        </div>

        <!-- Bar Chart: Tren Pergerakan Stok -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-poppins font-bold text-navy-text">Tren Pergerakan Stok</h3>
                <span class="text-[10px] text-slate-text font-medium bg-slate-50 px-2 py-1 rounded-full">7 Hari Terakhir</span>
            </div>
            <div class="relative" style="min-height: 260px;">
                <canvas id="movementTrendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Lists & Tables Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent items -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] overflow-hidden lg:col-span-2">
            <div class="flex items-center justify-between p-6 pb-4">
                <h3 class="text-sm font-poppins font-bold text-navy-text">Barang Terbaru</h3>
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
                            <tr class="hover:bg-slate-50/70 transition-colors duration-150">
                                <td class="px-6 py-4 text-navy-text font-medium whitespace-nowrap">{{ $barang->nama }}</td>
                                <td class="px-6 py-4 text-slate-text whitespace-nowrap">
                                    <span class="text-[10px] font-semibold text-primary-blue uppercase tracking-wider bg-light-blue-bg inline-block px-2 py-0.5 rounded">
                                        {{ $barang->kategori->nama ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col space-y-1.5 w-28">
                                        <span class="text-xs font-bold text-navy-text">{{ $barang->stok }} <span class="text-[9px] text-slate-text font-normal">/ Min: {{ $barang->stok_minimum }}</span></span>
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

        <!-- Need Restock List (Detail Tambahan) -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)]">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-sm font-poppins font-bold text-navy-text">Perlu Restock</h3>
                <span class="px-2 py-1 bg-rose-50 text-danger-red text-[10px] font-semibold rounded-full border border-rose-100">{{ $barang_restock->count() }} Item</span>
            </div>
            <div class="space-y-4">
                @forelse($barang_restock as $barang)
                    @php
                        $percentage = $barang->stok_minimum > 0 ? min(100, ($barang->stok / $barang->stok_minimum) * 100) : 100;
                        $bar_color = $barang->status === 'Habis' ? 'bg-danger-red' : 'bg-warning-amber';
                    @endphp
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-medium text-navy-text truncate pr-2">{{ $barang->nama }}</p>
                            <p class="text-xs font-bold {{ $barang->status === 'Habis' ? 'text-danger-red' : 'text-warning-amber' }}">{{ $barang->stok }} <span class="text-[9px] text-slate-text font-normal">/ {{ $barang->stok_minimum }}</span></p>
                        </div>
                        <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full {{ $bar_color }} rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
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
        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] overflow-hidden lg:col-span-3">
            <div class="flex items-center justify-between p-6 pb-4">
                <h3 class="text-sm font-poppins font-bold text-navy-text">Riwayat Pergerakan Stok Terbaru</h3>
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
                            <tr class="hover:bg-slate-50/70 transition-colors duration-150">
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
                                <td class="px-6 py-4 text-xs font-semibold text-navy-text whitespace-nowrap">{{ $movement->jumlah }} Unit</td>
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
    .custom-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>

<script>
    // Chart 1: Distribusi Status Stok (Doughnut)
    const ctxStatus = document.getElementById('stockStatusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: ['Stok Aman', 'Stok Menipis', 'Stok Habis'],
            datasets: [{
                data: [{{ $stok_aman_count }}, {{ $stok_menipis_count }}, {{ $stok_habis }}],
                backgroundColor: [
                    '#10b981', // success-green
                    '#f59e0b', // warning-amber
                    '#ef4444'  // danger-red
                ],
                borderWidth: 0,
                hoverOffset: 8,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { size: 12, weight: 'bold' },
                    bodyFont: { size: 11 },
                    cornerRadius: 8,
                    displayColors: false
                }
            }
        }
    });

    // Chart 2: Tren Pergerakan Stok (Bar)
    const ctxTrend = document.getElementById('movementTrendChart').getContext('2d');
    new Chart(ctxTrend, {
        type: 'bar',
        data: {
            labels: @json($labels_tren),
            datasets: [
                {
                    label: 'Stok Masuk',
                    data: @json($data_masuk),
                    backgroundColor: '#10b981',
                    borderRadius: 6,
                    borderSkipped: false,
                    barPercentage: 0.7,
                    categoryPercentage: 0.6
                },
                {
                    label: 'Stok Keluar',
                    data: @json($data_keluar),
                    backgroundColor: '#ef4444',
                    borderRadius: 6,
                    borderSkipped: false,
                    barPercentage: 0.7,
                    categoryPercentage: 0.6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    align: 'end',
                    labels: {
                        boxWidth: 8,
                        boxHeight: 8,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 11,
                            family: 'Poppins, sans-serif',
                            weight: '500'
                        },
                        color: '#64748b'
                    }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { size: 12, weight: 'bold' },
                    bodyFont: { size: 11 },
                    cornerRadius: 8,
                    displayColors: true,
                    boxPadding: 4
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    border: { display: false },
                    ticks: {
                        font: {
                            size: 11,
                            family: 'Poppins, sans-serif'
                        },
                        color: '#94a3b8'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f1f5f9',
                        drawBorder: false
                    },
                    border: { display: false },
                    ticks: {
                        font: {
                            size: 11,
                            family: 'Poppins, sans-serif'
                        },
                        color: '#94a3b8',
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection