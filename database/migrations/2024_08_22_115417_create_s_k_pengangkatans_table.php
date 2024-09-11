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
        Schema::create('s_k_pengangkatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('s_k_b_m_id')->index();
            $table->unsignedBigInteger('guru_id');
            $table->string('no_surat', 50)->unique();
            $table->timestamps();

            $table->foreign('s_k_b_m_id')->references('id')->on('s_k_b_m_s')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_k_pengangkatans');
    }
};
