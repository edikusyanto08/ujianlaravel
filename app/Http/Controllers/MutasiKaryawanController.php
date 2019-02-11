<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogMutasiKaryawan;
use App\Karyawan;
use App\JenisMutasi;
use App\TahunAjaran;
use App\Http\Controllers\InterfaceHelper as IH;
use Validator;
use PDF;

class MutasiKaryawanController extends Controller
{
    public function __construct()
    {
      $this->interfaceHelper =  new IH;
    }

    public function index()
    {
      $log_mutasi_karyawan = LogMutasiKaryawan::select('log_mutasi_karyawan.id as id', 'karyawan.nama as karyawan_nama', 'tahun_ajaran.nama as tahun_ajaran_nama', 'log_mutasi_karyawan.tanggal as tanggal', 'jenis_mutasi.mutasi as jenis_mutasi_nama')
                                      ->join('karyawan', 'log_mutasi_karyawan.karyawan_id', '=', 'karyawan.id')
                                      ->join('tahun_ajaran', 'log_mutasi_karyawan.tahun_ajaran_id', '=', 'tahun_ajaran.id')
                                      ->join('jenis_mutasi', 'log_mutasi_karyawan.jenis_mutasi_id', '=', 'jenis_mutasi.id')
                                      ->orderBy('log_mutasi_karyawan.id', 'desc')
                                      ->paginate(10);
      $no = $log_mutasi_karyawan->firstItem();
      return view('semaya.mutasi_karyawan.index', ['log_mutasi_karyawan'=>$log_mutasi_karyawan, 'no'=>$no]);
    }

    public function create()
    {
      $karyawan = Karyawan::where('status', 1)->get();
      $jenis_mutasi = JenisMutasi::where('tipe', 3)->get();
      $tahun_ajaran = TahunAjaran::all();
      return view('semaya.mutasi_karyawan.create', ['karyawan'=>$karyawan, 'jenis_mutasi'=>$jenis_mutasi, 'tahun_ajaran'=>$tahun_ajaran]);
    }

