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
        Schema::create('surat_undangans', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat', 50)->unique();
            $table->string('kegiatan');
            $table->timestamp('tanggal_acara')->nullable();
            $table->time('waktu');
            $table->string('tempat');
            $table->string('ketua_panitia');
            $table->string('penerima');
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
        Schema::dropIfExists('surat_undangans');
    }
};
