<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogMutasiSiswa;
use App\Kelas;
use App\TahunAjaran;
use App\Http\Controllers\InterfaceHelper as IH;
use Validator;
use Carbon;
use App\KelasSiswa;
use App\Siswa;
use App\JenisMutasi;
use PDF;

class MutasiSiswaController extends Controller
{
    public function __construct()
    {
      $this->interfaceHelper = new IH;
    }

    public function index()
    {
      $log_mutasi_siswa = LogMutasiSiswa::select('siswa.nama_lengkap as siswa_nama', 'tahun_ajaran.nama as tahun_ajaran_nama', 'log_mutasi_siswa.id as id', 'log_mutasi_siswa.tanggal as tanggal', 'jenis_mutasi.mutasi as jenis_mutasi_nama')
                                        ->join('siswa','log_mutasi_siswa.siswa_id','=','siswa.id')
                                        ->join('tahun_ajaran','log_mutasi_siswa.tahun_ajaran_id','=','tahun_ajaran.id')
                                        ->join('jenis_mutasi','log_mutasi_siswa.jenis_mutasi_id','=','jenis_mutasi.id')
                                        ->orderBy('log_mutasi_siswa.id','desc')
                                        ->paginate(10);
      $no = $log_mutasi_siswa->firstItem();
      return view('semaya.mutasi_siswa.index', ['log_mutasi_siswa'=>$log_mutasi_siswa, 'no'=>$no]);
    }

    public function create()
    {
      $kelas = Kelas::all();
      $jenis_mutasi = JenisMutasi::where('tipe', 1)->get();
      $tahun_ajaran = TahunAjaran::all();
      return view('semaya.mutasi_siswa.create', ['kelas'=>$kelas, 'jenis_mutasi'=>$jenis_mutasi, 'tahun_ajaran'=>$tahun_ajaran]);
    }

