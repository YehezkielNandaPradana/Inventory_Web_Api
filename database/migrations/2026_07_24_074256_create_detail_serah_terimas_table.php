<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_serah_terimas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serah_terima_id')->constrained()->cascadeOnDelete();
            $table->foreignId('barang_id')->constrained()->cascadeOnDelete();
            $table->integer('jumlah');
            $table->string('kondisi')->default('baik');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_serah_terimas');
    }
};
