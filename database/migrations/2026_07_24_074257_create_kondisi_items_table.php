<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kondisi_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('jumlah_baik')->default(0);
            $table->integer('jumlah_rusak')->default(0);
            $table->integer('jumlah_perbaikan')->default(0);
            $table->text('keterangan')->nullable();
            $table->date('tanggal_pendataan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kondisi_items');
    }
};
