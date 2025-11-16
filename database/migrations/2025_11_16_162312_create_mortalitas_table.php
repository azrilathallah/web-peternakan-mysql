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
            $table->integer('id_mortalitas', true);
            $table->date('tanggal');
            $table->integer('jumlah_mati');
            $table->string('penyebab');
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
