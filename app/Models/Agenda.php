<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'agenda';
    
  protected $fillable = [
    'nama_agenda',
    'tanggal_awal',
    'tanggal_akhir',
    'lokasi',
    'alamat',
    'deskripsi',
    'penyelenggara',
    'seragam',
    'disposisi',
    'status',
    'lampiran',
    'created_by',
    'updated_by',
    'is_locked'
];

protected $casts = [
    'tanggal_awal' => 'datetime',
    'tanggal_akhir' => 'datetime',
];

protected $dates = ['deleted_at', 'tanggal_awal'];}

 