    public function store(Request $r)
    {
      $karyawan_id = $r->input('karyawan_id');
      $jenis_mutasi_id = $r->input('jenis_mutasi_id');
      $tahun_ajaran_id = $r->input('tahun_ajaran_id');
      $tanggal = $r->input('tanggal');
      $alasan = $r->input('alasan');
      $mutasi_ke = $r->input('mutasi_ke');

      $validator = Validator::make($r->all(), [
        'karyawan_id'=>'required',
        'jenis_mutasi_id'=>'required',
        'tahun_ajaran_id'=>'required',
        'tanggal'=>'required',
        'alasan'=>'required',
        'mutasi_ke'=>'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('mutasi_karyawan_create')->withErrors($validator)->withInput();
      }

      $interface_helper = $this->interfaceHelper;

      $mutasi_karyawan = new LogMutasiKaryawan;
      $mutasi_karyawan->karyawan_id = $karyawan_id;
      $mutasi_karyawan->tahun_ajaran_id = $tahun_ajaran_id;
      $mutasi_karyawan->jenis_mutasi_id = $jenis_mutasi_id;
      $mutasi_karyawan->tanggal = $interface_helper->date('d/m/Y', $tanggal);
      $mutasi_karyawan->alasan = $alasan;
      $mutasi_karyawan->mutasi_ke = $mutasi_ke;
      $mutasi_karyawan->save();

      $karyawan = Karyawan::find($karyawan_id);
      $karyawan->status = 0;
      $karyawan->tgl_non_aktif = $interface_helper->date('d/m/Y', $tanggal);
      $karyawan->save();

      return redirect()->route('mutasi_karyawan_index')->with('message', 'Mutasi karyawan berhasil disimpan.');
    }

    public function edit($id)
    {
      $mutasi_karyawan = LogMutasiKaryawan::findOrFail($id);
      $karyawan = Karyawan::all();
      $jenis_mutasi = JenisMutasi::where('tipe', 3)->get();
      $tahun_ajaran = TahunAjaran::all();
      return view('semaya.mutasi_karyawan.edit', ['mutasi_karyawan'=>$mutasi_karyawan, 'karyawan'=>$karyawan, 'jenis_mutasi'=>$jenis_mutasi, 'tahun_ajaran'=>$tahun_ajaran]);
    }

    public function update(Request $r)
    {
      $id = $r->input('id');
      $karyawan_id = $r->input('karyawan_id');
      $jenis_mutasi_id = $r->input('jenis_mutasi_id');
      $tahun_ajaran_id = $r->input('tahun_ajaran_id');
      $tanggal = $r->input('tanggal');
      $alasan = $r->input('alasan');
      $mutasi_ke = $r->input('mutasi_ke');

      // dd($karyawan_id);

      $validator = Validator::make($r->all(), [
        'id'=>'required',
        'karyawan_id'=>'required',
        'jenis_mutasi_id'=>'required',
        'tahun_ajaran_id'=>'required',
        'tanggal'=>'required',
        'alasan'=>'required',
        'mutasi_ke'=>'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('mutasi_karyawan_edit', ['id'=>$id])->withErrors($validator)->withInput();
      }

      $interface_helper = $this->interfaceHelper;

      $mutasi_karyawan = LogMutasiKaryawan::find($id);
      $mutasi_karyawan->jenis_mutasi_id = $jenis_mutasi_id;
      $mutasi_karyawan->tahun_ajaran_id = $tahun_ajaran_id;
      $mutasi_karyawan->tanggal = $interface_helper->date('d/m/Y', $tanggal);
      $mutasi_karyawan->alasan = $alasan;
      $mutasi_karyawan->mutasi_ke = $mutasi_ke;
      $mutasi_karyawan->save();

      $karyawan = Karyawan::find($karyawan_id);
      $karyawan->tgl_non_aktif = $interface_helper->date('d/m/Y', $tanggal);
      $karyawan->save();

      return redirect()->route('mutasi_karyawan_index')->with('message', 'Mutasi karyawan berhasil diubah.');
    }

    public function destroy($id)
    {
      $mutasi_karyawan = LogMutasiKaryawan::findOrFail($id);

      $karyawan = Karyawan::find($mutasi_karyawan->karyawan_id);
      $karyawan->status = 1;
      $karyawan->tgl_non_aktif = null;
      $karyawan->save();

      $mutasi_karyawan->delete();

      return redirect()->route('mutasi_karyawan_index')->with('message', 'Mutasi karyawan berhasil dihapus.');
    }

    public function exportToPdf()
    {
      $log_mutasi_karyawan = LogMutasiKaryawan::select('log_mutasi_karyawan.id as id', 'karyawan.nama as karyawan_nama', 'tahun_ajaran.nama as tahun_ajaran_nama', 'log_mutasi_karyawan.tanggal as tanggal', 'jenis_mutasi.mutasi as jenis_mutasi_nama')
                                      ->join('karyawan', 'log_mutasi_karyawan.karyawan_id', '=', 'karyawan.id')
                                      ->join('tahun_ajaran', 'log_mutasi_karyawan.tahun_ajaran_id', '=', 'tahun_ajaran.id')
                                      ->join('jenis_mutasi', 'log_mutasi_karyawan.jenis_mutasi_id', '=', 'jenis_mutasi.id')
                                      ->orderBy('log_mutasi_karyawan.id', 'desc')
                                      ->get();
      $no = 1;
      $nama_file = "LAPORAN_MUTASI_KARYAWAN_" . str_replace('-', '_', date('d-m-Y'));

      $pdf = PDF::loadView('semaya.mutasi_karyawan.rekap_pdf', ['log_mutasi_karyawan'=>$log_mutasi_karyawan, 'no'=>$no]);
      return $pdf->setPaper('a4','landscape')->stream($nama_file . '.pdf');
    }
}
