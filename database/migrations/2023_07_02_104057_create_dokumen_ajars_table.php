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
        Schema::create('dokumen_ajars', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 32)->unique();
            $table->string('cp')->nullable();
            $table->string('atp')->nullable();
            $table->string('ma')->nullable();
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
        Schema::dropIfExists('dokumen_ajars');
    }
};
