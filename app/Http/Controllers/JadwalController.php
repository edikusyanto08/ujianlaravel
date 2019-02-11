<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;
use App\Hari;
use App\Pelajaran;
use App\Guru;
use App\Tingkat;
use App\Kelas;
use App\TahunAjaran;
use PDF;
use Excel;

class JadwalController extends Controller
{
    // public function __construct()
    // {
    //   $this->middleware('auth');
    // }

    public function index()
    {
      $jadwal = Jadwal::orderBy('hari_id')->paginate(10);
      return view('semaya.master.jadwal.index', ['data' => $jadwal]);
    }

    public function create()
    {
      $hari = Hari::orderBy('id')->get();
      $pelajaran = Pelajaran::orderBy('pelajaran')->get();
      $guru = Guru::orderBy('nama')->get();
      $tingkat = Tingkat::orderBy('nama_tingkat')->get();
      $kelas = Kelas::orderBy('nama_kelas')->get();
      $tahun = TahunAjaran::whereStatus(1)->orderBy('nama')->get();
      return view('semaya.master.jadwal.create', ['hari' => $hari, 'pelajaran' => $pelajaran, 'guru' => $guru, 'tingkat' => $tingkat, 'kelas' => $kelas, 'tahun' => $tahun]);
    }

    public function store(Request $r)
    {
      $message = [
        'hari.required'  => 'Hari harus diisi!',
        'jam_ke.required'  => 'Jam ke harus diisi!',
        'jam_mulai.required'  => 'Jam mulai harus diisi!',
        'jam_selesai.required'  => 'Jam selesai harus diisi!',
        'guru.required'  => 'Guru harus diisi!',
        'pelajaran.required'  => 'Pelajaran harus diisi!',
        'semester.required'  => 'Semester harus diisi!',
        'kelas.required'  => 'Kelas harus diisi!',
        'tahun_ajaran.required'  => 'Tahun ajaran harus diisi!',
        'jam_ke.numeric'  => 'Jam ke harus berupa angka!',
        'semester.numeric'  => 'Semester harus berupa angka!',
        'jam_ke.digits_between'  => 'Jam ke maksimal 2 digit!',
        'semester.digits_between'  => 'Semester maksimal 2 digit!',
      ];

      $this->validate($r, [
        'hari'  => 'required',
        'jam_ke'  => 'required|digits_between:1,2|numeric',
        'jam_mulai'  => 'required',
        'jam_selesai'  => 'required',
        'guru'  => 'required',
        'pelajaran'  => 'required',
        'semester'  => 'required|digits_between:1,2|numeric',
        'kelas'  => 'required',
        'tahun_ajaran'  => 'required',
      ], $message);

      $jadwal = new Jadwal;
      $jadwal->hari_id = $r->input('hari');
      $jadwal->jam_ke = $r->input('jam_ke');
      $jadwal->jam_mulai = $r->input('jam_mulai');
      $jadwal->jam_selesai = $r->input('jam_selesai');
      $jadwal->guru_id = $r->input('guru');
      $jadwal->pelajaran_id = $r->input('pelajaran');
      $jadwal->semester = $r->input('semester');
      $jadwal->tingkat_id = $r->input('tingkat');
      $jadwal->kelas_id = $r->input('kelas');
      $jadwal->tahun_ajaran_id = $r->input('tahun_ajaran');
      $jadwal->save();
      return redirect()->route('jadwal_index');
    }

    public function edit($id)
    {
      $jadwal = Jadwal::find($id);
      $hari = Hari::orderBy('id')->get();
      $pelajaran = Pelajaran::orderBy('pelajaran')->get();
      $guru = Guru::orderBy('nama')->get();
      $tingkat = Tingkat::orderBy('nama_tingkat')->get();
      $kelas = Kelas::whereTingkatId($jadwal->tingkat_id)->orderBy('nama_kelas')->get();
      $tahun = TahunAjaran::whereStatus(1)->orderBy('nama')->get();
      return view('semaya.master.jadwal.edit', ['data' => $jadwal, 'hari' => $hari, 'pelajaran' => $pelajaran, 'guru' => $guru, 'tingkat' => $tingkat, 'kelas' => $kelas, 'tahun' => $tahun]);
    }

