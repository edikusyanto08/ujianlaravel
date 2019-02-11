<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kegiatan;
use App\Tingkat;
use App\TahunAjaran;
use Validator;
use App\Http\Controllers\InterfaceHelper;

class KalenderAkademikController extends Controller
{
  public function index()
  {
    $kalender = Kegiatan::orderBy('tanggal_mulai','asc')->get();
    $kalender_akademik = Kegiatan::orderBy('id','desc')->paginate(10);
    $no = $kalender_akademik->firstItem();
    return view('semaya.kalender_akademik.index', ['kalender_akademik'=>$kalender_akademik, 'kalender'=>$kalender, 'no'=>$no]);
  }

  public function show($id)
  {
    # code...
  }

  public function create()
  {
    $tahun_ajaran = TahunAjaran::orderBy('id','desc')->get();
    $tingkat = Tingkat::orderBy('nama_tingkat')->get();
    return view('semaya.kalender_akademik.create', ['tahun_ajaran' => $tahun_ajaran, 'tingkat' => $tingkat]);
  }

  public function store(Request $r)
  {
    $interface_helper = new InterfaceHelper;

    $nama = $r->input('nama_kegiatan');
    $tahun_ajaran = $r->input('tahun_ajaran_id');
    $tanggal_mulai = $r->input('tanggal_mulai');
    $tanggal_selesai = $r->input('tanggal_selesai');
    $jenis_kegiatan = $r->input('jenis_kegiatan');
    $deskripsi_kegiatan = $r->input('deskripsi_kegiatan');
    $warna_label = $r->input('warna_label');
    $tingkat = $r->input('tingkat');

    $validator = Validator::make($r->all(), [
      'nama_kegiatan'=>'required',
      'tahun_ajaran_id'=>'required',
      'tanggal_mulai'=>'required',
      'tanggal_selesai'=>'required',
      'jenis_kegiatan'=>'required',
      'warna_label'=>'required',
    ]);

    if ($validator->fails()) {
      return redirect()->route('kalender_akademik_create')->with('message', $validator->errors()->all())->withInput();
    }

    $kalender_akademik = new Kegiatan;
    $kalender_akademik->nama_kegiatan = $nama;
    $kalender_akademik->tanggal_mulai = $interface_helper->date('d/m/Y', $tanggal_mulai);
    $kalender_akademik->tanggal_selesai = $interface_helper->date('d/m/Y', $tanggal_selesai);
    $kalender_akademik->tipe = $jenis_kegiatan;
    $kalender_akademik->deskripsi = $deskripsi_kegiatan;
    $kalender_akademik->warna_label = $warna_label;
    $kalender_akademik->tahun_ajaran_id = $tahun_ajaran;
    if ($tingkat != null) {
      $kalender_akademik->tingkat_id = $tingkat;
    } else {
      $kalender_akademik->tingkat_id = 0;
    }
    $kalender_akademik->save();

    return redirect()->route('kalender_akademik_index')->with('message', 'Kalender akademik berhasil disimpan.');
  }

  public function edit($id)
  {
    $data = [];
    $kalender_akademik = Kegiatan::findOrFail($id);
    $tahun_ajaran = TahunAjaran::orderBy('id','desc')->get();
    $tingkat = Tingkat::orderBy('nama_tingkat')->get();
    return view('semaya.kalender_akademik.edit',['kalender_akademik'=>$kalender_akademik, 'tahun_ajaran'=>$tahun_ajaran, 'tingkat' => $tingkat]);
  }

  public function update(Request $r)
  {
    $interface_helper = new InterfaceHelper;

    $id = $r->input('id');
    $nama = $r->input('nama_kegiatan');
    $tahun_ajaran = $r->input('tahun_ajaran_id');
    $tanggal_mulai = $r->input('tanggal_mulai');
    $tanggal_selesai = $r->input('tanggal_selesai');
    $jenis_kegiatan = $r->input('jenis_kegiatan');
    $deskripsi_kegiatan = $r->input('deskripsi_kegiatan');
    $warna_label = $r->input('warna_label');
    $tingkat = $r->input('tingkat');

    $validator = Validator::make($r->all(), [
      'id'=>'required',
      'nama_kegiatan'=>'required',
      'tahun_ajaran_id'=>'required',
      'tanggal_mulai'=>'required',
      'tanggal_selesai'=>'required',
      'jenis_kegiatan'=>'required',
      'warna_label'=>'required',
    ]);

    if ($validator->fails()) {
      return redirect()->route('kalender_akademik_edit', ['id'=>$id])->with('message', $validator->errors()->all())->withInput();
    }

    $kalender_akademik = Kegiatan::find($id);
    $kalender_akademik->nama_kegiatan = $nama;
    $kalender_akademik->tanggal_mulai = $interface_helper->date('d/m/Y', $tanggal_mulai);
    $kalender_akademik->tanggal_selesai = $interface_helper->date('d/m/Y', $tanggal_selesai);
    $kalender_akademik->tipe = $jenis_kegiatan;
    $kalender_akademik->deskripsi = $deskripsi_kegiatan;
    $kalender_akademik->warna_label = $warna_label;
    $kalender_akademik->tahun_ajaran_id = $tahun_ajaran;
    $kalender_akademik->tahun_ajaran_id = $tingkat;
    $kalender_akademik->save();

    return redirect()->route('kalender_akademik_index')->with('message', 'Kalender akademik berhasil diubah.');
  }

  public function destroy($id)
  {
    $kalender_akademik = Kegiatan::findOrFail($id);
    $kalender_akademik->delete();

    return redirect()->route('kalender_akademik_index')->with('message', 'Kalender akademik berhasil dihapus.');
  }
}
