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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('kode_promo')->unique();
            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('jenis_diskon', ['persentase', 'nominal'])->default('persentase');
            $table->decimal('nilai_diskon', 12, 2);
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->decimal('minimal_pembelian', 12, 2)->nullable();
            $table->decimal('maksimal_diskon', 12, 2)->nullable();
            $table->integer('kuota')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
