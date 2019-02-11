<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use App\Provinsi;
use App\Kota;
use App\Kecamatan;
use App\Kelurahan;
use File;

class SekolahController extends Controller
{
    public function index()
    {
      $sekolah = Sekolah::first();
      $prov = Provinsi::orderBy('nama_provinsi')->get();

      if ($sekolah != null) {
        $kota = Kota::whereProvinsiId($sekolah->provinsi)->orderBy('nama_kota')->get();
        $kecamatan = Kecamatan::whereKotaId($sekolah->kota)->orderBy('nama_kecamatan')->get();
        $kelurahan = Kelurahan::whereKecamatanId($sekolah->kecamatan)->orderBy('nama_kelurahan')->get();
        return view('semaya.master.sekolah.edit', ['data' => $sekolah, 'prov' => $prov, 'kota' => $kota, 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan]);
      }

      return view('semaya.master.sekolah.create', ['prov' => $prov]);
    }

    public function store(Request $r)
    {
      $message = [
        'nama_sekolah.required'  => 'Nama sekolah harus diisi!',
        'alamat.required'  => 'Alamat harus diisi!',
        'npsn.required'  => 'NPSN harus diisi!',
        'npsn.numeric'  => 'NPSN harus berupa angka!',
        'rt.numeric'  => 'RT harus berupa angka!',
        'rw.numeric'  => 'RW harus berupa angka!',
        'kode_pos.numeric'  => 'Kode pos harus berupa angka!',
        'kode_area_telp.numeric'  => 'Kode area harus berupa angka!',
        'no_telp.numeric'  => 'No. Telp harus berupa angka!',
        'no_fax.numeric'  => 'No. Fax harus berupa angka!',
        'email.email'  => 'Format email harus benar!',
        'logo.required' => 'Anda harus memasukkan logo terlebih dahulu!',
        'logo.image' => 'Logo harus berformat gambar!'
      ];

      $this->validate($r, [
        'nama_sekolah'  => 'required',
        'npsn'  => 'required|numeric',
        'alamat'  => 'required',
        'rt'  => 'nullable|numeric',
        'rw'  => 'nullable|numeric',
        'kode_pos'  => 'nullable|numeric',
        'kode_area_telp'  => 'nullable|numeric',
        'no_telp'  => 'nullable|numeric',
        'no_fax'  => 'nullable|numeric',
        'email' => 'nullable|email',
        'logo' => 'required|image',
      ], $message);

      $logo = $r->file('logo');
      $logo_name = '';

      if ($r->hasFile('logo')) {
        if ($logo->isValid()) {
          $logo_name = 'logo_'.round(microtime(true)).'.'.$logo->extension();
          $logo->move('assets/img/sekolah', $logo_name);
        }
      }

      $sekolah = new Sekolah;
      $sekolah->nama_sekolah = $r->input('nama_sekolah');
      $sekolah->npsn = $r->input('npsn');
      $sekolah->alamat = $r->input('alamat');
      $sekolah->rt = $r->input('rt');
      $sekolah->rw = $r->input('rw');
      $sekolah->kelurahan = $r->input('kelurahan');
      $sekolah->kecamatan = $r->input('kecamatan');
      $sekolah->kota = $r->input('kota');
      $sekolah->provinsi = $r->input('provinsi');
      $sekolah->kode_pos = $r->input('kode_pos');
      $sekolah->kode_area_telp = $r->input('kode_area_telp');
      $sekolah->no_telp = $r->input('no_telp');
      $sekolah->no_fax = $r->input('no_fax');
      $sekolah->email = $r->input('email');
      $sekolah->daerah_khusus = $r->input('daerah_khusus');
      $sekolah->sk_daerah_khusus = $r->input('sk_daerah_khusus');
      $sekolah->logo = $logo_name;
      $sekolah->save();

      return redirect()->route('sekolah_index')->with('message', 'Data sekolah berhasil disimpan.');
    }

