<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengembalian_bukus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaksi')->unique()->constrained('transaksi_peminjamans');
            $table->foreignId('id_admin')->constrained('users');
            $table->date('tanggal_pengembalian');
            $table->string('kondisi_buku');
            $table->decimal('denda_keterlambatan', 10, 2)->default(0);
            $table->decimal('denda_kerusakan', 10, 2)->default(0);
            $table->decimal('total_denda', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengembalian_bukus');
    }
};
