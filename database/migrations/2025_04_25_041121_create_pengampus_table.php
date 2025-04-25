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
        Schema::create('pengampus', function (Blueprint $table) {
            $table->string('NIP');
            $table->string('Kode_mk');
            $table->foreign('Kode_mk')->references('Kode_mk')->on('matakuliahs')->onDelete('cascade');
            $table->foreign('NIP')->references('NIP')->on('dosens')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengampus');
    }
};
