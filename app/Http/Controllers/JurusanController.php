<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurusan;
use PDF;
use Excel;

class JurusanController extends Controller
{
    public function index()
    {
      $q = '';
      $jurusan = Jurusan::orderBy('singkatan_jurusan')->paginate(10);
      return view('semaya.master.jurusan.index', ['q' => $q, 'data' => $jurusan]);
    }

    public function create()
    {
      return view('semaya.master.jurusan.create');
    }

    public function store(Request $r)
    {
      $message = [
        'nama.required'  => 'Nama jurusan harus diisi!',
        'kode.required'  => 'Kode jurusan harus diisi!',
        'paket.required'  => 'Paket keahlian harus diisi!'
      ];

      $this->validate($r, [
        'nama'  => 'required',
        'kode'  => 'required',
        'paket'  => 'required',
      ], $message);

      $jurusan = new Jurusan;
      $jurusan->singkatan_jurusan = $r->input('nama');
      $jurusan->kode_jurusan = $r->input('kode');
      $jurusan->paket_jurusan = $r->input('paket');
      $jurusan->save();
      return redirect()->route('jurusan_index');
    }

    public function edit($id)
    {
      $jurusan = Jurusan::find($id);
      return view('semaya.master.jurusan.edit', ['data' => $jurusan]);
    }

    public function update(Request $r)
    {
      $message = [
        'nama.required'  => 'Nama jurusan harus diisi!',
        'kode.required'  => 'Kode jurusan harus diisi!',
        'paket.required'  => 'Paket keahlian harus diisi!'
      ];

      $this->validate($r, [
        'nama'  => 'required',
        'kode'  => 'required',
        'paket'  => 'required',
      ], $message);

      $id_jurusan = $r->input('id_jurusan');
      $jurusan = Jurusan::find($id_jurusan);
      $jurusan->singkatan_jurusan = $r->input('nama');
      $jurusan->kode_jurusan = $r->input('kode');
      $jurusan->paket_jurusan = $r->input('paket');
      $jurusan->save();
      return redirect()->route('jurusan_index');
    }

    public function delete($id)
    {
      $jurusan = Jurusan::find($id);
      $jurusan->delete();
      return redirect()->route('jurusan_index');
    }

    public function rekap()
    {
      $jurusan = Jurusan::orderBy('singkatan_jurusan')->get();
      return view('semaya.master.jurusan.rekap', ['data' => $jurusan]);
    }

    public function rekap_ekspor(Request $r)
    {
      $format = $r->input('format');
      $jurusan = Jurusan::orderBy('singkatan_jurusan')->get();
      $nama_file = "LAPORAN_REKAPITULASI_JURUSAN_" . str_replace('-', '_', date('d-m-Y'));

      if ($format == "pdf") {
        $pdf = PDF::loadView('semaya.master.jurusan.rekap_pdf', ['data' => $jurusan, 'title' => $nama_file]);
        return $pdf->setPaper('a4','landscape')->stream($nama_file . '.pdf');
      } elseif ($format == "xls") {
        Excel::create($nama_file, function($excel) use ($jurusan) {
            $excel->sheet('JURUSAN', function($sheet) use ($jurusan) {
                $sheet->loadView('semaya.master.jurusan.rekap_excel', ['data' => $jurusan]);
            });
        })->export($format);
      }
    }
}
