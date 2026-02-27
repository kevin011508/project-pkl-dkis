<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use HasFactory, SoftDeletes;
    

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
    'deleted_by',
    'is_locked'
];

    protected $casts = [
    'tanggal_awal' => 'datetime',
    'tanggal_akhir' => 'datetime',
    'deleted_at' => 'datetime',  
    'is_locked' => 'boolean',
];

       public function deletedByUser()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }


}



 

