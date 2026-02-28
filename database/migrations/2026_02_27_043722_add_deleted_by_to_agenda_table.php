<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
       Schema::table('agenda', function (Blueprint $table) {
            // $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->nullOnDelete();
    });
}

    public function down(): void
{
        Schema::table('agenda', function (Blueprint $table) {
            $table->dropColumn('deleted_by');
            $table->dropSoftDeletes();
    });
}
};