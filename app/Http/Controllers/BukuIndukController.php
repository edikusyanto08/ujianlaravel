<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use PDF;

class BukuIndukController extends Controller
{
    public function index()
    {
      $siswa = Siswa::orderBy('nis')->paginate(12);
      return view('semaya.buku_induk.index', ['data' => $siswa]);
    }

    public function detail($nis)
    {
      $siswa = Siswa::where('nis', $nis)->first();
      return view('semaya.buku_induk.detail', ['data' => $siswa]);
    }

    public function exportToPdf($nis)
    {
      $siswa = Siswa::where('nis', $nis)->first();
      $nama_file = "BUKU_INDUK_" . str_replace(' ', '_', $siswa->nama_lengkap) . '_' . str_replace(' ', '_', $siswa->kelas_siswa->kelas->nama_kelas);
      $pdf = PDF::loadView('semaya.buku_induk.pdf', ['data' => $siswa, 'title' => $nama_file]);
      return $pdf->setPaper('a4','portrait')->stream($nama_file . '.pdf');
    }
}
