<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawanKeluargaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan_keluarga', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nama_ibu')->nullable();
          $table->string('status_perkawinan')->nullable();
          $table->tinyInteger('jenis_pasangan_hidup')->nullable(); //1 -> suami, 2 -> istri
          $table->string('nama_pasangan_hidup')->nullable();
          $table->string('nip_pasangan_hidup')->nullable();
          $table->string('pekerjaan_pasangan_hidup')->nullable();
          $table->integer('karyawan_id')->unsigned();
          $table->foreign('karyawan_id')
                ->references('id')
                ->on('karyawan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan_keluarga');
    }
}
