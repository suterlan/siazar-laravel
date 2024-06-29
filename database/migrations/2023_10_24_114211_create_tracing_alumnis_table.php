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
        Schema::create('tracing_alumnis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained();
            $table->year('angkatan');
            $table->enum('status', ['Kerja', 'Kuliah', 'Menikah', 'Usaha Mandiri'])->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('alamat_perusahaan')->nullable();
            $table->string('gaji')->nullable();
            $table->string('nama_universitas')->nullable();
            $table->string('alamat_universitas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('kategori_usaha')->nullable();
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
        Schema::dropIfExists('tracing_alumnis');
    }
};
