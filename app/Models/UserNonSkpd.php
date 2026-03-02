<?php
// app/Models/UserNonSkpd.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNonSkpd extends Model
{
    use HasFactory;

    protected $table = 'non_skpd';

    protected $fillable = [
        'username',
        'password',
        'pin',
        'user_group',
        'non_skpd',
        'terkunci',
    ];

    // ✅ Cast kolom tanggal supaya tidak null error
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}