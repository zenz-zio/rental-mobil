<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            // Rental yang dibayar
            $table->foreignId('rental_id')
                ->constrained('rentals')
                ->cascadeOnDelete();

            // ID transaksi dari Midtrans
            $table->string('order_id')->unique();

            // Transaction ID dari Midtrans
            $table->string('transaction_id')->nullable();

            // Jumlah pembayaran
            $table->decimal('gross_amount', 15, 2);

            // Metode pembayaran
            $table->string('payment_type')->nullable();

            // Status pembayaran dari Midtrans
            $table->string('transaction_status')
                ->default('pending');

            // URL halaman pembayaran Midtrans
            $table->text('payment_url')->nullable();

            // Waktu pembayaran berhasil
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};