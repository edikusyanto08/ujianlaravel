<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisPelajaran;
use App\Pelajaran;
use App\Jurusan;

class PelajaranController extends Controller
{
    // public function __construct()
    // {
    //   $this->middleware('auth');
    // }

    public function index()
    {
      $pelajaran = Pelajaran::orderBy('kode_pel')->paginate(10);
      return view('semaya.master.pelajaran.index', ['data' => $pelajaran, 'q' => '']);
    }

    public function create()
    {
      $jenis = JenisPelajaran::orderBy('nama')->get();
      return view('semaya.master.pelajaran.create', ['jenis' => $jenis]);
    }

    public function store(Request $r)
    {
      $message = [
        'kode_pelajaran.required'  => 'Kode pelajaran harus diisi!',
        'nama_pelajaran.required'  => 'Nama pelajaran harus diisi!',
        'jenis_pelajaran.required'  => 'Kelompok pelajaran harus diisi!',
      ];

      $this->validate($r, [
        'kode_pelajaran'  => 'required',
        'nama_pelajaran'  => 'required',
        'jenis_pelajaran'  => 'required',
      ], $message);

      $pelajaran = new Pelajaran;
      $pelajaran->kode_pel = $r->input('kode_pelajaran');
      $pelajaran->pelajaran = $r->input('nama_pelajaran');
      $pelajaran->jenis_pelajaran_id = $r->input('jenis_pelajaran');
      $pelajaran->save();
      return redirect()->route('pelajaran_index');
    }

    public function edit($id)
    {
      $jenis = JenisPelajaran::orderBy('nama')->get();
      $pelajaran = Pelajaran::find($id);
      return view('semaya.master.pelajaran.edit', ['data' => $pelajaran, 'jenis' => $jenis]);
    }

    public function update(Request $r)
    {
      $message = [
        'kode_pelajaran.required'  => 'Kode pelajaran harus diisi!',
        'nama_pelajaran.required'  => 'Nama pelajaran harus diisi!',
        'jenis_pelajaran.required'  => 'Kelompok pelajaran harus diisi!',
      ];

      $this->validate($r, [
        'kode_pelajaran'  => 'required',
        'nama_pelajaran'  => 'required',
        'jenis_pelajaran'  => 'required',
      ], $message);

      $id_pelajaran = $r->input('id_pelajaran');
      $pelajaran = Pelajaran::find($id_pelajaran);
      $pelajaran->kode_pel = $r->input('kode_pelajaran');
      $pelajaran->pelajaran = $r->input('nama_pelajaran');
      $pelajaran->jenis_pelajaran_id = $r->input('jenis_pelajaran');
      $pelajaran->save();
      return redirect()->route('pelajaran_index');
    }

    public function delete($id)
    {
      $pelajaran = Pelajaran::find($id);
      $pelajaran->delete();
      return redirect()->route('pelajaran_index');
    }

    public function search(Request $r)
    {
      $q = $r->input('q');
      $pelajaran = Pelajaran::where('pelajaran', 'like', '%' . $q . '%')->orderBy('kode_pel')->paginate(10);
      $no = $pelajaran->firstItem();
      return view('semaya.master.pelajaran.index', ['data' => $pelajaran, 'q' => $q]);
    }

    public function kelompok_index()
    {
      $jenis = JenisPelajaran::select('jenis_pelajaran.id', 'jenis_pelajaran.nama', 'jurusan.singkatan_jurusan')
                              ->leftJoin('jurusan', 'jenis_pelajaran.jurusan_id', 'jurusan.id')
                              ->orderBy('jenis_pelajaran.id', 'desc')
                              ->paginate(10);
      return view('semaya.master.pelajaran.jenis-pelajaran.index', ['data' => $jenis]);
    }

    public function kelompok_create()
    {
      $jurusan = Jurusan::all();
      return view('semaya.master.pelajaran.jenis-pelajaran.create', ['jurusan' => $jurusan]);
    }

    public function kelompok_store(Request $r)
    {
      $jenis_pelajaran = $r->input('jenis_pelajaran');
      $jurusan_id = $r->input('jurusan_id');

      $message = [
        'jenis_pelajaran.required'  => 'Kelompok pelajaran harus diisi!',
        // 'jurusan_id.required'  => 'Jurusan harus diisi!',
      ];

      $this->validate($r, [
        'jenis_pelajaran'  => 'required',
        // 'jurusan_id'  => 'required',
      ], $message);

      $jenis = new JenisPelajaran;
      $jenis->nama = $jenis_pelajaran;
      $jenis->jurusan_id = ($jurusan_id == null ? 0 : $jurusan_id);
      $jenis->save();
      return redirect()->route('kelompok_index');
    }

    public function kelompok_edit($id)
    {
      $jenis = JenisPelajaran::find($id);
      $jurusan = Jurusan::all();
      return view('semaya.master.pelajaran.jenis-pelajaran.edit', ['data' => $jenis, 'jurusan' => $jurusan]);
    }

    public function kelompok_update(Request $r)
    {
      $id_jenis = $r->input('id_jenis');
      $jenis_pelajaran = $r->input('jenis_pelajaran');
      $jurusan_id = $r->input('jurusan_id');

      $message = [
        'jenis_pelajaran.required'  => 'Kelompok pelajaran harus diisi!',
      ];

      $this->validate($r, [
        'jenis_pelajaran'  => 'required',
      ], $message);

      $jenis = JenisPelajaran::find($id_jenis);
      $jenis->nama = $jenis_pelajaran;
      $jenis->jurusan_id = ($jurusan_id == null ? 0 : $jurusan_id);
      $jenis->save();
      return redirect()->route('kelompok_index');
    }

    public function kelompok_delete($id)
    {
      $jenis = JenisPelajaran::find($id);
      $jenis->delete();
      return redirect()->route('kelompok_index');
    }
}
