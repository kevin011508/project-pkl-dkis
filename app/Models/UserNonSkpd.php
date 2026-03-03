<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNonSkpd extends Model
{
    use HasFactory;

    // ✅ Tabel non_skpd menyimpan SEKALIGUS data organisasi + data user login
    protected $table = 'non_skpd';

    protected $fillable = [
        'nama',
        'alias',
        'username',
        'password',
        'pin',
        'user_group',
        'terkunci',
    ];

    protected $hidden = [
        'password',
        'pin',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'terkunci'   => 'integer',
    ];

    /**
     * Ambil data UserGroup berdasarkan nama group
     */
    public function userGroup()
    {
        return $this->belongsTo(UserGroup::class, 'user_group', 'name');
    }
}