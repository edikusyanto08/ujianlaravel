<?php

use Illuminate\Database\Seeder;
use App\Tingkat;

class TingkatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tingkat = [
        ['nama_tingkat' => 'X'],
        ['nama_tingkat' => 'XI'],
        ['nama_tingkat' => 'XII'],
      ];
      foreach ($tingkat as $value) {
        Tingkat::create($value);
      }
    }
}
