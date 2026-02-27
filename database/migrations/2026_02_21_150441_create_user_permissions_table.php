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
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');                          // int UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('controller', 32);                  // varchar(32) NOT NULL
            $table->string('action', 32);                      // varchar(32) NOT NULL
            $table->string('info', 100);                       // varchar(100) NOT NULL
            $table->timestamp('created_at')->nullable();       // timestamp NULL
            $table->timestamp('updated_at')->nullable();       // timestamp NULL
            $table->unsignedInteger('created_by')->nullable(); // int UNSIGNED NULL
            $table->unsignedInteger('updated_by')->nullable(); // int UNSIGNED NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};