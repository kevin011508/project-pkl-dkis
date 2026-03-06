<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'username', 'password', 'role'];
    protected $hidden   = ['password'];

    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function getAuthIdentifier()
    {
        return $this->username;
    }

    /**
     * Cek apakah user adalah Non SKPD
     */
    public function isNonSkpd(): bool
    {
        return $this->role === 'non_skpd';
    }

    /**
     * Cek apakah user adalah superadmin
     */
    public function isSuperadmin(): bool
    {
        return $this->role === 'superadmin';
    }

    /**
     * Ambil data non_skpd jika role = non_skpd
     */
    public function nonSkpdData()
    {
        return $this->hasOne(UserNonSkpd::class, 'username', 'username');
    }
}