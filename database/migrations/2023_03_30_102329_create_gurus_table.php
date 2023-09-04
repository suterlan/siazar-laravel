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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->nullable();
            $table->string('nama');
            $table->string('nuptk', 16)->nullable();
            $table->string('nip', 18)->nullable();
            $table->char('jk', 1)->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('tempat_lahir', 64)->nullable();
            $table->dateTime('tanggal_lahir')->nullable();
            $table->string('agama', 32)->nullable();
            $table->string('no_hp', 13)->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('alamat')->nullable();
            $table->string('provinsi', 64)->nullable();
            $table->string('kabupaten', 64)->nullable();
            $table->string('kecamatan', 64)->nullable();
            $table->string('kelurahan', 64)->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('sk_cpns')->nullable();
            $table->timestamp('tanggal_cpns')->nullable();
            $table->timestamp('tmt_pns')->nullable();
            $table->string('pangkat_golongan')->nullable();
            $table->string('sk_pengangkatan')->nullable();
            $table->timestamp('tmt_pengangkatan')->nullable();
            $table->string('lembaga_pengangkatan')->nullable();
            $table->string('npwp', 16)->nullable();
            $table->string('bank')->nullable();
            $table->string('no_rek')->nullable();
            $table->string('nama_rek')->nullable();
            $table->timestamps();

            // $table->foreign('email')->references('email')->on('users')->onDelete('NO ACTION')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gurus');
    }
};
