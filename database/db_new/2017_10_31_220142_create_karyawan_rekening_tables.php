<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawanRekeningTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan_rekening', function (Blueprint $table) {
            $table->increments('id');
            $table->string('npwp')->nullable();
            $table->string('nama_wajib_pajak')->nullable();
            $table->string('bank')->nullable();
            $table->string('nomor_rekening_bank')->nullable();
            $table->string('rekening_atas_nama')->nullable();
            $table->integer('karyawan_id')->unsigned();
            $table->foreign('karyawan_id')
                  ->references('id')
                  ->on('karyawan')
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
        Schema::dropIfExists('karyawan_rekening');
    }
}
