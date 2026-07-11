<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengarang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_pengarang', 'biografi'];

    public function bukus(): HasMany
    {
        return $this->hasMany(Buku::class, 'id_pengarang');
    }
}
