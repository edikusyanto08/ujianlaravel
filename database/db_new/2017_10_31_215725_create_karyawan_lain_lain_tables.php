<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawanLainLainTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan_lain_lain', function (Blueprint $table) {
          $table->increments('id');
          $table->date('tmt_pns')->nullable();
          $table->tinyInteger('sudah_lisensi_kepsek')->nullable(); //0 -> tidak, 1 -> ya
          $table->tinyInteger('pernah_diklat_kepengawasan')->nullable(); //0 -> tidak, 1 -> ya
          $table->tinyInteger('keahlian_braille')->nullable(); //0 -> tidak, 1 -> ya
          $table->tinyInteger('keahlian_bahasa_isyarat')->nullable(); //0 -> tidak, 1 -> ya
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
        Schema::dropIfExists('karyawan_lain_lain');
    }
}
