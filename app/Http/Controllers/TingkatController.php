<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tingkat;

class TingkatController extends Controller
{
    // public function __construct()
    // {
    //   $this->middleware('auth');
    // }

    public function index()
    {
      $q = '';
      $tingkat = Tingkat::orderBy('nama_tingkat')->paginate(10);
      return view('semaya.master.tingkat.index', ['q' => $q, 'data' => $tingkat]);
    }

    public function create()
    {
      return view('semaya.master.tingkat.create');
    }

    public function store(Request $r)
    {
      $message = [
        'nama.required'  => 'Nama tingkatan harus diisi!',
      ];

      $this->validate($r, [
        'nama'  => 'required',
      ], $message);

      $tingkat = new Tingkat;
      $tingkat->nama_tingkat = $r->input('nama');
      $tingkat->save();
      return redirect()->route('tingkat_index');
    }

    public function edit($id)
    {
      $tingkat = Tingkat::find($id);
      return view('semaya.master.tingkat.edit', ['data' => $tingkat]);
    }

    public function update(Request $r)
    {
      $message = [
        'nama.required'  => 'Nama tingkatan harus diisi!',
      ];

      $this->validate($r, [
        'nama'  => 'required',
      ], $message);
      
      $id_tingkat = $r->input('id_tingkat');
      $tingkat = Tingkat::find($id_tingkat);
      $tingkat->nama_tingkat = $r->input('nama');
      $tingkat->save();
      return redirect()->route('tingkat_index');
    }

    public function delete($id)
    {
      $tingkat = Tingkat::find($id);
      $tingkat->delete();
      return redirect()->route('tingkat_index');
    }
}
