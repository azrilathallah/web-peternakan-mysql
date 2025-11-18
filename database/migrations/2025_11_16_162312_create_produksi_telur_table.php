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
        Schema::create('produksi_telur', function (Blueprint $table) {
            $table->id('id_produksi');
            $table->date('tanggal');
            $table->integer('jumlah_telur');
            $table->foreignId('kandang_id')
                ->constrained(table: 'kandang', column: 'id_kandang')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produksi_telur');
    }
};
