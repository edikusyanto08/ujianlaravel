<?php

use Illuminate\Database\Seeder;
use App\Hari;

class HariTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hari::create(['hari'=>'Senin']);
        Hari::create(['hari'=>'Selasa']);
        Hari::create(['hari'=>'Rabu']);
        Hari::create(['hari'=>'Kamis']);
        Hari::create(['hari'=>"Jum'at"]);
        Hari::create(['hari'=>"Sabtu"]);
        Hari::create(['hari'=>"Minggu"]);
    }
}
