<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TahunAjaran;
use Carbon\Carbon;

class TahunAjaranController extends Controller
{
    // public function __construct()
    // {
    //   $this->middleware('auth');
    // }

    public function index()
    {
      $tahun = TahunAjaran::orderBy('nama', 'desc')->paginate(10);
      return view('semaya.master.tahun-ajaran.index', ['data' => $tahun]);
    }

    public function create()
    {
      return view('semaya.master.tahun-ajaran.create');
    }

    public function store(Request $r)
    {
      if ($r->input('status') == 1) {
        $count = TahunAjaran::whereStatus('1')->count();
        if ($count > 0) {
          return redirect()->route('tahun_index')->with('message', 'Sudah ada tahun pelajaran yang aktif!');
        }
      }

      $message = [
        'tahun_ajaran.required'  => 'Tahun ajaran harus diisi!',
        'tanggal_mulai.required'  => 'Tanggal mulai harus diisi!',
        'tanggal_selesai.required'  => 'Tanggal selesai harus diisi!',
        'status.required'  => 'Status harus diisi!',
      ];

      $this->validate($r, [
        'tahun_ajaran'  => 'required',
        'tanggal_mulai'  => 'required',
        'tanggal_selesai'  => 'required',
        'status'  => 'required',
      ], $message);

      $tahun = new TahunAjaran;
      $tahun->nama = $r->input('tahun_ajaran');
      $tahun->tanggal_mulai = Carbon::createFromFormat('d/m/Y', $r->input('tanggal_mulai'))->toDateString();
      $tahun->tanggal_selesai = Carbon::createFromFormat('d/m/Y', $r->input('tanggal_selesai'))->toDateString();
      $tahun->status = $r->input('status');
      $tahun->save();
      return redirect()->route('tahun_index');
    }

    public function edit($id)
    {
      $tahun = TahunAjaran::find($id);
      return view('semaya.master.tahun-ajaran.edit', ['data' => $tahun]);
    }

    public function update(Request $r)
    {
      $id_tahun = $r->input('id_tahun');
      if ($r->input('status') == 1) {
        $aktif = TahunAjaran::whereStatus('1')->first();
        if ($aktif != null) {
          if ($id_tahun != $aktif->id) {
            return redirect()->route('tahun_index')->with('message', 'Sudah ada Tahun Pelajaran yang aktif!');
          }
        }
      }

      $message = [
        'tahun_ajaran.required'  => 'Tahun ajaran harus diisi!',
        'tanggal_mulai.required'  => 'Tanggal mulai harus diisi!',
        'tanggal_selesai.required'  => 'Tanggal selesai harus diisi!',
        'status.required'  => 'Status harus diisi!',
      ];

      $this->validate($r, [
        'tahun_ajaran'  => 'required',
        'tanggal_mulai'  => 'required',
        'tanggal_selesai'  => 'required',
        'status'  => 'required',
      ], $message);

      $tahun = TahunAjaran::find($id_tahun);
      $tahun->nama = $r->input('tahun_ajaran');
      $tahun->tanggal_mulai = Carbon::createFromFormat('d/m/Y', $r->input('tanggal_mulai'))->toDateString();
      $tahun->tanggal_selesai = Carbon::createFromFormat('d/m/Y', $r->input('tanggal_selesai'))->toDateString();
      $tahun->status = $r->input('status');
      $tahun->save();
      return redirect()->route('tahun_index');
    }

    public function delete($id)
    {
      $tahun = TahunAjaran::find($id);
      $tahun->delete();
      return redirect()->route('tahun_index');
    }
}
