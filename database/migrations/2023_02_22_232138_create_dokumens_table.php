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
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 10)->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('kartu_keluarga')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('akte')->nullable();
            $table->string('ktp_ortu')->nullable();
            $table->string('berkas')->nullable();
            $table->string('foto')->nullable();

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
        Schema::dropIfExists('dokumens');
    }
};
