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
        Schema::create('jadwalakademiks', function (Blueprint $table) {
            $table->string('hari');
            $table->string('Kode_mk');
            $table->unsignedBigInteger('id_Ruang');
            $table->unsignedBigInteger('id_Gol');
            $table->timestamps();
            $table->foreign('Kode_mk')->references('Kode_mk')->on('matakuliahs')->onDelete('cascade');
            $table->foreign('id_Ruang')->references('id_Ruang')->on('ruangs')->onDelete('cascade');
            $table->foreign('id_Gol')->references('id_Gol')->on('golongans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwalakademiks');
    }
};
