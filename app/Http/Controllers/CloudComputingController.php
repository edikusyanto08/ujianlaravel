<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SekolahMaster;
use Validator;
use App\Http\Controllers\InterfaceHelper as IH;

class CloudComputingController extends Controller
{
    public function __construct()
    {
      $this->interfaceHelper = new IH;
    }

    public function index()
    {
      $sekolah_master = SekolahMaster::orderBy('id','desc')->paginate(10);
      $no = $sekolah_master->firstItem();
      return view('semaya.cloud.index', ['sekolah_master'=>$sekolah_master, 'no'=>$no]);
    }

    public function create()
    {
      $modules = [
        ['id'=>2, 'feature'=>'Sistem Absensi Otomatis dan Digital Signage'],
        ['id'=>3, 'feature'=>'Ujian Online'],
        ['id'=>4, 'feature'=>'Perpustakaan'],
      ];

      return view('semaya.cloud.create', ['modules' => $modules]);
    }

    public function store(Request $r)
    {
      $nama = $r->input('nama_sekolah');
      $expired = $r->input('tanggal_expired');

      $validator = Validator::make($r->all(), [
        'nama_sekolah' => 'required|unique:semaya_master.sekolah,nama',
        'tanggal_expired' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('cloud_computing_create')->withErrors($validator)->withInput();
      }

      $interface_helper = $this->interfaceHelper;

      $sekolah_master = new SekolahMaster;
      $sekolah_master->nama = $nama;
      $sekolah_master->database = 'semaya_sas_'.str_slug($nama,'_');
      if (isset($r->input('feature')[2])) {
        $sekolah_master->database2 = 'semaya_absensi_'.str_slug($nama,'_');
      }
      if (isset($r->input('feature')[3])) {
        $sekolah_master->database3 = 'semaya_ujian_online_'.str_slug($nama,'_');
      }
      if (isset($r->input('feature')[4])) {
        $sekolah_master->database4 = 'semaya_perpustakaan_online_'.str_slug($nama,'_');
      }
      $sekolah_master->expired = $interface_helper->date('d/m/Y', $expired);
      $sekolah_master->status = 1;
      $sekolah_master->save();

      return redirect()->route('cloud_computing_index')->with('message', 'Berhasil membuat database untuk '.$nama);
    }

    public function edit($id)
    {
      $sekolah_master = SekolahMaster::findOrFail($id);
      $modules = [
        ['id'=>2, 'feature'=>'Sistem Absensi Otomatis dan Digital Signage'],
        ['id'=>3, 'feature'=>'Ujian Online'],
        ['id'=>4, 'feature'=>'Perpustakaan'],
      ];

      return view('semaya.cloud.edit', ['sekolah_master' => $sekolah_master, 'modules' => $modules]);
    }

    public function update(Request $r)
    {
      $id = $r->input('id');
      // $nama = $r->input('nama_sekolah');
      $expired = $r->input('tanggal_expired');

      $validator = Validator::make($r->all(), [
        'id' => 'required',
        // 'nama_sekolah' => 'required',
        'tanggal_expired' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('cloud_computing_edit', ['id'=>$id])->withErrors($validator)->withInput();
      }

      $interface_helper = $this->interfaceHelper;

      $sekolah_master = SekolahMaster::findOrFail($id);
      $last_letter = $sekolah_master->nama;
      // $sekolah_master->nama = $nama;
      // $sekolah_master->database = 'semaya_sas_'.str_slug($nama,'_');

      if (isset($r->input('feature')[2])) {
        $sekolah_master->database2 = 'semaya_absensi_'.str_slug($last_letter,'_');
      }
      else {
        $sekolah_master->database2 = '';
      }

      if (isset($r->input('feature')[3])) {
        $sekolah_master->database3 = 'semaya_ujian_online_'.str_slug($last_letter,'_');
      }
      else {
        $sekolah_master->database3 = '';
      }

      if (isset($r->input('feature')[4])) {
        $sekolah_master->database4 = 'semaya_perpustakaan_online_'.str_slug($last_letter,'_');
      }
      else {
        $sekolah_master->database4 = '';
      }

      $sekolah_master->expired = $interface_helper->date('d/m/Y', $expired);
      // $sekolah_master->status = 1;
      $sekolah_master->save();

      return redirect()->route('cloud_computing_index')->with('message', 'Semaya Cloud berhasil diubah.');
    }

    public function destroy($id)
    {
      $sekolah_master = SekolahMaster::findOrFail($id);
      $sekolah_master->delete();

      return redirect()->route('cloud_computing_index')->with('message', 'Pengguna Semaya Cloud berhasil dihapus.');
    }

    public function disable($id)
    {
      $sekolah_master = SekolahMaster::findOrFail($id);
      $sekolah_master->status = 0;
      $sekolah_master->save();

      return redirect()->route('cloud_computing_index')->with('message', 'Pengguna Semaya Cloud berhasil dinonaktifkan.');
    }

    public function activate($id)
    {
      $sekolah_master = SekolahMaster::findOrFail($id);
      $sekolah_master->status = 1;
      $sekolah_master->save();

      return redirect()->route('cloud_computing_index')->with('message', 'Pengguna Semaya Cloud berhasil diaktifkan.');
    }
}
