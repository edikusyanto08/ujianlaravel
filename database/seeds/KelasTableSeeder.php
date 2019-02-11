<?php

use Illuminate\Database\Seeder;
use App\Kelas;

class KelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $kelas = [
        ['nama_kelas' => 'X OTP 1', 'jurusan_id' => '5', 'tingkat_id' => '1'],
        ['nama_kelas' => 'X OTP 2', 'jurusan_id' => '5', 'tingkat_id' => '1'],
        ['nama_kelas' => 'X AKL 1', 'jurusan_id' => '6', 'tingkat_id' => '1'],
        ['nama_kelas' => 'X AKL 2', 'jurusan_id' => '6', 'tingkat_id' => '1'],
        ['nama_kelas' => 'X BDP 1', 'jurusan_id' => '7', 'tingkat_id' => '1'],
        ['nama_kelas' => 'X BDP 2', 'jurusan_id' => '7', 'tingkat_id' => '1'],
        ['nama_kelas' => 'X RPL', 'jurusan_id' => '4', 'tingkat_id' => '1'],
        ['nama_kelas' => 'XI AP 1', 'jurusan_id' => '1', 'tingkat_id' => '2'],
        ['nama_kelas' => 'XI AP 2', 'jurusan_id' => '1', 'tingkat_id' => '2'],
        ['nama_kelas' => 'XI AK 1', 'jurusan_id' => '2', 'tingkat_id' => '2'],
        ['nama_kelas' => 'XI AK 2', 'jurusan_id' => '2', 'tingkat_id' => '2'],
        ['nama_kelas' => 'XI PM 1', 'jurusan_id' => '3', 'tingkat_id' => '2'],
        ['nama_kelas' => 'XI PM 2', 'jurusan_id' => '3', 'tingkat_id' => '2'],
        ['nama_kelas' => 'XI RPL', 'jurusan_id' => '4', 'tingkat_id' => '2'],
        ['nama_kelas' => 'XII AP 1', 'jurusan_id' => '1', 'tingkat_id' => '3'],
        ['nama_kelas' => 'XII AP 2', 'jurusan_id' => '1', 'tingkat_id' => '3'],
        ['nama_kelas' => 'XII AK 1', 'jurusan_id' => '2', 'tingkat_id' => '3'],
        ['nama_kelas' => 'XII AK 2', 'jurusan_id' => '2', 'tingkat_id' => '3'],
        ['nama_kelas' => 'XII PM 1', 'jurusan_id' => '3', 'tingkat_id' => '3'],
        ['nama_kelas' => 'XII PM 2', 'jurusan_id' => '3', 'tingkat_id' => '3'],
        ['nama_kelas' => 'XII RPL', 'jurusan_id' => '4', 'tingkat_id' => '3'],
      ];
      foreach ($kelas as $value) {
        Kelas::create($value);
      }
    }
}
