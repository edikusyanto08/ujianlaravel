<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaOrangTua extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('siswa_orang_tua', function (Blueprint $table) {
        $table->increments('id');
        $table->string('nama_ayah')->nullable();
        $table->string('nama_ibu')->nullable();
        $table->text('alamat_orang_tua')->nullable();
        $table->string('telp_orang_tua')->nullable();
        $table->string('pekerjaan_ayah')->nullable();
        $table->string('pekerjaan_ibu')->nullable();

        $table->string('nama_wali')->nullable();
        $table->text('alamat_wali')->nullable();
        $table->string('telp_wali')->nullable();
        $table->string('pekerjaan_wali')->nullable();

        $table->integer('siswa_id')->unsigned();
        $table->foreign('siswa_id')
              ->references('id')
              ->on('siswa');
              ->onDelete('cascade');
              ->onUpdate('cascade');
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
        Schema::dropIfExists('siswa_orang_tua');
    }
}
