<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru_mata_pelajaran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pelajaran_id')->unsigned();
            $table->integer('guru_id')->unsigned();
            $table->foreign('pelajaran_id')->references('id')->on('pelajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('guru_mata_pelajaran');
    }
}
