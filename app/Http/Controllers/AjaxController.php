<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Provinsi;
use App\Kota;
use App\Kecamatan;
use App\Kelurahan;
use App\KelasSiswa;

class AjaxController extends Controller
{
    // public function __construct()
    // {
    //   $this->middleware('auth');
    // }

    public function getKelas($id_jurusan)
    {
      $kelas = Kelas::whereJurusanId($id_jurusan)->orderBy('nama_kelas')->get();
      return $kelas;
    }

    public function getKelasTingkat($id_tingkat)
    {
      $kelas = Kelas::whereTingkatId($id_tingkat)->orderBy('nama_kelas')->get();
      return $kelas;
    }

    public function getKota($id_prov)
    {
      $kota = Kota::whereProvinsiId($id_prov)->get();
      return $kota;
    }

    public function getKec($id_kota)
    {
      $kecamatan = Kecamatan::whereKotaId($id_kota)->get();
      return $kecamatan;
    }

    public function getKel($id_kec)
    {
      $kelurahan = Kelurahan::whereKecamatanId($id_kec)->get();
      return $kelurahan;
    }

    public function getSiswa($id_kel)
    {
      $response = [];
      $response['success'] = 1;
      $response['siswa'] = KelasSiswa::
                            select('siswa.id as siswa_id', 'kelas_siswa.kelas_id as kelas_id', 'siswa.nama_lengkap as nama', 'kelas.nama_kelas as kelas', 'siswa.nis as nis')
                            ->join('siswa','siswa.id','=','kelas_siswa.siswa_id')
                            ->join('kelas','kelas.id','=','kelas_siswa.kelas_id')
                            ->where('kelas_id', $id_kel)
                            ->where('lulus', 0)
                            ->get();

      $current_kelas = Kelas::find($id_kel);

      $kelas = Kelas::where('tingkat_id', '>', $current_kelas->tingkat_id)->where('jurusan_id', $current_kelas->jurusan_id)->get();

      if (count($kelas) > 0) {
        $response['kelas'] = $kelas;
      }
      else {
        $response['kelas'] = [
          'id' => 'lulus',
          'nama_kelas' => 'LULUS'
        ];
      }

      return response()->json($response);
    }

    public function getAllSiswa($kelas_id)
    {
      $response = [];
      $response['success'] = 1;
      $response['siswa'] = KelasSiswa::select('siswa.id as siswa_id','siswa.nama_lengkap as siswa_nama','siswa.status as siswa_status')
                                      ->join('siswa','kelas_siswa.siswa_id','=','siswa.id')
                                      ->where('kelas_id', $kelas_id)
                                      ->where('siswa.status', 1)
                                      ->where('siswa.lulus', 0)
                                      ->get();
      return response()->json($response);
    }
}
