@extends('layouts.app')

@section('title', 'Stok Movement')

@section('content')
<div class="space-y-8">
    <!-- Card 1: Add Movement Form -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)]">
        <div class="mb-6">
            <h3 class="text-base font-poppins font-semibold text-navy-text">Tambah Pergerakan Stok</h3>
            <p class="text-xs text-slate-text mt-1">Catat aktivitas penambahan atau pengurangan stok secara manual.</p>
        </div>
        
        <form action="/stok-movements" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="barang_id" class="block text-xs font-semibold text-slate-text mb-1.5">Barang</label>
                    <select name="barang_id" id="barang_id" 
                            class="w-full px-4 py-2.5 bg-light-blue-bg border border-transparent rounded-[10px] text-xs font-medium text-navy-text focus:outline-none focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all @error('barang_id') border-danger-red @enderror">
                        <option value="">Pilih Barang</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}" {{ old('barang_id') == $barang->id ? 'selected' : '' }}>{{ $barang->nama }}</option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <p class="mt-1 text-[10px] text-danger-red font-semibold">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="tipe" class="block text-xs font-semibold text-slate-text mb-1.5">Tipe</label>
                    <select name="tipe" id="tipe" 
                            class="w-full px-4 py-2.5 bg-light-blue-bg border border-transparent rounded-[10px] text-xs font-medium text-navy-text focus:outline-none focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all @error('tipe') border-danger-red @enderror">
                        <option value="masuk" {{ old('tipe') === 'masuk' ? 'selected' : '' }}>Masuk</option>
                        <option value="keluar" {{ old('tipe') === 'keluar' ? 'selected' : '' }}>Keluar</option>
                    </select>
                    @error('tipe')
                        <p class="mt-1 text-[10px] text-danger-red font-semibold">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="jumlah" class="block text-xs font-semibold text-slate-text mb-1.5">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" 
                           class="w-full px-4 py-2.5 bg-light-blue-bg border border-transparent rounded-[10px] text-xs font-medium text-navy-text focus:outline-none focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all @error('jumlah') border-danger-red @enderror">
                    @error('jumlah')
                        <p class="mt-1 text-[10px] text-danger-red font-semibold">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="keterangan" class="block text-xs font-semibold text-slate-text mb-1.5">Keterangan (opsional)</label>
                    <input type="text" name="keterangan" id="keterangan" value="{{ old('keterangan') }}" 
                           class="w-full px-4 py-2.5 bg-light-blue-bg border border-transparent rounded-[10px] text-xs font-medium text-navy-text focus:outline-none focus:ring-1.5 focus:ring-primary-blue focus:bg-white transition-all @error('keterangan') border-danger-red @enderror">
                    @error('keterangan')
                        <p class="mt-1 text-[10px] text-danger-red font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mt-5 pt-4 border-t border-slate-50 flex justify-end">
                <button type="submit" class="px-5 py-2.5 bg-primary-blue hover:bg-blue-600 text-white rounded-xl text-xs font-semibold shadow-sm transition-colors flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    <span>Catat Pergerakan</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Card 2: History List -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(45,125,210,0.04)]">
        <div class="mb-6">
            <h3 class="text-base font-poppins font-semibold text-navy-text">Riwayat Pergerakan Stok</h3>
            <p class="text-xs text-slate-text mt-1">Daftar lengkap log aktivitas penambahan dan pengurangan stok barang.</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead>
                    <tr>
                        <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Barang</th>
                        <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Tipe</th>
                        <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Jumlah</th>
                        <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Keterangan</th>
                        <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Tanggal</th>
                        <th class="pb-3 text-left text-[11px] font-semibold text-slate-text uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($stokMovements as $movement)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-3.5 pr-3">
                                <div class="font-medium text-xs text-navy-text">{{ $movement->barang->nama ?? '-' }}</div>
                            </td>
                            <td class="py-3.5 pr-3">
                                @if($movement->tipe === 'masuk')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-success-green border border-emerald-100">
                                        Masuk
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-rose-50 text-danger-red border border-rose-100">
                                        Keluar
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 pr-3 text-xs font-semibold text-navy-text">
                                {{ $movement->jumlah }}
                            </td>
                            <td class="py-3.5 pr-3 text-xs text-slate-text max-w-xs truncate">
                                {{ $movement->keterangan ?? '-' }}
                            </td>
                            <td class="py-3.5 pr-3 text-xs text-slate-text">
                                {{ $movement->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="py-3.5 text-xs font-medium">
                                <form action="/stok-movements/{{ $movement->id }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pergerakan stok ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger-red hover:text-rose-600 font-semibold transition-colors flex items-center space-x-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-xs text-slate-text">Belum ada pergerakan stok.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
