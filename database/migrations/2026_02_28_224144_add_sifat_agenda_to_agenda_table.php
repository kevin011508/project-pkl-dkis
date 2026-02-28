<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agenda', function (Blueprint $table) {
            $table->enum('sifat_agenda', ['publik', 'privat'])
                  ->default('publik')
                  ->after('status'); // letakkan setelah kolom 'status'
        });
    }

    public function down(): void
    {
        Schema::table('agenda', function (Blueprint $table) {
            $table->dropColumn('sifat_agenda');
        });
    }
};