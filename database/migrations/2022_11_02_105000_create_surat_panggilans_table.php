<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_panggilans', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat', 50)->unique();
            $table->string('nama_siswa');
            $table->string('kelas', 64);
            $table->string('wali_kelas');
            $table->string('hari_tgl', 64);
            $table->string('waktu', 16);
            $table->string('masalah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_panggilans');
    }
};
