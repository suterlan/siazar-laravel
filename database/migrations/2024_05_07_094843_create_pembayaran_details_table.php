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
        Schema::create('pembayaran_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembayaran_id');
            $table->unsignedBigInteger('siswa_id');
            $table->decimal('nominal', 10, 2);
            $table->timestamps();

            $table->foreign('pembayaran_id')->references('id')->on('pembayarans')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran_details');
    }
};
