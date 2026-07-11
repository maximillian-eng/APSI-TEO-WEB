<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['nama', 'email', 'password', 'role', 'no_telepon', 'status_anggota'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isAnggota(): bool
    {
        return $this->role === 'anggota';
    }

    public function isActive(): bool
    {
        return $this->status_anggota === 'Aktif';
    }

    public function peminjaman(): HasMany
    {
        return $this->hasMany(TransaksiPeminjaman::class, 'id_anggota');
    }

    public function adminPeminjaman(): HasMany
    {
        return $this->hasMany(TransaksiPeminjaman::class, 'id_admin');
    }
}
