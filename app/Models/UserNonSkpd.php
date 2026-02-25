<?php
// app/Models/UserNonSkpd.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNonSkpd extends Model
{
    use HasFactory;

    protected $table = 'user_non_skpd';

    protected $fillable = [
        'username',
        'user_group',
        'non_skpd',
        'pin',
    ];
}