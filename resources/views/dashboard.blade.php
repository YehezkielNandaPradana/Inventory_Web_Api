@extends('layouts.app')

@section('title', 'Dashboard')

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

<div class="space-y-8">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Barang -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.06)] flex items-center space-x-5 transition-transform duration-300 hover:-translate-y-1">
            <div class="w-12 h-12 rounded-xl bg-light-blue-bg flex items-center justify-center text-primary-blue">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                    <line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-text tracking-wide uppercase">Total Barang</p>
                <p class="text-2xl font-poppins font-semibold text-navy-text mt-1">{{ $total_barang }}</p>
            </div>
        </div>

        <!-- Stok Aman -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.06)] flex items-center space-x-5 transition-transform duration-300 hover:-translate-y-1">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-success-green">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-text tracking-wide uppercase">Stok Aman</p>
                <p class="text-2xl font-poppins font-semibold text-navy-text mt-1">{{ $stok_aman_count }}</p>
            </div>
        </div>

        <!-- Stok Menipis -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.06)] flex items-center space-x-5 transition-transform duration-300 hover:-translate-y-1">
            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-warning-amber">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-text tracking-wide uppercase">Stok Menipis</p>
                <p class="text-2xl font-poppins font-semibold text-navy-text mt-1">{{ $stok_menipis_count }}</p>
            </div>
        </div>

        <!-- Stok Habis -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.06)] flex items-center space-x-5 transition-transform duration-300 hover:-translate-y-1">
            <div class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center text-danger-red">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="15" y1="9" x2="9" y2="15"/>
                    <line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-text tracking-wide uppercase">Stok Habis</p>
                <p class="text-2xl font-poppins font-semibold text-navy-text mt-1">{{ $stok_habis }}</p>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Doughnut Chart: Distribusi Stok -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] flex flex-col">
            <h3 class="text-base font-poppins font-semibold text-navy-text mb-4">Distribusi Status Stok</h3>
            <div class="relative flex-grow flex items-center justify-center" style="min-height: 250px;">
                <canvas id="stockStatusChart"></canvas>
            </div>
            <div class="mt-4 grid grid-cols-3 gap-2 text-center">
                <div class="bg-emerald-50 rounded-lg p-2">
                    <p class="text-[10px] font-semibold text-success-green uppercase">Aman</p>
                    <p class="text-sm font-bold text-navy-text">{{ $stok_aman_count }}</p>
                </div>
                <div class="bg-amber-50 rounded-lg p-2">
                    <p class="text-[10px] font-semibold text-warning-amber uppercase">Menipis</p>
                    <p class="text-sm font-bold text-navy-text">{{ $stok_menipis_count }}</p>
                </div>
                <div class="bg-rose-50 rounded-lg p-2">
                    <p class="text-[10px] font-semibold text-danger-red uppercase">Habis</p>
                    <p class="text-sm font-bold text-navy-text">{{ $stok_habis }}</p>
                </div>
            </div>
        </div>

        <!-- Bar Chart: Tren Pergerakan Stok -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] lg:col-span-2">
            <h3 class="text-base font-poppins font-semibold text-navy-text mb-4">Tren Pergerakan Stok (7 Hari Terakhir)</h3>
            <div class="relative" style="min-height: 300px;">
                <canvas id="movementTrendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Tables Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent items -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-base font-poppins font-semibold text-navy-text">Barang Terbaru</h3>
                <a href="{{ route('barangs.index') }}" class="text-xs font-semibold text-primary-blue hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead>
                        <tr>
                            <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Barang</th>
                            <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Kategori</th>
                            <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Stok</th>
                            <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($barangs as $barang)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-3.5 pr-3">
                                    <div class="font-medium text-xs text-navy-text">{{ $barang->nama }}</div>
                                </td>
                                <td class="py-3.5 pr-3 text-xs text-slate-text">
                                    {{ $barang->kategori->nama ?? '-' }}
                                </td>
                                <td class="py-3.5 pr-3 text-xs font-semibold text-navy-text">
                                    <div class="flex flex-col space-y-1.5 w-24">
                                        <span>{{ $barang->stok }}</span>
                                        @php
                                            $max_val = max($barang->stok_minimum * 2, 10, $barang->stok);
                                            $percentage = $max_val > 0 ? ($barang->stok / $max_val) * 100 : 0;
                                            $color_class = 'bg-success-green';
                                            if ($barang->status === 'Habis') {
                                                $color_class = 'bg-danger-red';
                                            } elseif ($barang->status === 'Menipis') {
                                                $color_class = 'bg-warning-amber';
                                            }
                                        @endphp
                                        <div class="h-1.5 w-full bg-light-blue-bg rounded-full overflow-hidden">
                                            <div class="h-full {{ $color_class }} rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5">
                                    @if($barang->status === 'Habis')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-rose-50 text-danger-red border border-rose-100">Habis</span>
                                    @elseif($barang->status === 'Menipis')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-amber-50 text-warning-amber border border-amber-100">Menipis</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-success-green border border-emerald-100">Aman</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-xs text-slate-text">Belum ada data barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Need Restock List (Detail Tambahan) -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)]">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-base font-poppins font-semibold text-navy-text">Perlu Restock</h3>
                <span class="px-2 py-1 bg-rose-50 text-danger-red text-[10px] font-semibold rounded-full">{{ $barang_restock->count() }} Item</span>
            </div>
            <div class="space-y-4">
                @forelse($barang_restock as $barang)
                    <div class="flex items-center justify-between pb-3 border-b border-slate-50 last:border-0 last:pb-0">
                        <div>
                            <p class="text-xs font-medium text-navy-text">{{ $barang->nama }}</p>
                            <p class="text-[10px] text-slate-text mt-0.5">Min: {{ $barang->stok_minimum }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold {{ $barang->status === 'Habis' ? 'text-danger-red' : 'text-warning-amber' }}">{{ $barang->stok }}</p>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <svg class="w-10 h-10 text-success-green mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-xs text-slate-text font-medium">Semua stok aman</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent movements -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)] lg:col-span-3">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-base font-poppins font-semibold text-navy-text">Riwayat Pergerakan Stok Terbaru</h3>
                <a href="{{ route('stok-movements.index') }}" class="text-xs font-semibold text-primary-blue hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead>
                        <tr>
                            <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Barang</th>
                            <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Tipe</th>
                            <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Jumlah</th>
                            <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($stok_movements as $movement)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-3.5 pr-3">
                                    <div class="font-medium text-xs text-navy-text">{{ $movement->barang->nama ?? '-' }}</div>
                                </td>
                                <td class="py-3.5 pr-3">
                                    @if($movement->tipe === 'masuk')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-success-green border border-emerald-100">Masuk</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-rose-50 text-danger-red border border-rose-100">Keluar</span>
                                    @endif
                                </td>
                                <td class="py-3.5 pr-3 text-xs font-semibold text-navy-text">
                                    {{ $movement->jumlah }}
                                </td>
                                <td class="py-3.5 text-xs text-slate-text">
                                    {{ $movement->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-xs text-slate-text">Belum ada pergerakan stok.</td>
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
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    display: false // Dimatikan karena sudah ada custom legend di bawah chart
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
                    borderRadius: 4,
                    barPercentage: 0.6
                },
                {
                    label: 'Stok Keluar',
                    data: @json($data_keluar),
                    backgroundColor: '#ef4444',
                    borderRadius: 4,
                    barPercentage: 0.6
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
                        font: {
                            size: 11,
                            family: 'Poppins, sans-serif'
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f1f5f9'
                    },
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                }
            }
        }
    });
</script>
@endsection