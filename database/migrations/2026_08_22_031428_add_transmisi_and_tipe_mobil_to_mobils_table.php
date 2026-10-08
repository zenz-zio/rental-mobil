<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mobils', function (Blueprint $table) {
            $table->enum('transmisi', ['Matic', 'Manual'])
                  ->default('Matic')
                  ->after('tahun');

            $table->enum('tipe_mobil', ['City Car', 'Sedan', 'SUV', 'MPV'])
                  ->nullable()
                  ->after('transmisi');
        });
    }

    public function down(): void
    {
        Schema::table('mobils', function (Blueprint $table) {
            $table->dropColumn(['transmisi', 'tipe_mobil']);
        });
    }
};