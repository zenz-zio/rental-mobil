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
    Schema::create('mobils', function (Blueprint $table) {
        $table->id();
        $table->string('merk');
        $table->string('model');
        $table->string('no_plat')->unique();
        $table->year('tahun');
        $table->decimal('harga_per_hari', 12, 2);
        $table->string('foto')->nullable();
        $table->enum('status', ['tersedia', 'disewa'])
              ->default('tersedia');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
