<?php
// database/migrations/2024_01_01_000001_create_non_skpd_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('non_skpd', function (Blueprint $table) {

            $table->id(); // primary key auto increment

            $table->string('nama', 100);

            $table->string('alias', 50);

            $table->timestamp('created_at')->nullable();

            $table->timestamp('updated_at')->nullable();

            $table->unsignedInteger('created_by')->nullable();

            $table->unsignedInteger('updated_by')->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('non_skpd');
    }
};