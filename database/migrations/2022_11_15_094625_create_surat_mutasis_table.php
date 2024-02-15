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
        Schema::create('surat_mutasis', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat', 50)->unique();
            $table->string('nama_siswa');
            $table->string('ttl', 64);
            $table->string('nisn', 10);
            $table->string('jk', 16);
            $table->string('tahun_pelajaran', 10);
            $table->string('kelas', 100);
            $table->string('nama_ayah');
            $table->string('ttl_ayah', 64);
            $table->string('pekerjaan', 128);
            $table->string('nama_ibu');
            $table->string('ttl_ibu', 64);
            $table->string('alamat');
            $table->string('alasan_pindah');
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
        Schema::dropIfExists('surat_mutasis');
    }
};
