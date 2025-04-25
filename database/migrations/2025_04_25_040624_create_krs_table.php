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
        Schema::create('krs', function (Blueprint $table) {
            $table->string('NIM');
            $table->string('Kode_mk');
            $table->timestamps();
            $table->foreign('NIM')->references('NIM')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('Kode_mk')->references('Kode_mk')->on('matakuliahs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
