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
        Schema::create('informasi_tikets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('informasi_id')->constrained()->onDelete('cascade');
            $table->string('kategori'); // Contoh: Kolam Anak, Jacuzzi
            $table->integer('harga'); // dalam Rupiah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_tikets');
    }
};
