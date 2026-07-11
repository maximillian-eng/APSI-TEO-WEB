<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransaksiPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'transaksi_peminjamans';

    protected $fillable = [
        'id_anggota', 'id_buku', 'id_admin',
        'tanggal_pinjam', 'tanggal_jatuh_tempo', 'status_peminjaman',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pinjam' => 'date',
            'tanggal_jatuh_tempo' => 'date',
        ];
    }

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_anggota');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function pengembalian(): HasOne
    {
        return $this->hasOne(PengembalianBuku::class, 'id_transaksi');
    }

    public function isOverdue(): bool
    {
        return $this->status_peminjaman === 'dipinjam' && $this->tanggal_jatuh_tempo->isPast();
    }

    public function daysOverdue(): int
    {
        if (! $this->isOverdue()) {
            return 0;
        }

        return (int) $this->tanggal_jatuh_tempo->diffInDays(now());
    }
}
