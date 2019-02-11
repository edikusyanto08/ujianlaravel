<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawanPengangkatanTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan_pengangkatan', function (Blueprint $table) {
          $table->increments('id');
          $table->string('sk_cpns')->nullable();
          $table->date('tanggal_cpns')->nullable();
          $table->string('sk_pengangkatan')->nullable();
          $table->date('tmt_pengangkatan')->nullable();
          $table->string('lembaga_pengangkatan')->nullable();
          $table->string('pangkat_pengangkatan')->nullable();
          $table->string('sumber_gaji')->nullable();
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
        Schema::dropIfExists('karyawan_pengangkatan');
    }
}
