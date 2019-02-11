<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisMutasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_mutasi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mutasi');
            $table->tinyInteger('tipe'); // 1 -> siswa, 2 -> guru, 3 -> karyawan
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
        Schema::dropIfExists('jenis_mutasi');
    }
}
