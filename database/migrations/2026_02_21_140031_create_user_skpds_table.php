<?php
// database/migrations/[timestamp]_create_user_skpd_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_skpd', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('user_group');
            $table->text('skpd');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_skpd');
    }
};