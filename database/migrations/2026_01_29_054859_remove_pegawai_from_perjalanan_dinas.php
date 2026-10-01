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
    Schema::table('perjalanan_dinas', function (Blueprint $table) {
        // 1️⃣ HAPUS FOREIGN KEY DULU
        $table->dropForeign('perjalanan_dinas_user_id_foreign');

        // 2️⃣ BARU HAPUS KOLOM
        $table->dropColumn(['user_id', 'nama_pegawai', 'jabatan']);
    });
}

    /**
     * Reverse the migrations.
     */
public function down()
{
    Schema::table('perjalanan_dinas', function (Blueprint $table) {
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('nama_pegawai');
        $table->string('jabatan');
    });
}

};
