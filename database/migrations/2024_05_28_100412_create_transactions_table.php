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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 255)->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pembayaran_id');
            $table->unsignedBigInteger('siswa_id');
            $table->string('iuran', 255);
            $table->decimal('nominal', 10, 2);
            $table->string('nama_siswa', 100);
            $table->string('status')->default('pending');
            $table->string('snap_token')->nullable();
            $table->timestamps();

            $table->foreign('pembayaran_id')->references('id')->on('pembayarans')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
