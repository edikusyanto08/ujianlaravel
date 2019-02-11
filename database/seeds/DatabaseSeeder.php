<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Use this seeds only for development
        $this->call(SamplesTableSeeder::class);
        $this->call(TingkatTableSeeder::class);
        $this->call(JurusanTableSeeder::class);
        $this->call(HariTableSeeder::class);
        $this->call(KelasTableSeeder::class);
    }
}
