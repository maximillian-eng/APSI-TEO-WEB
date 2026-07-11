<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriBuku extends Model
{
    use HasFactory;

    protected $table = 'kategori_bukus';

    protected $fillable = ['nama_kategori', 'deskripsi'];

    public function bukus(): HasMany
    {
        return $this->hasMany(Buku::class, 'id_kategori');
    }
}
