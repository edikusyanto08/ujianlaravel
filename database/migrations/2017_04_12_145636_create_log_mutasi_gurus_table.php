<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogMutasiGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_mutasi_guru', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guru_id')->unsigned();
            $table->integer('tahun_ajaran_id')->unsigned();
            $table->integer('jenis_mutasi_id')->unsigned();
            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jenis_mutasi_id')->references('id')->on('jenis_mutasi')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal');
            $table->text('alasan');
            $table->string('mutasi_ke');
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
        Schema::dropIfExists('log_mutasi_guru');
    }
}
