<?php
// app/Models/UserSkpd.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkpd extends Model
{
    use HasFactory;

   protected $table = 'skpd';
   public $timestamps = false;

protected $fillable = [
    'username',
    'password',
    'user_group',
    'skpd',
    'terkunci',
];
}