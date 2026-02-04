<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_agenda',
        'deskripsi',
        'penyelenggara',
        'lokasi',
        'alamat',
        'disposisi',
        'seragam',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_selesai',
        'lampiran',
        'sifat_agenda',
        'status'
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'status_selesai' => 'boolean',
    ];
}