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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 11)->unique();
            $table->string('nisn', 10)->unique()->nullable();
            $table->unsignedBigInteger('jurusan_id')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->string('nama_siswa');
            $table->string('jk', 16);
            $table->string('tempat_lahir', 64)->nullable();
            $table->timestamp('tgl_lahir')->nullable();
            $table->string('no_hp', 13)->nullable();
            $table->string('tahun_ajaran', 9)->nullable();
            $table->string('nik', 16);
            $table->string('alamat')->nullable();
            $table->string('provinsi', 64)->nullable();
            $table->string('kabupaten', 64)->nullable();
            $table->string('kecamatan', 64)->nullable();
            $table->string('kelurahan', 64)->nullable();
            $table->string('asal_sekolah', 64);
            $table->string('no_ijazah', 16)->nullable();
            $table->string('no_skhun', 7)->nullable();
            $table->string('no_kip', 7)->nullable();
            $table->string('nama_kip')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nik_ayah', 16)->nullable();
            $table->timestamp('tgl_lahir_ayah')->nullable();
            $table->string('pendidikan_ayah', 32)->nullable();
            $table->string('pekerjaan_ayah', 64)->nullable();
            $table->integer('penghasilan_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nik_ibu', 16)->nullable();
            $table->timestamp('tgl_lahir_ibu')->nullable();
            $table->string('pendidikan_ibu', 32)->nullable();
            $table->string('pekerjaan_ibu', 64)->nullable();
            $table->integer('penghasilan_ibu')->nullable();
            $table->string('jml_saudara_kandung', 1)->nullable();
            $table->boolean('status_siswa')->default(true);
            $table->boolean('lulus')->default(false);
            $table->timestamps();

            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onDelete('SET NULL');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
};
