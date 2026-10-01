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
    Schema::create('detail_perjalanan_dinas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('perjalanan_dinas_id')
              ->constrained('perjalanan_dinas')
              ->onDelete('cascade');

        $table->text('ringkasan_kegiatan');
        $table->string('foto_kegiatan')->nullable();
        $table->string('laporan')->nullable();
        $table->enum('status', ['draft', 'selesai'])->default('draft');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_perjalanan_dinas');
    }
};
