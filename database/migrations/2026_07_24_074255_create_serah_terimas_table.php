<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('serah_terimas', function (Blueprint $table) {
            $table->id();
            $table->string('no_serah_terima')->unique();
            $table->date('tanggal');
            $table->string('dari_pihak');
            $table->string('kepada_pihak');
            $table->foreignId('dari_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('kepada_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('keterangan')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('serah_terimas');
    }
};
