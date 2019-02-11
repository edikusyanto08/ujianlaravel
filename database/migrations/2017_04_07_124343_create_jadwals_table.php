<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hari_id')->unsigned();
            $table->tinyInteger('jam_ke');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('guru_id')->unsigned();
            $table->integer('pelajaran_id')->unsigned();
            $table->tinyInteger('semester');
            $table->integer('tingkat_id')->unsigned();
            $table->integer('kelas_id')->unsigned();
            $table->integer('tahun_ajaran_id')->unsigned();
            $table->foreign('hari_id')->references('id')->on('hari')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pelajaran_id')->references('id')->on('pelajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tingkat_id')->references('id')->on('tingkat')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('jadwal');
    }
}