    public function update(Request $r)
    {
      $message = [
        'hari.required'  => 'Hari harus diisi!',
        'jam_ke.required'  => 'Jam ke harus diisi!',
        'jam_mulai.required'  => 'Jam mulai harus diisi!',
        'jam_selesai.required'  => 'Jam selesai harus diisi!',
        'guru.required'  => 'Guru harus diisi!',
        'pelajaran.required'  => 'Pelajaran harus diisi!',
        'semester.required'  => 'Semester harus diisi!',
        'kelas.required'  => 'Kelas harus diisi!',
        'tahun_ajaran.required'  => 'Tahun ajaran harus diisi!',
        'jam_ke.numeric'  => 'Jam ke harus berupa angka!',
        'semester.numeric'  => 'Semester harus berupa angka!',
        'jam_ke.digits_between'  => 'Jam ke maksimal 2 digit!',
        'semester.digits_between'  => 'Semester maksimal 2 digit!',
      ];

      $this->validate($r, [
        'hari'  => 'required',
        'jam_ke'  => 'required|digits_between:1,2|numeric',
        'jam_mulai'  => 'required',
        'jam_selesai'  => 'required',
        'guru'  => 'required',
        'pelajaran'  => 'required',
        'semester'  => 'required|digits_between:1,2|numeric',
        'kelas'  => 'required',
        'tahun_ajaran'  => 'required',
      ], $message);

      $id_jadwal = $r->input('id_jadwal');
      $jadwal = Jadwal::find($id_jadwal);
      $jadwal->hari_id = $r->input('hari');
      $jadwal->jam_ke = $r->input('jam_ke');
      $jadwal->jam_mulai = $r->input('jam_mulai');
      $jadwal->jam_selesai = $r->input('jam_selesai');
      $jadwal->guru_id = $r->input('guru');
      $jadwal->pelajaran_id = $r->input('pelajaran');
      $jadwal->semester = $r->input('semester');
      $jadwal->tingkat_id = $r->input('tingkat');
      $jadwal->kelas_id = $r->input('kelas');
      $jadwal->tahun_ajaran_id = $r->input('tahun_ajaran');
      $jadwal->save();
      return redirect()->route('jadwal_index');
    }

    public function delete($id)
    {
      $jadwal = Jadwal::find($id);
      $jadwal->delete();
      return redirect()->route('jadwal_index');
    }

    public function rekap($semester = null, $hari_id = null)
    {
      $hari = Hari::orderBy('id')->get();
      $kelas = Kelas::orderBy('nama_kelas')->get();
      // $jadwal = Jadwal::where('semester', $semester)
      //                 ->where('hari_id', $hari_id)
      //                 ->orderBy('jam_ke')
      //                 ->get();
      // foreach ($jadwal as $key => $value) {
      //   echo $value->kelas->nama_kelas . ' ' .$value->pelajaran->pelajaran . '<br>';
      // }
      // die();
      return view('semaya.master.jadwal.rekap', ['hari' => $hari, 'kelas' => $kelas, 'semester' => $semester, 'hari_id' => $hari_id]);
    }

    public function ekspor($semester, $hari_id, Request $r)
    {
      $format = $r->input('format');
      $hari = Hari::find($hari_id);
      $kelas = Kelas::orderBy('nama_kelas')->get();
      $nama_file = "JADWAL_PELAJARAN_SEMESTER_" . $semester . "_HARI_" . strtoupper($hari->hari) . '_' . str_replace('-', '_', date('d-m-Y'));
      if ($format == "pdf") {
        $pdf = PDF::loadView('semaya.master.jadwal.rekap_pdf', ['kelas' => $kelas, 'semester' => $semester, 'hari_id' => $hari_id, 'title' => $nama_file]);
        return $pdf->setPaper('a4','landscape')->stream($nama_file . '.pdf');
      } elseif ($format == "xls") {
        Excel::create($nama_file, function($excel) use ($kelas, $semester, $hari_id) {
            $excel->sheet('JADWAL PELAJARAN', function($sheet) use ($kelas, $semester, $hari_id) {
                $sheet->loadView('semaya.master.jadwal.rekap_excel', ['kelas' => $kelas, 'semester' => $semester, 'hari_id' => $hari_id]);
            });
        })->export($format);
      }
    }

}
