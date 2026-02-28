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
    Schema::table('skpd', function (Blueprint $table) {
        if (!Schema::hasColumn('skpd', 'username')) {
            $table->string('username', 100)->nullable()->unique();
        }
        if (!Schema::hasColumn('skpd', 'password')) {
            $table->string('password')->nullable();
        }
        if (!Schema::hasColumn('skpd', 'user_group')) {
            $table->string('user_group', 100)->nullable();
        }
        if (!Schema::hasColumn('skpd', 'terkunci')) {
            $table->tinyInteger('terkunci')->default(0);
        }
    });
}

public function down(): void
{
    Schema::table('skpd', function (Blueprint $table) {
        $table->dropColumn(['username', 'password', 'user_group', 'terkunci']);
    });
}
    /**
     * Reverse the migrations.
     */

};
