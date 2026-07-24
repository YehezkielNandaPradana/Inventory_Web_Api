<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->string('kode_barang')->unique()->nullable()->after('id');
            $table->foreignId('gudang_id')->nullable()->constrained()->nullOnDelete()->after('kategori_id');
            $table->string('kondisi')->default('baik')->after('stok_minimum');
        });
    }

    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropColumn(['kode_barang', 'gudang_id', 'kondisi']);
        });
    }
};
