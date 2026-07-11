<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = ['id_kategori', 'id_pengarang', 'judul', 'isbn', 'stok_total', 'stok_tersedia'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriBuku::class, 'id_kategori');
    }

    public function pengarang(): BelongsTo
    {
        return $this->belongsTo(Pengarang::class, 'id_pengarang');
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(TransaksiPeminjaman::class, 'id_buku');
    }

    public function isAvailable(): bool
    {
        return $this->stok_tersedia > 0;
    }
}
