<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaSekolahAsalTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_sekolah_asal', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nama_sekolah')->nullable();
          $table->text('alamat_sekolah')->nullable();
          $table->string('tahun_sttb')->nullable(); //Tahun Surat Tanda Tamat Belajar
          $table->string('nomor_sttb')->nullable(); //Nomor Tanda Tamat Belajar

          $table->integer('tingkat_id_diterima')->unsigned()->nullable();
          $table->foreign('tingkat_id_diterima')
                ->references('id')
                ->on('tingkat');
                ->onDelete('cascade');
                ->onUpdate('cascade');
          $table->integer('kelas_id_diterima')->unsigned()->nullable();
          $table->foreign('kelas_id_diterima')
                ->references('id')
                ->on('kelas');
                ->onDelete('cascade');
                ->onUpdate('cascade');
          $table->date('tanggal_diterima_sekolah')->nullable();

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
        Schema::dropIfExists('siswa_sekolah_asal');
    }
}
