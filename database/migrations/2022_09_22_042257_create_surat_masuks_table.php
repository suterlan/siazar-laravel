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
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klasifikasi_id')->nullable();
            $table->string('no_surat', 50)->unique();
            $table->string('asal_surat');
            $table->string('deskripsi');
            $table->timestamp('tanggal_surat')->nullable();
            $table->timestamp('tanggal_diterima')->nullable();
            $table->string('file')->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->timestamps();

            $table->foreign('klasifikasi_id')->references('id')->on('klasifikasis')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_masuks');
    }
};
