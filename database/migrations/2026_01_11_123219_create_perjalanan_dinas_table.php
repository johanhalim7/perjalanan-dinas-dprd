<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('perjalanan_dinas', function (Blueprint $table) {
            $table->id();

            $table->string('nama_pegawai');
            $table->string('jabatan');
            $table->string('tujuan');

            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang');

            $table->decimal('anggaran', 15, 2);

            $table->string('surat_tugas')->nullable();
            $table->string('laporan_perjalanan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjalanan_dinas');
    }
};
