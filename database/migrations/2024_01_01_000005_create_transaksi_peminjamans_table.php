<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_anggota')->constrained('users');
            $table->foreignId('id_buku')->constrained('bukus');
            $table->foreignId('id_admin')->constrained('users');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_jatuh_tempo');
            $table->enum('status_peminjaman', ['dipinjam', 'dikembalikan', 'terlambat']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_peminjamans');
    }
};
