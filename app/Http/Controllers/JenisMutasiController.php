<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisMutasi;
use Validator;

class JenisMutasiController extends Controller
{
    public function index()
    {
      $jenis_mutasi = JenisMutasi::orderBy('id', 'desc')->paginate(10);
      $no = $jenis_mutasi->firstItem();
      return view('semaya.jenis_mutasi.index', ['jenis_mutasi' => $jenis_mutasi, 'no' => $no]);
    }

    public function create()
    {
      $tipe = collect([
        ['id' => 1, 'tipe' => 'Siswa'],
        ['id' => 2, 'tipe' => 'Guru'],
        ['id' => 3, 'tipe' => 'Karyawan'],
      ]);

      return view('semaya.jenis_mutasi.create', ['tipe' => $tipe]);
    }

    public function store(Request $r)
    {
      $nama = $r->input('nama');
      $tipe = $r->input('tipe');

      $validator = Validator::make($r->all(), [
        'nama'=>'required',
        'tipe'=>'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('jenis_mutasi_create')->withErrors($validator)->withInput();
      }

      $jenis_mutasi = new JenisMutasi;
      $jenis_mutasi->mutasi = $nama;
      $jenis_mutasi->tipe = $tipe;
      $jenis_mutasi->save();

      return redirect()->route('jenis_mutasi_index')->with('message', 'Jenis Mutasi berhasil disimpan.');
    }

    public function edit($id)
    {
      $jenis_mutasi = JenisMutasi::findOrFail($id);
      $tipe = collect([
        ['id' => 1, 'tipe' => 'Siswa'],
        ['id' => 2, 'tipe' => 'Guru'],
        ['id' => 3, 'tipe' => 'Karyawan']
      ]);

      return view('semaya.jenis_mutasi.edit', ['jenis_mutasi' => $jenis_mutasi, 'tipe' => $tipe]);
    }

    public function update(Request $r)
    {
      $id = $r->input('id');
      $nama = $r->input('nama');
      $tipe = $r->input('tipe');

      $validator = Validator::make($r->all(), [
        'id'=>'required',
        'nama'=>'required',
        'tipe'=>'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('jenis_mutasi_index')->withErrors($validator);
      }

      $jenis_mutasi = JenisMutasi::findOrFail($id);
      $jenis_mutasi->mutasi = $nama;
      $jenis_mutasi->tipe = $tipe;
      $jenis_mutasi->save();

      return redirect()->route('jenis_mutasi_index')->with('message', 'Jenis Mutasi berhasil diubah.');
    }

    public function destroy($id)
    {
      $jenis_mutasi = JenisMutasi::findOrFail($id);
      $jenis_mutasi->delete();

      return redirect()->route('jenis_mutasi_index')->with('message', 'Jenis Mutasi berhasil dihapus.');
    }
}
