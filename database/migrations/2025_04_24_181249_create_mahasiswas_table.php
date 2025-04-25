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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->string('NIM')->primary();
            $table->string('Nama');
            $table->text('Alamat')->nullable();
            $table->string('Nohp', 15)->nullable();
            $table->integer('Semester')->unsigned();
            $table->unsignedBigInteger('id_Gol');
            $table->foreign('id_Gol')->references('id_Gol')->on('golongans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
