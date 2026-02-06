<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        Agenda::create([
            'nama_agenda' => 'Audiensi & Ekspose Kerjasama Penataan Rencana Penempatan Jaringan Utilitas Fiber Optik',
            'uraian' => null,
            'penyelenggara' => 'PT. Almajara Indo Tama',
            'lokasi' => 'Ruang Rapat Wali Kota Cirebon',
            'alamat' => 'JL. Siliwangi No. 84 Kota Cirebon',
            'disposisi' => 'Kabid ITIK',
            'seragam' => null,
            'tanggal_awal' => '2026-01-08 13:00:00',
            'tanggal_akhir' => null,
            'berkas' => null,
            'status' => 'completed',
        ]);
        
        // Tambah agenda contoh lainnya
        Agenda::create([
            'nama_agenda' => 'Rapat Koordinasi Smart City',
            'uraian' => 'Koordinasi implementasi smart city di wilayah Kota Cirebon',
            'penyelenggara' => 'Dinas Komunikasi dan Informatika',
            'lokasi' => 'Aula Utama Kantor Walikota',
            'alamat' => 'JL. Siliwangi No. 84 Kota Cirebon',
            'disposisi' => 'Kabid Teknologi Informasi',
            'seragam' => 'Batik',
            'tanggal_awal' => '2024-12-15 09:00:00',
            'tanggal_akhir' => '2024-12-15 12:00:00',
            'berkas' => 'undangan_smart_city.pdf',
            'status' => 'published',
        ]);
        
        Agenda::create([
            'nama_agenda' => 'Pelatihan Penggunaan Aplikasi ISUN',
            'uraian' => 'Pelatihan untuk operator kecamatan dalam penggunaan aplikasi ISUN',
            'penyelenggara' => 'Badan Pengembangan Sumber Daya Manusia',
            'lokasi' => 'Lab Komputer Kantor Walikota',
            'alamat' => 'JL. Siliwangi No. 84 Kota Cirebon',
            'disposisi' => 'Kabid Pelatihan',
            'seragam' => 'Bebas rapi',
            'tanggal_awal' => '2024-12-20 08:00:00',
            'tanggal_akhir' => '2024-12-21 16:00:00',
            'berkas' => 'jadwal_pelatihan.pdf',
            'status' => 'draft',
        ]);
    }
}