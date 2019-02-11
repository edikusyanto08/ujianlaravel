<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuruPengangkatanTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('guru_pengangkatan', function (Blueprint $table) {
          $table->increments('id');
          $table->string('sk_cpns')->nullable();
          $table->date('tanggal_cpns')->nullable();
          $table->string('sk_pengangkatan')->nullable();
          $table->date('tmt_pengangkatan')->nullable();
          $table->string('lembaga_pengangkatan')->nullable();
          $table->string('pangkat_golongan')->nullable();
          $table->string('sumber_gaji')->nullable();
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
      Schema::dropIfExists('guru_pengangkatan');
    }
}
