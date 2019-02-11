<?php

use Illuminate\Database\Seeder;
use App\Jurusan;

class JurusanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $jurusan = [
        ['singkatan_jurusan' => 'Administrasi Perkantoran', 'kode_jurusan' => 'AP', 'paket_jurusan' => 'Bisnis Manajemen'],
        ['singkatan_jurusan' => 'Akuntansi', 'kode_jurusan' => 'AK', 'paket_jurusan' => 'Bisnis Manajemen'],
        ['singkatan_jurusan' => 'Pemasaran', 'kode_jurusan' => 'PM', 'paket_jurusan' => 'Bisnis Manajemen'],
        ['singkatan_jurusan' => 'Rekayasa Perangkat Lunak', 'kode_jurusan' => 'RPL', 'paket_jurusan' => 'Teknologi Informasi dan Komunikasi'],
        ['singkatan_jurusan' => 'Otomatisasi dan Tata Kelola Perkantoran', 'kode_jurusan' => 'OTP', 'paket_jurusan' => 'Bisnis dan Manajemen'],
        ['singkatan_jurusan' => 'Akuntansi dan Keuangan Lembaga', 'kode_jurusan' => 'AKL', 'paket_jurusan' => 'Bisnis dan Manajemen'],
        ['singkatan_jurusan' => 'Bisnis Daring dan Pemasaran', 'kode_jurusan' => 'BDP', 'paket_jurusan' => 'Bisnis dan Manajemen'],
      ];
      foreach ($jurusan as $value) {
        Jurusan::create($value);
      }
    }
}
