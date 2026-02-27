<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('crb_skpd');
        Schema::create('crb_skpd', function (Blueprint $table) {
            $table->double('id')->autoIncrement()->primary();
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
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crb_skpd');
    }
};