<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('id_skpd')->nullable()->index();
            $table->unsignedInteger('id_non_skpd')->nullable()->index();

            $table->string('nama_agenda', 191);
            $table->dateTime('tanggal_awal');
            $table->dateTime('tanggal_akhir')->nullable();

            $table->string('lokasi', 191);
            $table->text('alamat')->nullable();

            $table->text('deskripsi')->nullable();

            $table->string('penyelenggara', 191);

            $table->string('seragam', 191)->nullable();

            $table->string('disposisi', 191);

            $table->string('status')->default('belum');

            $table->string('berkas', 255)->nullable();

            
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->softDeletes();

            $table->tinyInteger('is_locked')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};