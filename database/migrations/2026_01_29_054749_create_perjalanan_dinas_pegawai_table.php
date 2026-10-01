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
    Schema::create('perjalanan_dinas_pegawai', function (Blueprint $table) {
        $table->id();
        $table->foreignId('perjalanan_dinas_id')
              ->constrained()
              ->onDelete('cascade');

        $table->foreignId('user_id')
              ->constrained()
              ->onDelete('cascade');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjalanan_dinas_pegawai');
    }
};
