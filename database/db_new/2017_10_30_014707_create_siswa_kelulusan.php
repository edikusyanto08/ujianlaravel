<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaKelulusan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('siswa_kelulusan', function (Blueprint $table) {
        $table->increments('id');
        $table->date('tgl_lulus');
        $table->string('nomor_sttb');

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
        Schema::dropIfExists('siswa_kelulusan');
    }
}
