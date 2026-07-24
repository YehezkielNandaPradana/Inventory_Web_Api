<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Stokku</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap');

        .bg-login {
            background: linear-gradient(135deg, #f0f7ff 0%, #eaf4ff 50%, #dceeff 100%);
        }

        .login-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow:
                0 4px 24px rgba(45, 125, 210, 0.06),
                0 20px 60px rgba(45, 125, 210, 0.08);
        }

        .input-field {
            transition: all 0.2s ease;
            background: #f8faff;
            border: 1.5px solid #e2e8f0;
        }

        .input-field:focus {
            background: #ffffff;
            border-color: #2D7DD2;
            box-shadow: 0 0 0 3px rgba(45, 125, 210, 0.12);
        }

        .btn-primary {
            background: linear-gradient(135deg, #2D7DD2 0%, #1a6bc4 100%);
            transition: all 0.25s ease;
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(45, 125, 210, 0.35);
        }

        .btn-primary:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .illustration-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.3;
            pointer-events: none;
        }

        .float-anim {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        .spinner {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: #ffffff;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (prefers-reduced-motion: reduce) {
            .float-anim { animation: none; }
            .input-field, .login-card, .btn-primary { transition: none; }
        }
    </style>
</head>
<body class="h-full font-inter antialiased">
    <div class="min-h-screen flex bg-login relative overflow-hidden">
        <!-- Dekorasi Latar -->
        <div class="illustration-blob w-96 h-96 bg-primary-blue -top-20 -right-20"></div>
        <div class="illustration-blob w-80 h-80 bg-sky-blue -bottom-32 -left-16"></div>
        <div class="illustration-blob w-64 h-64 bg-primary-blue top-1/2 -left-32"></div>

        <div class="flex-1 flex items-center justify-center p-4 sm:p-8 relative z-10">
            <div class="w-full max-w-[440px]">
                <!-- Logo -->
                <div class="text-center mb-10">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white shadow-[0_4px_20px_rgba(45,125,210,0.12)] mb-5">
                        <svg class="w-8 h-8 text-primary-blue" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                            <line x1="12" y1="22.08" x2="12" y2="12"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-poppins font-semibold text-navy-text">Stokku</h1>
                    <p class="text-sm text-slate-text mt-1.5">Masuk untuk mengelola inventaris Anda</p>
                </div>

                <!-- Card Login -->
                <div class="login-card rounded-2xl p-8 sm:p-10">
                    <form method="POST" action="{{ route('login') }}" id="loginForm" class="space-y-5">
                        @csrf

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-navy-text mb-1.5">Username</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-text" aria-hidden="true">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    value="{{ old('username') }}"
                                    placeholder="Masukkan username"
                                    autocomplete="username"
                                    autofocus
                                    required
                                    aria-describedby="username-error"
                                    class="input-field w-full pl-10 pr-4 py-3 rounded-xl text-sm text-navy-text placeholder:text-slate-text/60 outline-none focus:ring-2 focus:ring-primary-blue/20 @error('username') border-danger-red @enderror"
                                >
                            </div>
                            @error('username')
                                <p id="username-error" class="mt-1.5 text-xs text-danger-red font-medium flex items-center gap-1" role="alert">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-navy-text mb-1.5">Password</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-text" aria-hidden="true">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                    </svg>
                                </span>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Masukkan password"
                                    autocomplete="current-password"
                                    required
                                    aria-describedby="password-error"
                                    class="input-field w-full pl-10 pr-4 py-3 rounded-xl text-sm text-navy-text placeholder:text-slate-text/60 outline-none focus:ring-2 focus:ring-primary-blue/20 @error('password') border-danger-red @enderror"
                                >
                            </div>
                            @error('password')
                                <p id="password-error" class="mt-1.5 text-xs text-danger-red font-medium flex items-center gap-1" role="alert">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <button type="submit" id="submitBtn" class="btn-primary w-full py-3 rounded-xl text-sm font-semibold text-white tracking-wide cursor-pointer flex items-center justify-center gap-2">
                            <span id="btnText">Masuk</span>
                            <span id="btnLoader" class="spinner hidden"></span>
                            <svg id="btnArrow" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9 18l6-6-6-6"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Footer -->
                <p class="text-center text-[11px] text-slate-text/60 mt-8">
                    &copy; {{ date('Y') }} Stokku &mdash; Sistem Manajemen Inventaris
                </p>
            </div>
        </div>

        <!-- Panel Kanan (ilustrasi) -->
        <div class="hidden lg:flex w-[480px] bg-primary-blue relative overflow-hidden items-center justify-center p-12">
            <div class="absolute inset-0 opacity-[0.07]"
                style="background-image:
                    linear-gradient(rgba(255,255,255,0.15) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,0.15) 1px, transparent 1px);
                    background-size: 32px 32px;">
            </div>

            <div class="illustration-blob w-72 h-72 bg-white top-10 right-10 opacity-[0.08]"></div>
            <div class="illustration-blob w-96 h-96 bg-white bottom-10 left-10 opacity-[0.06]"></div>

            <div class="relative text-center text-white space-y-6">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-sm mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                        <line x1="12" y1="22.08" x2="12" y2="12"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-poppins font-semibold leading-tight">Kelola Inventaris<br>dengan Mudah</h2>
                <p class="text-sm text-white/70 max-w-xs mx-auto leading-relaxed">
                    Pantau stok barang, lacak pergerakan, dan buat keputusan lebih cepat dalam satu dashboard.
                </p>

                <div class="flex flex-wrap justify-center gap-3 pt-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 text-[11px] font-medium text-white/80">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Real-time
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 text-[11px] font-medium text-white/80">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        Terstruktur
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 text-[11px] font-medium text-white/80">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22s8-4-8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Aman
                    </span>
                </div>

                <!-- Ilustrasi bar chart sederhana -->
                <div class="flex items-end justify-center gap-3 pt-6">
                    <div class="w-8 h-16 rounded-lg bg-white/15"></div>
                    <div class="w-8 h-24 rounded-lg bg-white/25"></div>
                    <div class="w-8 h-20 rounded-lg bg-white/20"></div>
                    <div class="w-8 h-28 rounded-lg bg-white/30"></div>
                    <div class="w-8 h-14 rounded-lg bg-white/15"></div>
                    <div class="w-8 h-22 rounded-lg bg-white/20"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnArrow = document.getElementById('btnArrow');
            const btnLoader = document.getElementById('btnLoader');

            btn.disabled = true;
            btnText.textContent = 'Memproses...';
            btnArrow.classList.add('hidden');
            btnLoader.classList.remove('hidden');
        });
    </script>
</body>
</html>
