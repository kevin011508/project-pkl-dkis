<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_agenda');
            $table->text('deskripsi')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->string('lokasi');
            $table->text('alamat')->nullable();
            $table->string('disposisi');
            $table->string('seragam')->nullable();
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->boolean('status_selesai')->default(false);
            $table->enum('sifat_agenda', ['publik', 'privat']);
            $table->string('status')->default('belum');
            $table->string('lampiran')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
