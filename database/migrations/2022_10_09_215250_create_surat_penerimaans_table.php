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
        Schema::create('surat_penerimaans', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat', 50)->unique();
            $table->string('nama_siswa');
            $table->string('bin');
            $table->string('nisn', 10);
            $table->string('ttl', 64);
            $table->string('kelas', 64);
            $table->string('asal_sekolah');
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
        Schema::dropIfExists('surat_penerimaans');
    }
};
