<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stokku - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-50 text-navy-text font-inter flex flex-col md:flex-row antialiased">
    <!-- Sidebar (Desktop/Tablet) -->
    <aside class="hidden md:flex flex-col w-[232px] bg-white border-r border-slate-100 fixed top-0 bottom-0 left-0 z-20">
        <!-- Logo -->
        <div class="h-16 flex items-center px-6 border-b border-slate-50">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <!-- Box Outline Icon (Stokku Logo) -->
                <svg class="w-6 h-6 text-primary-blue" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                    <line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
                <span class="text-xl font-poppins font-semibold text-navy-text tracking-wide">Stokku</span>
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto custom-scroll">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Master -->
            <div class="pt-4 pb-1">
                <p class="px-3 text-[10px] font-semibold text-slate-text uppercase tracking-widest">Master</p>
            </div>

            <a href="/barangs" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('barangs*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                    <line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
                <span>Barang</span>
            </a>

            <a href="/kategoris" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('kategoris*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <rect width="7" height="7" x="3" y="3" rx="1"/>
                    <rect width="7" height="7" x="14" y="3" rx="1"/>
                    <rect width="7" height="7" x="14" y="14" rx="1"/>
                    <rect width="7" height="7" x="3" y="14" rx="1"/>
                </svg>
                <span>Kategori</span>
            </a>

            <a href="/merk" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('merk*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 0 1 0 2.828l-7 7a2 2 0 0 1-2.828 0l-7-7A1.994 1.994 0 0 1 3 12V7a4 4 0 0 1 4-4z"/>
                </svg>
                <span>Merk</span>
            </a>

            <a href="/supplier" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('supplier*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                <span>Supplier</span>
            </a>

            <a href="/lokasi" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('lokasi*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                </svg>
                <span>Lokasi</span>
            </a>

            <!-- Transaksi -->
            <div class="pt-4 pb-1">
                <p class="px-3 text-[10px] font-semibold text-slate-text uppercase tracking-widest">Transaksi</p>
            </div>

            <a href="/barang-masuk" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('barang-masuk*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polyline points="16 3 21 3 21 8"/><line x1="4" y1="20" x2="21" y2="3"/><polyline points="21 16 21 21 16 21"/><line x1="15" y1="15" x2="21" y2="21"/><line x1="4" y1="4" x2="9" y2="9"/>
                </svg>
                <span>Barang Masuk</span>
            </a>

            <a href="/barang-keluar" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('barang-keluar*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polyline points="16 3 21 3 21 8"/><line x1="4" y1="20" x2="21" y2="3"/><polyline points="21 16 21 21 16 21"/><line x1="15" y1="15" x2="21" y2="21"/><line x1="4" y1="4" x2="9" y2="9"/>
                </svg>
                <span>Barang Keluar</span>
            </a>

            <a href="/peminjaman" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('peminjaman*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                <span>Peminjaman</span>
            </a>

            <a href="/pengembalian" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('pengembalian*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/>
                </svg>
                <span>Pengembalian</span>
            </a>

            <!-- Maintenance -->
            <div class="pt-4 pb-1">
                <p class="px-3 text-[10px] font-semibold text-slate-text uppercase tracking-widest">Maintenance</p>
            </div>

            <a href="/maintenance/jadwal" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('maintenance/jadwal*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><path d="M9 16l2 2 4-4"/>
                </svg>
                <span>Jadwal Maintenance</span>
            </a>

            <a href="/maintenance/riwayat" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('maintenance/riwayat*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
                <span>Riwayat Maintenance</span>
            </a>

            <a href="/barang-rusak" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('barang-rusak*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
                <span>Barang Rusak</span>
            </a>

            <!-- Stock Opname -->
            <div class="pt-4 pb-1">
                <p class="px-3 text-[10px] font-semibold text-slate-text uppercase tracking-widest">Lainnya</p>
            </div>

            <a href="/stock-opname" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('stock-opname*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/><path d="M18 2l3 3-9 9-4 1 1-4 9-9z"/>
                </svg>
                <span>Stock Opname</span>
            </a>

            <a href="/pembelian" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('pembelian*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                </svg>
                <span>Pembelian</span>
            </a>

            <a href="/laporan" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('laporan*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                </svg>
                <span>Laporan</span>
            </a>

            <!-- User Management -->
            <div class="pt-4 pb-1">
                <p class="px-3 text-[10px] font-semibold text-slate-text uppercase tracking-widest">Sistem</p>
            </div>

            <a href="/user-management" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('user-management*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
                </svg>
                <span>User Management</span>
            </a>

            <a href="/audit-log" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('audit-log*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
                </svg>
                <span>Audit Log</span>
            </a>

            <a href="/notifikasi" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('notifikasi*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/>
                </svg>
                <span>Notifikasi</span>
            </a>

            <a href="/pengaturan" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('pengaturan*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/>
                </svg>
                <span>Pengaturan</span>
            </a>

            <a href="/profile" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('profile*') ? 'bg-light-blue-bg text-primary-blue' : 'text-slate-text hover:bg-slate-50 hover:text-navy-text' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
                <span>Profile</span>
            </a>
        </nav>

        <!-- Profile Card -->
        <div class="p-4 border-t border-slate-50">
            <div class="flex items-center space-x-3 p-2 rounded-xl bg-slate-50">
                <div class="w-9 h-9 rounded-full bg-primary-blue text-white flex items-center justify-center font-semibold text-sm">
                    A
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-navy-text truncate">Administrator</p>
                    <p class="text-[10px] text-slate-text truncate">admin@gmail.com</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 md:pl-[232px] flex flex-col min-h-screen pb-20 md:pb-0">
        <!-- Topbar -->
        <header class="h-16 bg-white border-b border-slate-100 flex items-center justify-between px-4 md:px-8 sticky top-0 z-10">
            <div>
                <span class="text-[11px] font-semibold text-slate-text tracking-wider uppercase block">
                    {{ now()->translatedFormat('l, d F Y') }}
                </span>
                <h1 class="text-base md:text-lg font-poppins font-semibold text-navy-text flex items-center gap-1.5">
                    Halo, Admin 
                </h1>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Search bar -->
                <div class="hidden sm:flex items-center relative">
                    <span class="absolute left-3.5 text-slate-text">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </span>
                    <input type="text" placeholder="Cari barang..." class="w-60 pl-10 pr-4 py-1.5 bg-slate-50 border-0 rounded-xl text-xs focus:ring-1.5 focus:ring-primary-blue transition-all duration-200">
                </div>

                <!-- Notifications -->
                <button class="relative p-2 rounded-xl hover:bg-slate-50 transition-colors text-slate-text">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                    </svg>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-danger-red rounded-full"></span>
                </button>

                <!-- Avatar -->
                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center font-medium text-xs text-navy-text">
                    AD
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 p-4 md:p-8">
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-success-green p-4 rounded-xl flex items-center justify-between shadow-sm">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-success-green" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-rose-50 border-l-4 border-danger-red p-4 rounded-xl flex items-center justify-between shadow-sm">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-danger-red shrink-0" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                        </svg>
                        <p class="text-sm font-medium text-rose-800">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-400 hover:text-rose-600 transition-colors shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-rose-50 border-l-4 border-danger-red p-4 rounded-xl shadow-sm">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-danger-red mt-0.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                        </svg>
                        <div class="text-sm text-rose-800 space-y-1">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-400 hover:text-rose-600 transition-colors shrink-0 mt-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Mobile Bottom Navigation (screens <= 760px) -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 h-16 bg-white border-t border-slate-100 flex items-center justify-around px-4 z-30 shadow-lg">
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center space-y-0.5 text-[10px] font-medium {{ request()->routeIs('dashboard') ? 'text-primary-blue font-semibold' : 'text-slate-text' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            <span>Home</span>
        </a>

        <a href="/barangs" class="flex flex-col items-center space-y-0.5 text-[10px] font-medium {{ request()->is('barangs*') ? 'text-primary-blue font-semibold' : 'text-slate-text' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
            </svg>
            <span>Barang</span>
        </a>

        <a href="/kategoris" class="flex flex-col items-center space-y-0.5 text-[10px] font-medium {{ request()->is('kategoris*') ? 'text-primary-blue font-semibold' : 'text-slate-text' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <rect width="7" height="7" x="3" y="3" rx="1"/>
                <rect width="7" height="7" x="14" y="3" rx="1"/>
                <rect width="7" height="7" x="14" y="14" rx="1"/>
                <rect width="7" height="7" x="3" y="14" rx="1"/>
            </svg>
            <span>Kategori</span>
        </a>

        <a href="/laporan" class="flex flex-col items-center space-y-0.5 text-[10px] font-medium {{ request()->is('laporan*') ? 'text-primary-blue font-semibold' : 'text-slate-text' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
            </svg>
            <span>Laporan</span>
        </a>

        <a href="/pengaturan" class="flex flex-col items-center space-y-0.5 text-[10px] font-medium {{ request()->is('pengaturan*') ? 'text-primary-blue font-semibold' : 'text-slate-text' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/>
            </svg>
            <span>Settings</span>
        </a>
    </nav>
</body>
</html>
