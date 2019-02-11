<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuruKeluargaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('guru_keluarga', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nama_ibu')->nullable();
          $table->string('status_kawin')->nullable();
          $table->tinyInteger('jenis_pasangan_hidup')->nullable(); //1 -> suami, 2 -> istri
          $table->string('nama_pasangan_hidup')->nullable();
          $table->string('nip_pasangan_hidup')->nullable();
          $table->string('pekerjaan_pasangan_hidup')->nullable();
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
      Schema::dropIfExists('guru_keluarga');
    }
}