    public function update(Request $r)
    {
      $message = [
        'nama_sekolah.required'  => 'Nama sekolah harus diisi!',
        'alamat.required'  => 'Alamat harus diisi!',
        'npsn.required'  => 'NPSN harus diisi!',
        'npsn.numeric'  => 'NPSN harus berupa angka!',
        'rt.numeric'  => 'RT harus berupa angka!',
        'rw.numeric'  => 'RW harus berupa angka!',
        'kode_pos.numeric'  => 'Kode pos harus berupa angka!',
        'kode_area_telp.numeric'  => 'Kode area harus berupa angka!',
        'no_telp.numeric'  => 'No. Telp harus berupa angka!',
        'no_fax.numeric'  => 'No. Fax harus berupa angka!',
        'email.email'  => 'Format email harus benar!',
        'logo.image' => 'Logo harus berformat gambar!'
      ];

      $this->validate($r, [
        'nama_sekolah'  => 'required',
        'npsn'  => 'required|numeric',
        'alamat'  => 'required',
        'rt'  => 'nullable|numeric',
        'rw'  => 'nullable|numeric',
        'kode_pos'  => 'nullable|numeric',
        'kode_area_telp'  => 'nullable|numeric',
        'no_telp'  => 'nullable|numeric',
        'no_fax'  => 'nullable|numeric',
        'email' => 'nullable|email',
        'logo' => 'image',
      ], $message);

      $logo = $r->file('logo');
      $logo_name = '';

      if ($logo) {
        if ($r->hasFile('logo')) {
          if ($logo->isValid()) {
            $logo_name = 'logo_'.round(microtime(true)).'.'.$logo->extension();
            $logo->move('assets/img/sekolah', $logo_name);
          }
        }
      }

      $id_sekolah = $r->input('id_sekolah');
      $sekolah = Sekolah::find($id_sekolah);
      $sekolah->nama_sekolah = $r->input('nama_sekolah');
      $sekolah->npsn = $r->input('npsn');
      $sekolah->alamat = $r->input('alamat');
      $sekolah->rt = $r->input('rt');
      $sekolah->rw = $r->input('rw');
      $sekolah->kelurahan = $r->input('kelurahan');
      $sekolah->kecamatan = $r->input('kecamatan');
      $sekolah->kota = $r->input('kota');
      $sekolah->provinsi = $r->input('provinsi');
      $sekolah->kode_pos = $r->input('kode_pos');
      $sekolah->kode_area_telp = $r->input('kode_area_telp');
      $sekolah->no_telp = $r->input('no_telp');
      $sekolah->no_fax = $r->input('no_fax');
      $sekolah->email = $r->input('email');
      $sekolah->daerah_khusus = $r->input('daerah_khusus');
      $sekolah->sk_daerah_khusus = $r->input('sk_daerah_khusus');
      if ($logo) {
        if (File::exists(public_path('assets/img/sekolah/'.$sekolah->logo))) {
          unlink(public_path('assets/img/sekolah/'.$sekolah->logo));
        }
        $sekolah->logo = $logo_name;
      }
      $sekolah->save();

      return redirect()->route('sekolah_index')->with('message', 'Data sekolah berhasil disimpan.');
    }

    // public function index()
    // {
    //   $sekolah = Sekolah::orderBy('nama_sekolah')->paginate(10);
    //   return view('semaya.master.sekolah.index', ['data' => $sekolah]);
    // }

    // public function create()
    // {
    //   $prov = Provinsi::orderBy('nama_provinsi')->get();
    //   return view('semaya.master.sekolah.create', ['prov' => $prov]);
    // }

    // public function edit($id)
    // {
    //   $sekolah = Sekolah::find($id);
    //   $prov = Provinsi::orderBy('nama_provinsi')->get();
    //   $kota = Kota::whereProvinsiId($sekolah->provinsi)->orderBy('nama_kota')->get();
    //   $kecamatan = Kecamatan::whereKotaId($sekolah->kota)->orderBy('nama_kecamatan')->get();
    //   $kelurahan = Kelurahan::whereKecamatanId($sekolah->kecamatan)->orderBy('nama_kelurahan')->get();
    //   return view('semaya.master.sekolah.edit', ['data' => $sekolah, 'prov' => $prov, 'kota' => $kota, 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan]);
    // }

    // public function delete($id)
    // {
    //   $sekolah = Sekolah::find($id);
    //   $sekolah->delete();
    //   return redirect()->route('sekolah_index');
    // }
}
