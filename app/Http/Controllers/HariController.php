<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hari;

class HariController extends Controller
{
    // public function __construct()
    // {
    //   $this->middleware('auth');
    // }

    public function index()
    {
      $hari = Hari::orderBy('id')->paginate(10);
      return view('semaya.master.hari.index', ['data' => $hari]);
    }

    public function create()
    {
      return view('semaya.master.hari.create');
    }

    public function store(Request $r)
    {
      $message = [
        'hari.required'  => 'Nama hari harus diisi!',
      ];

      $this->validate($r, [
        'hari'  => 'required',
      ], $message);

      $hari = new Hari;
      $hari->hari = $r->input('hari');
      $hari->save();
      return redirect()->route('hari_index');
    }

    public function edit($id)
    {
      $hari = Hari::find($id);
      return view('semaya.master.hari.edit', ['data' => $hari]);
    }

    public function update(Request $r)
    {
      $message = [
        'hari.required'  => 'Nama hari harus diisi!',
      ];

      $this->validate($r, [
        'hari'  => 'required',
      ], $message);

      $id_hari = $r->input('id_hari');
      $hari = Hari::find($id_hari);
      $hari->hari = $r->input('hari');
      $hari->save();
      return redirect()->route('hari_index');
    }

    public function delete($id)
    {
      $hari = Hari::find($id);
      $hari->delete();
      return redirect()->route('hari_index');
    }
}
