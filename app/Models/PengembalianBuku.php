<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengembalianBuku extends Model
{
    use HasFactory;

    protected $table = 'pengembalian_bukus';

    protected $fillable = [
        'id_transaksi', 'id_admin', 'tanggal_pengembalian',
        'kondisi_buku', 'denda_keterlambatan', 'denda_kerusakan', 'total_denda',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pengembalian' => 'date',
            'denda_keterlambatan' => 'decimal:2',
            'denda_kerusakan' => 'decimal:2',
            'total_denda' => 'decimal:2',
        ];
    }

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(TransaksiPeminjaman::class, 'id_transaksi');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}
