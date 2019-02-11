<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Guru;
use App\Siswa;
use App\Karyawan;
use App\Absensi;
use App\TahunAjaran;
use App\TabelWaktu;

class AbsensiController extends Controller
{
    public function bulan()
    {
      $bulan = [
        [ 'id' => '01', 'nama' => 'Januari' ],
        [ 'id' => '02', 'nama' => 'Februari' ],
        [ 'id' => '03', 'nama' => 'Maret' ],
        [ 'id' => '04', 'nama' => 'April' ],
        [ 'id' => '05', 'nama' => 'Mei' ],
        [ 'id' => '06', 'nama' => 'Juni' ],
        [ 'id' => '07', 'nama' => 'Juli' ],
        [ 'id' => '08', 'nama' => 'Agustus' ],
        [ 'id' => '09', 'nama' => 'September' ],
        [ 'id' => '10', 'nama' => 'Oktober' ],
        [ 'id' => '11', 'nama' => 'November' ],
        [ 'id' => '12', 'nama' => 'Desember' ],
      ];
      return $bulan;
    }

    public function index_guru(Request $r)
    {
      $tahun = $r->input('y');
      $bulan = $r->input('m');

      if ($tahun == null) {
        $tahun = date('Y');
      }

      if ($bulan == null) {
        $bulan = date('m');
      }

      foreach ($this->bulan() as $value) {
        if ($value['id'] == $bulan) {
          $bulan = $value;
        }
      }

      $dom = date("t", strtotime($tahun . '-' . $bulan['id'] .'-01'));

      $tahun_ajaran = TahunAjaran::where('status', 1)->first();
      if (count($tahun_ajaran) == 0) {
        abort(403);
      }

      $waktu = TabelWaktu::where('tahun_ajaran_id', $tahun_ajaran->id)->where('tipe', 2)->where('status', 1)->first();
      if (count($waktu) == 0) {
        abort(403);
      }

      $guru = Guru::where('nomor_kartu', Auth::user()->username)->first();
      return view('semaya.absensi.guru.index', ['data' => $guru, 'waktu' => $waktu, 'tahun' => $tahun, 'bulan' => $bulan, 'dom' => $dom]);
    }

    public function index_siswa(Request $r)
    {
      $tahun = $r->input('y');
      $bulan = $r->input('m');

      if ($tahun == null) {
        $tahun = date('Y');
      }

      if ($bulan == null) {
        $bulan = date('m');
      }

      foreach ($this->bulan() as $value) {
        if ($value['id'] == $bulan) {
          $bulan = $value;
        }
      }

      $dom = date("t", strtotime($tahun . '-' . $bulan['id'] .'-01'));

      $tahun_ajaran = TahunAjaran::where('status', 1)->first();
      if (count($tahun_ajaran) == 0) {
        abort(403);
      }

      $waktu = TabelWaktu::where('tahun_ajaran_id', $tahun_ajaran->id)->where('tipe', 5)->where('status', 1)->first();
      if (count($waktu) == 0) {
        abort(403);
      }

      $siswa = Siswa::where('nomor_kartu', Auth::user()->username)->first();
      return view('semaya.absensi.siswa.index', ['data' => $siswa, 'waktu' => $waktu, 'tahun' => $tahun, 'bulan' => $bulan, 'dom' => $dom]);
    }

    public function index_karyawan(Request $r)
    {
      $tahun = $r->input('y');
      $bulan = $r->input('m');

      if ($tahun == null) {
        $tahun = date('Y');
      }

      if ($bulan == null) {
        $bulan = date('m');
      }

      foreach ($this->bulan() as $value) {
        if ($value['id'] == $bulan) {
          $bulan = $value;
        }
      }

      $dom = date("t", strtotime($tahun . '-' . $bulan['id'] .'-01'));

      $tahun_ajaran = TahunAjaran::where('status', 1)->first();
      if (count($tahun_ajaran) == 0) {
        abort(403);
      }

      $waktu = TabelWaktu::where('tahun_ajaran_id', $tahun_ajaran->id)->where('tipe', 3)->where('status', 1)->first();
      if (count($waktu) == 0) {
        abort(403);
      }

      $karyawan = Karyawan::where('nomor_kartu', Auth::user()->username)->first();
      return view('semaya.absensi.karyawan.index', ['data' => $karyawan, 'waktu' => $waktu, 'tahun' => $tahun, 'bulan' => $bulan, 'dom' => $dom]);
    }
}
