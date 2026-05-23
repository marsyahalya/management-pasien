<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('resep_obat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('riwayat_kesehatan_id')->constrained('riwayat_kesehatan')->cascadeOnDelete();
            $table->date('tanggal_resep');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resep_obat');
    }
};
