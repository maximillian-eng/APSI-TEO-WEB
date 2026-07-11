<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Pengarang;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@perpustakaan.com',
            'password' => 'password',
            'role' => 'admin',
            'status_anggota' => 'Aktif',
        ]);

        // Anggota
        $anggota1 = User::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'password' => 'password',
            'role' => 'anggota',
            'status_anggota' => 'Aktif',
            'no_telepon' => '081234567890',
        ]);

        User::create([
            'nama' => 'Siti Rahayu',
            'email' => 'siti@email.com',
            'password' => 'password',
            'role' => 'anggota',
            'status_anggota' => 'Aktif',
            'no_telepon' => '085678901234',
        ]);

        User::create([
            'nama' => 'Andi Wijaya',
            'email' => 'andi@email.com',
            'password' => 'password',
            'role' => 'anggota',
            'status_anggota' => 'Non-aktif',
            'no_telepon' => '089012345678',
        ]);

        // Kategori
        $fiksi = KategoriBuku::create(['nama_kategori' => 'Fiksi', 'deskripsi' => 'Novel dan cerita rekaan pengarang']);
        $sains = KategoriBuku::create(['nama_kategori' => 'Sains', 'deskripsi' => 'Buku ilmiah dan pengetahuan umum']);
        $teknologi = KategoriBuku::create(['nama_kategori' => 'Teknologi', 'deskripsi' => 'Buku tentang pemrograman dan teknologi informasi']);
        $sejarah = KategoriBuku::create(['nama_kategori' => 'Sejarah', 'deskripsi' => 'Buku tentang peristiwa sejarah']);
        $bisnis = KategoriBuku::create(['nama_kategori' => 'Bisnis', 'deskripsi' => 'Buku manajemen dan kewirausahaan']);

        // Pengarang
        $pram = Pengarang::create(['nama_pengarang' => 'Pramoedya Ananta Toer', 'biografi' => 'Sastrawan Indonesia terkemuka, penulis Tetralogi Buru.']);
        $andrea = Pengarang::create(['nama_pengarang' => 'Andrea Hirata', 'biografi' => 'Penulis Indonesia, terkenal dengan novel Laskar Pelangi.']);
        $tere = Pengarang::create(['nama_pengarang' => 'Tere Liye', 'biografi' => 'Penulis Indonesia produktif dengan genre fiksi dan remaja.']);
        $robert = Pengarang::create(['nama_pengarang' => 'Robert T. Kiyosaki', 'biografi' => 'Pengusaha dan penulis terkenal dengan buku Rich Dad Poor Dad.']);
        $abdul = Pengarang::create(['nama_pengarang' => 'Abdul Kadir', 'biografi' => 'Penulis buku pemrograman komputer Indonesia.']);

        // Buku
        Buku::create(['id_kategori' => $fiksi->id, 'id_pengarang' => $pram->id, 'judul' => 'Bumi Manusia', 'isbn' => '978-602-4250-10-5', 'stok_total' => 5, 'stok_tersedia' => 5]);
        Buku::create(['id_kategori' => $fiksi->id, 'id_pengarang' => $pram->id, 'judul' => 'Gadis Pantai', 'isbn' => '978-602-4250-11-2', 'stok_total' => 3, 'stok_tersedia' => 3]);
        Buku::create(['id_kategori' => $fiksi->id, 'id_pengarang' => $andrea->id, 'judul' => 'Laskar Pelangi', 'isbn' => '978-602-8360-01-3', 'stok_total' => 4, 'stok_tersedia' => 4]);
        Buku::create(['id_kategori' => $fiksi->id, 'id_pengarang' => $tere->id, 'judul' => 'Bulan', 'isbn' => '978-602-7826-01-7', 'stok_total' => 3, 'stok_tersedia' => 3]);
        Buku::create(['id_kategori' => $sains->id, 'id_pengarang' => $abdul->id, 'judul' => 'Sains Populer', 'isbn' => '978-602-5555-01-2', 'stok_total' => 2, 'stok_tersedia' => 2]);
        Buku::create(['id_kategori' => $teknologi->id, 'id_pengarang' => $abdul->id, 'judul' => 'Pemrograman Web dengan PHP', 'isbn' => '978-602-6666-01-4', 'stok_total' => 6, 'stok_tersedia' => 6]);
        Buku::create(['id_kategori' => $teknologi->id, 'id_pengarang' => $abdul->id, 'judul' => 'Belajar Laravel dari Dasar', 'isbn' => '978-602-7777-01-8', 'stok_total' => 4, 'stok_tersedia' => 4]);
        Buku::create(['id_kategori' => $bisnis->id, 'id_pengarang' => $robert->id, 'judul' => 'Rich Dad Poor Dad', 'isbn' => '978-602-8888-01-1', 'stok_total' => 3, 'stok_tersedia' => 3]);
        Buku::create(['id_kategori' => $sejarah->id, 'id_pengarang' => $pram->id, 'judul' => 'Cerita dari Blora', 'isbn' => '978-602-9999-01-6', 'stok_total' => 2, 'stok_tersedia' => 2]);
    }
}
