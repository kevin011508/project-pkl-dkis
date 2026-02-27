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
    Schema::table('non_skpd', function (Blueprint $table) {
        $table->string('username', 100)->nullable()->unique();
        $table->string('password')->nullable();
        $table->string('pin', 10)->nullable();
        $table->string('user_group', 100)->nullable();
        $table->tinyInteger('terkunci')->default(0);
    });
}

public function down(): void
{
    Schema::table('non_skpd', function (Blueprint $table) {
        $table->dropColumn(['username', 'password', 'pin', 'user_group', 'terkunci']);
    });
}
};
