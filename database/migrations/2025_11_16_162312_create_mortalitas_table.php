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
        Schema::create('mortalitas', function (Blueprint $table) {
            $table->id('id_mortalitas');
            $table->date('tanggal');
            $table->integer('jumlah_mati');
            $table->string('penyebab');
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
        Schema::dropIfExists('mortalitas');
    }
};
