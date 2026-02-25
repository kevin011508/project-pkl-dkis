<?php
// database/migrations/[timestamp]_create_user_non_skpd_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_non_skpd', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('user_group');
            $table->string('non_skpd');
            $table->string('pin');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_non_skpd');
    }
};