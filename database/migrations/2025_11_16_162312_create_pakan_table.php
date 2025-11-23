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
        Schema::create('pakan', function (Blueprint $table) {
            $table->id('id_pakan');
            $table->date('tanggal');
            $table->float('konsumsi_pakan');
            $table->float('pemberian_pakan');
            $table->float('sisa_pakan');
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
        Schema::dropIfExists('pakan');
    }
};
