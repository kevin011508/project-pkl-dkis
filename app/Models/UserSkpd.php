<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkpd extends Model
{
    use HasFactory;

    protected $table = 'skpd'; // ✅ PERBAIKI INI
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'user_group',
        'skpd', // ini menyimpan ID skpd
        'terkunci',
    ];

    // ✅ RELASI KE TABEL SKPD
    public function skpdRel()
    {
        return $this->belongsTo(Skpd::class, 'skpd', 'id');
    }
}