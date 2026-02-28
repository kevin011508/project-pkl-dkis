<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('skpd');
     Schema::create('skpd', function (Blueprint $table) {
    $table->id();
    $table->char('kode', 3)->nullable();
    $table->char('kodegaji', 3)->nullable()->comment('utk aplikasi gaji');
    $table->string('uraian', 100)->nullable();
    $table->string('alias', 50)->nullable();
    $table->char('status_aktif', 1)->nullable();
    $table->integer('id_ref_eselon')->nullable()->default(0);
    $table->dateTime('date_entry')->nullable()->default(null);
    $table->dateTime('date_update')->nullable()->default(null);
    $table->string('user_entry', 100)->nullable();
    $table->string('user_update', 100)->nullable();
    // tambah kolom ini
    $table->string('username', 255)->nullable()->unique();
    $table->string('password', 255)->nullable();
    $table->string('user_group', 100)->nullable();
    $table->string('skpd', 100)->nullable();
    $table->tinyInteger('terkunci')->default(0);
});
    }

    public function down(): void
    {
        Schema::dropIfExists('skpd');
    }
};