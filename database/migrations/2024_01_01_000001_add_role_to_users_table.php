<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'anggota'])->default('anggota');
            $table->string('no_telepon')->nullable();
            $table->enum('status_anggota', ['Aktif', 'Non-aktif'])->default('Aktif');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'no_telepon', 'status_anggota']);
        });
    }
};
