<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

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
        'sifat_agenda',
        'status',
        'lampiran',
        'created_by',
        'updated_by',
        'is_locked',
    ];

    protected $casts = [
        'tanggal_awal'  => 'datetime',
        'tanggal_akhir' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Accessor: status_realtime
     * Gunakan $agenda->status_realtime di blade untuk tampilan
     * yang selalu akurat berdasarkan waktu WIB saat ini,
     * tanpa perlu mengubah nilai di database.
     */
    public function getStatusRealtimeAttribute(): string
    {
        // Jika sudah ditandai selesai secara manual, tetap selesai
        if ($this->status === 'selesai') {
            return 'selesai';
        }

        $now   = Carbon::now('Asia/Jakarta');
        $mulai = Carbon::parse($this->tanggal_awal)->setTimezone('Asia/Jakarta');

        if ($this->tanggal_akhir) {
            $selesai = Carbon::parse($this->tanggal_akhir)->setTimezone('Asia/Jakarta');
            if ($now->greaterThan($selesai)) {
                return 'selesai';
            }
        }

        if ($now->greaterThanOrEqualTo($mulai)) {
            return 'berjalan';
        }

        return 'belum';
    }
}