    public function store(Request $r)
    {
      $kelas_id = $r->input('kelas_id');
      $siswa_id = $r->input('siswa_id');
      $jenis_mutasi_id = $r->input('jenis_mutasi_id');
      $tahun_ajaran_id = $r->input('tahun_ajaran_id');
      $tanggal = $r->input('tanggal');
      $alasan = $r->input('alasan');
      $mutasi_ke = $r->input('mutasi_ke');

      $validator = Validator::make($r->all(), [
        'kelas_id'=>'required',
        'jenis_mutasi_id'=>'required',
        'siswa_id'=>'required',
        'tahun_ajaran_id'=>'required',
        'tanggal'=>'required',
        'alasan'=>'required',
        'mutasi_ke'=>'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('mutasi_siswa_create')->withErrors($validator)->withInput();
      }

      $interface_helper = $this->interfaceHelper;

      $mutasi_siswa = new LogMutasiSiswa;
      $mutasi_siswa->siswa_id = $siswa_id;
      $mutasi_siswa->tahun_ajaran_id = $tahun_ajaran_id;
      $mutasi_siswa->jenis_mutasi_id = $jenis_mutasi_id;
      $mutasi_siswa->tanggal = $interface_helper->date('d/m/Y', $tanggal);
      // $mutasi_siswa->tanggal = Carbon::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d');
      $mutasi_siswa->alasan = $alasan;
      $mutasi_siswa->mutasi_ke = $mutasi_ke;
      $mutasi_siswa->save();

      $siswa = Siswa::find($siswa_id);
      $siswa->status = 0;
      $siswa->save();

      return redirect()->route('mutasi_siswa_index')->with('message','Mutasi Siswa berhasil disimpan.');
    }

    public function edit($id)
    {
      $mutasi_siswa = LogMutasiSiswa::findOrFail($id);
      $kelas = Kelas::all();
      $tahun_ajaran = TahunAjaran::all();
      $jenis_mutasi = JenisMutasi::where('tipe', 1)->get();
      // $siswa = Siswa::find($mutasi_siswa->siswa_id);
      $kelas_siswa = KelasSiswa::where('siswa_id', $mutasi_siswa->siswa_id)->first();
      $siswa = KelasSiswa::select('siswa.id as siswa_id','siswa.nama_lengkap as siswa_nama')
                          ->join('siswa','kelas_siswa.siswa_id','=','siswa.id')
                          ->where('kelas_id', $kelas_siswa->kelas_id)
                          ->get();
      return view('semaya.mutasi_siswa.edit', ['mutasi_siswa'=>$mutasi_siswa, 'kelas'=>$kelas, 'tahun_ajaran'=>$tahun_ajaran, 'jenis_mutasi'=>$jenis_mutasi, 'kelas_siswa'=>$kelas_siswa, 'siswa'=>$siswa]);
    }

    public function update(Request $r)
    {
      $id = $r->input('id');
      $kelas_id = $r->input('kelas_id');
      $siswa_id = $r->input('siswa_id');
      $jenis_mutasi_id = $r->input('jenis_mutasi_id');
      $tahun_ajaran_id = $r->input('tahun_ajaran_id');
      $tanggal = $r->input('tanggal');
      $alasan = $r->input('alasan');
      $mutasi_ke = $r->input('mutasi_ke');

      $validator = Validator::make($r->all(), [
        'id'=>'required',
        'jenis_mutasi_id'=>'required',
        // 'kelas_id'=>'required',
        // 'siswa_id'=>'required',
        'tahun_ajaran_id'=>'required',
        'tanggal'=>'required',
        'alasan'=>'required',
        'mutasi_ke'=>'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('mutasi_siswa_edit', ['id'=>$id])->withErrors($validator)->withInput();
      }

      $interface_helper = $this->interfaceHelper;

      $mutasi_siswa = LogMutasiSiswa::find($id);

      // if ($mutasi_siswa->siswa_id != $siswa_id) {
      //   $siswa = Siswa::find($mutasi_siswa->siswa_id);
      //   $siswa->status = 1;
      //   $siswa->save();
      //
      //   $siswa2 = Siswa::find($siswa_id);
      //   $siswa2->status = 0;
      //   $siswa2->save();
      // }
      // else {
      //   $siswa2 = Siswa::find($siswa_id);
      //   $siswa2->status = 0;
      //   $siswa2->save();
      // }

      // $mutasi_siswa->siswa_id = $siswa_id;
      $mutasi_siswa->jenis_mutasi_id = $jenis_mutasi_id;
      $mutasi_siswa->tahun_ajaran_id = $tahun_ajaran_id;
      $mutasi_siswa->tanggal = $interface_helper->date('d/m/Y', $tanggal);
      // $mutasi_siswa->tanggal = Carbon::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d');
      $mutasi_siswa->alasan = $alasan;
      $mutasi_siswa->mutasi_ke = $mutasi_ke;
      $mutasi_siswa->save();

      return redirect()->route('mutasi_siswa_index')->with('message','Mutasi Siswa berhasil diubah.');
    }

    public function destroy($id)
    {
      $mutasi_siswa = LogMutasiSiswa::findOrFail($id);

      $siswa = Siswa::find($mutasi_siswa->siswa_id);
      $siswa->status = 1;
      $siswa->save();

      $mutasi_siswa->delete();

      return redirect()->route('mutasi_siswa_index')->with('message', 'Mutasi siswa berhasil dihapus.');
    }

    public function exportToPdf()
    {
      $log_mutasi_siswa = LogMutasiSiswa::select('siswa.nama_lengkap as siswa_nama', 'tahun_ajaran.nama as tahun_ajaran_nama', 'log_mutasi_siswa.id as id', 'log_mutasi_siswa.tanggal as tanggal', 'jenis_mutasi.mutasi as jenis_mutasi_nama')
                                        ->join('siswa','log_mutasi_siswa.siswa_id','=','siswa.id')
                                        ->join('tahun_ajaran','log_mutasi_siswa.tahun_ajaran_id','=','tahun_ajaran.id')
                                        ->join('jenis_mutasi','log_mutasi_siswa.jenis_mutasi_id','=','jenis_mutasi.id')
                                        ->orderBy('log_mutasi_siswa.id','desc')
                                        ->get();
      $no = 1;
      $nama_file = "LAPORAN_MUTASI_SISWA_" . str_replace('-', '_', date('d-m-Y'));

      $pdf = PDF::loadView('semaya.mutasi_siswa.rekap_pdf', ['log_mutasi_siswa'=>$log_mutasi_siswa, 'no'=>$no]);
      return $pdf->setPaper('a4','landscape')->stream($nama_file . '.pdf');
    }
}
