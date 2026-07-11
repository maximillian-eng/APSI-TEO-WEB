<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('kategori_bukus');
            $table->foreignId('id_pengarang')->constrained('pengarangs');
            $table->string('judul');
            $table->string('isbn')->unique();
            $table->integer('stok_total');
            $table->integer('stok_tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
