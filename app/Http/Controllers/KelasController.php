<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurusan;
use App\Tingkat;
use App\Kelas;
use App\WaliKelas;
use App\Guru;
use Validator;
use Excel;
use PDF;

class KelasController extends Controller
{
    // public function __construct()
    // {
    //   $this->middleware('auth');
    // }

    public function index()
    {
      $q = '';
      $kelas = Kelas::orderBy('nama_kelas')->paginate(10);
      return view('semaya.master.kelas.index', ['q' => $q, 'data' => $kelas]);
    }

    public function create()
    {
      $jurusan = Jurusan::orderBy('singkatan_jurusan')->get();
      $tingkat = Tingkat::orderBy('nama_tingkat')->get();
      $guru = Guru::orderBy('nama')->get();
      return view('semaya.master.kelas.create', ['jurusan' => $jurusan, 'tingkat' => $tingkat, 'guru' => $guru]);
    }

    public function store(Request $r)
    {
      $message = [
        'nama.required'  => 'Nama kelas harus diisi!',
        'jurusan.required'  => 'Jurusan kelas harus diisi!',
        'tingkat.required'  => 'Tingkat kelas harus diisi!',
      ];

      $this->validate($r, [
        'nama'  => 'required',
        'jurusan'  => 'required',
        'tingkat'  => 'required',
      ], $message);

      $guru_id = $r->input('wali_kelas');
      $kelas = new Kelas;
      $kelas->nama_kelas = $r->input('nama');
      $kelas->jurusan_id = $r->input('jurusan');
      $kelas->tingkat_id = $r->input('tingkat');
      $kelas->save();
      if ($guru_id) {
        $wali_kelas = new WaliKelas;
        $wali_kelas->guru_id = $guru_id;
        $wali_kelas->kelas_id = $kelas->id;
        $wali_kelas->save();
      }
      return redirect()->route('kelas_index');
    }

    public function edit($id)
    {
      $kelas = Kelas::find($id);
      $jurusan = Jurusan::orderBy('singkatan_jurusan')->get();
      $tingkat = Tingkat::orderBy('nama_tingkat')->get();
      $guru = Guru::whereStatus(1)->orderBy('nama')->get();
      return view('semaya.master.kelas.edit', ['data' => $kelas, 'jurusan' => $jurusan, 'tingkat' => $tingkat, 'guru' => $guru]);
    }

    public function update(Request $r)
    {
      $message = [
        'nama.required'  => 'Nama kelas harus diisi!',
        'jurusan.required'  => 'Jurusan kelas harus diisi!',
        'tingkat.required'  => 'Tingkat kelas harus diisi!',
      ];

      $this->validate($r, [
        'nama'  => 'required',
        'jurusan'  => 'required',
        'tingkat'  => 'required',
      ], $message);

      $guru_id = $r->input('wali_kelas');
      $kelas_id = $r->input('id_kelas');
      $kelas = Kelas::find($kelas_id);
      $kelas->nama_kelas = $r->input('nama');
      $kelas->jurusan_id = $r->input('jurusan');
      $kelas->tingkat_id = $r->input('tingkat');
      $kelas->save();
      if ($guru_id) {
        $wali_kelas = WaliKelas::where('kelas_id', $kelas_id)->first();
        if ($wali_kelas) {
          $wali_kelas->guru_id = $guru_id;
          $wali_kelas->kelas_id = $kelas->id;
          $wali_kelas->save();
        } else {
          $wali_kelas = new WaliKelas;
          $wali_kelas->guru_id = $guru_id;
          $wali_kelas->kelas_id = $kelas->id;
          $wali_kelas->save();
        }
      }
      return redirect()->route('kelas_index');
    }

    public function delete($id)
    {
      $kelas = Kelas::find($id);
      $kelas->delete();
      return redirect()->route('kelas_index');
    }

    public function rekap()
    {
      $tingkat = Tingkat::orderBy('nama_tingkat')->get();
      $total_siswa_l = 0;
      $total_siswa_p = 0;
      $total_siswa = 0;
      return view('semaya.master.kelas.rekap', ['tingkat' => $tingkat, 'total_siswa_l' => $total_siswa_l, 'total_siswa_p' => $total_siswa_p, 'total_siswa' => $total_siswa]);
    }

    public function export(Request $r)
    {
      $format = $r->input('format');

      $validator = Validator::make($r->all(), [
        'format' => 'required'
      ]);

      if ($validator->fails()) {
        return redirect()->route('kelas_rekap')->withErrors($validator)->withInput();
      }

      $tingkat = Tingkat::orderBy('nama_tingkat')->get();
      $total_siswa_l = 0;
      $total_siswa_p = 0;
      $total_siswa = 0;
      $nama_file = "LAPORAN_REKAPITULASI_KELAS_" . str_replace('-', '_', date('d-m-Y'));

      if ($format == 'xls') {
        Excel::create($nama_file, function($excel) use ($tingkat, $total_siswa_l, $total_siswa_p, $total_siswa) {
            $excel->sheet('KELAS', function($sheet) use ($tingkat, $total_siswa_l, $total_siswa_p, $total_siswa) {
                $sheet->loadView('semaya.master.kelas.rekap_excel', ['tingkat' => $tingkat, 'total_siswa_l' => $total_siswa_l, 'total_siswa_p' => $total_siswa_p, 'total_siswa' => $total_siswa]);
            });
        })->export($format);
      }
      elseif ($format == 'pdf') {
        $pdf = PDF::loadView('semaya.master.kelas.rekap_pdf', ['title' => $nama_file, 'tingkat' => $tingkat, 'total_siswa_l' => $total_siswa_l, 'total_siswa_p' => $total_siswa_p, 'total_siswa' => $total_siswa]);
        return $pdf->setPaper('a4','landscape')->stream($nama_file . '.pdf');
      }
    }
}
