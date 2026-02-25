<?php
// app/Models/UserSkpd.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkpd extends Model
{
    use HasFactory;

    protected $table = 'user_skpd';

    protected $fillable = [
        'username',
        'user_group',
        'skpd',
    ];
}