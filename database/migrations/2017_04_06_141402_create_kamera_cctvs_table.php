<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKameraCctvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamera_cctv', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_tempat');
            $table->string('ip');
            $table->string('username');
            $table->string('password')->nullable();
            $table->string('channel');
            $table->text('link_kamera');
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
        Schema::dropIfExists('kamera_cctv');
    }
}
