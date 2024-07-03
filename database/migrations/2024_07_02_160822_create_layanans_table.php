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
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
        });

        Schema::table('pesanans', function (Blueprint $table) {
            $table->foreignId('layanan_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropForeign(['layanan_id']);
            $table->dropColumn('layanan_id');
        });
        
        Schema::dropIfExists('layanans');
    }
};
