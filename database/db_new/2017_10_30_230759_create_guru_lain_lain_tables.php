<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuruLainLainTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('guru_lain_lain', function (Blueprint $table) {
          $table->increments('id');
          $table->date('tmt_pns')->nullable();
          $table->tinyInteger('sudah_lisensi_kepsek')->nullable(); //0 -> tidak, 1 -> ya
          $table->tinyInteger('pernah_diklat_kepengawasan')->nullable(); //0 -> tidak, 1 -> ya
          $table->tinyInteger('keahlian_braille')->nullable(); //0 -> tidak, 1 -> ya
          $table->tinyInteger('keahlian_bahasa_isyarat')->nullable(); //0 -> tidak, 1 -> ya
          $table->integer('guru_id')->unsigned();
          $table->foreign('guru_id')
                ->references('id')
                ->on('guru')
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
      Schema::dropIfExists('guru_lain_lain');
    }
}
