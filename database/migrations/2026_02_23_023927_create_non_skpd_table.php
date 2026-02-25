<?php
// database/migrations/2024_01_01_000001_create_non_skpd_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('non_skpd', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alias')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('non_skpd');
    }
};
?>