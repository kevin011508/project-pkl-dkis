<?php
// app/Models/NonSkpd.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonSkpd extends Model
{
    use HasFactory;

    protected $table = 'non_skpd';
    
    protected $fillable = [
        'nama',
        'alias'
    ];
}
?>