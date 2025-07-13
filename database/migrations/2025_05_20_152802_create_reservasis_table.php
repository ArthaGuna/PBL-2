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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('layanan_id')->constrained()->onDelete('cascade');
            $table->string('kode_booking')->unique();
            $table->string('nama_pengunjung');
            $table->date('tanggal_kunjungan');
            $table->time('waktu_kunjungan');
            $table->time('waktu_selesai')->nullable();
            $table->integer('jumlah_pengunjung');
            $table->decimal('total_harga', 12, 2);
            $table->decimal('diskon', 12, 2)->default(0);
            $table->decimal('total_bayar', 12, 2);
            $table->foreignId('promo_id')->nullable()->constrained('promos')->nullOnDelete();
            $table->enum('status_pembayaran', ['pending', 'success', 'cancelled', 'failed'])->default('pending');
            $table->boolean('stok_dikurangi')->default(false);
            $table->string('midtrans_transaction_id')->nullable();
            $table->string('midtrans_payment_type')->nullable();
            $table->string('midtrans_transaction_status')->nullable();
            $table->string('snap_token')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
