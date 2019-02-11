<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\InterfaceHelper as IH;
use App\LogMutasiGuru;
use App\Guru;
use App\TahunAjaran;
use App\JenisMutasi;
use Validator;
use PDF;

class MutasiGuruController extends Controller
{
    public function __construct()
    {
      $this->interfaceHelper = new IH;
    }

    public function index()
    {
      $log_mutasi_guru = LogMutasiGuru::select('log_mutasi_guru.id as id', 'guru.nama as guru_nama', 'tahun_ajaran.nama as tahun_ajaran_nama', 'log_mutasi_guru.tanggal as tanggal', 'jenis_mutasi.mutasi as jenis_mutasi_nama')
                                      ->join('guru', 'log_mutasi_guru.guru_id', '=', 'guru.id')
                                      ->join('tahun_ajaran', 'log_mutasi_guru.tahun_ajaran_id', '=', 'tahun_ajaran.id')
                                      ->join('jenis_mutasi', 'log_mutasi_guru.jenis_mutasi_id', '=', 'jenis_mutasi.id')
                                      ->orderBy('log_mutasi_guru.id', 'desc')
                                      ->paginate(10);
      $no = $log_mutasi_guru->firstItem();
      return view('semaya.mutasi_guru.index', ['log_mutasi_guru'=>$log_mutasi_guru, 'no'=>$no]);
    }

    public function create()
    {
      $guru = Guru::where('status', 1)->get();
      $jenis_mutasi = JenisMutasi::where('tipe', 2)->get();
      $tahun_ajaran = TahunAjaran::all();
      return view('semaya.mutasi_guru.create', ['guru'=>$guru, 'jenis_mutasi'=>$jenis_mutasi, 'tahun_ajaran'=>$tahun_ajaran]);
    }

    public function store(Request $r)
    {
      $guru_id = $r->input('guru_id');
      $jenis_mutasi_id = $r->input('jenis_mutasi_id');
      $tahun_ajaran_id = $r->input('tahun_ajaran_id');
      $tanggal = $r->input('tanggal');
      $alasan = $r->input('alasan');
      $mutasi_ke = $r->input('mutasi_ke');

      $validator = Validator::make($r->all(), [
        'guru_id'=>'required',
        'jenis_mutasi_id'=>'required',
        'tahun_ajaran_id'=>'required',
        'tanggal'=>'required',
        'alasan'=>'required',
        'mutasi_ke'=>'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('mutasi_guru_create')->withErrors($validator)->withInput();
      }

      $interface_helper = $this->interfaceHelper;

      $mutasi_guru = new LogMutasiGuru;
      $mutasi_guru->guru_id = $guru_id;
      $mutasi_guru->tahun_ajaran_id = $tahun_ajaran_id;
      $mutasi_guru->jenis_mutasi_id = $jenis_mutasi_id;
      $mutasi_guru->tanggal = $interface_helper->date('d/m/Y', $tanggal);
      $mutasi_guru->alasan = $alasan;
      $mutasi_guru->mutasi_ke = $mutasi_ke;
      $mutasi_guru->save();

      $guru = Guru::find($guru_id);
      $guru->status = 0;
      $guru->tgl_non_aktif = $interface_helper->date('d/m/Y', $tanggal);
      $guru->save();

      return redirect()->route('mutasi_guru_index')->with('message', 'Mutasi guru berhasil disimpan.');
    }

    public function edit($id)
    {
      $mutasi_guru = LogMutasiGuru::findOrFail($id);
      $guru = Guru::all();
      $jenis_mutasi = JenisMutasi::where('tipe', 2)->get();
      $tahun_ajaran = TahunAjaran::all();
      return view('semaya.mutasi_guru.edit', ['mutasi_guru'=>$mutasi_guru, 'guru'=>$guru, 'jenis_mutasi'=>$jenis_mutasi, 'tahun_ajaran'=>$tahun_ajaran]);
    }

    public function update(Request $r)
    {
      $id = $r->input('id');
      $guru_id = $r->input('guru_id');
      $jenis_mutasi_id = $r->input('jenis_mutasi_id');
      $tahun_ajaran_id = $r->input('tahun_ajaran_id');
      $tanggal = $r->input('tanggal');
      $alasan = $r->input('alasan');
      $mutasi_ke = $r->input('mutasi_ke');

      $validator = Validator::make($r->all(), [
        'id'=>'required',
        'guru_id'=>'required',
        'jenis_mutasi_id'=>'required',
        'tahun_ajaran_id'=>'required',
        'tanggal'=>'required',
        'alasan'=>'required',
        'mutasi_ke'=>'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('mutasi_guru_edit', ['id'=>$id])->withErrors($validator)->withInput();
      }

      $interface_helper = $this->interfaceHelper;

      $mutasi_guru = LogMutasiGuru::find($id);
      $mutasi_guru->jenis_mutasi_id = $jenis_mutasi_id;
      $mutasi_guru->tahun_ajaran_id = $tahun_ajaran_id;
      $mutasi_guru->tanggal = $interface_helper->date('d/m/Y', $tanggal);
      $mutasi_guru->alasan = $alasan;
      $mutasi_guru->mutasi_ke = $mutasi_ke;
      $mutasi_guru->save();

      $guru = Guru::find($guru_id);
      $guru->tgl_non_aktif = $interface_helper->date('d/m/Y', $tanggal);
      $guru->save();

      return redirect()->route('mutasi_guru_index')->with('message', 'Mutasi guru berhasil diubah.');
    }

    public function destroy($id)
    {
      $mutasi_guru = LogMutasiGuru::find($id);

      $guru = Guru::find($mutasi_guru->guru_id);
      $guru->status = 1;
      $guru->tgl_non_aktif = null;
      $guru->save();

      $mutasi_guru->delete();

      return redirect()->route('mutasi_guru_index')->with('message', 'Mutasi guru berhasil dihapus.');
    }

    public function exportToPdf()
    {
      $log_mutasi_guru = LogMutasiGuru::select('log_mutasi_guru.id as id', 'guru.nama as guru_nama', 'tahun_ajaran.nama as tahun_ajaran_nama', 'log_mutasi_guru.tanggal as tanggal', 'jenis_mutasi.mutasi as jenis_mutasi_nama')
                                      ->join('guru', 'log_mutasi_guru.guru_id', '=', 'guru.id')
                                      ->join('tahun_ajaran', 'log_mutasi_guru.tahun_ajaran_id', '=', 'tahun_ajaran.id')
                                      ->join('jenis_mutasi', 'log_mutasi_guru.jenis_mutasi_id', '=', 'jenis_mutasi.id')
                                      ->orderBy('log_mutasi_guru.id', 'desc')
                                      ->get();
      $no = 1;
      $nama_file = "LAPORAN_MUTASI_GURU_" . str_replace('-', '_', date('d-m-Y'));

      $pdf = PDF::loadView('semaya.mutasi_guru.rekap_pdf', ['log_mutasi_guru'=>$log_mutasi_guru, 'no'=>$no]);
      return $pdf->setPaper('a4','landscape')->stream($nama_file . '.pdf');
    }
}
