<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table = 'user_group'; // sesuai database

    protected $fillable = [
        'name',
        'permission',
        'level',
        'created_by',
        'updated_by'
    ];
}