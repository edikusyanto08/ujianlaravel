<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KameraCCTV;
use Validator;

class CCTVController extends Controller
{
    public function index()
    {
      $cctv = KameraCCTV::orderBy('id','desc')->paginate(10);
      $no = $cctv->firstItem();
      return view('semaya.cctv.index', ['cctv' => $cctv, 'no' => $no]);
    }

    public function create()
    {
      return view('semaya.cctv.create');
    }

    public function store(Request $r)
    {
      $nama_tempat = $r->input('nama_tempat');
      $ip = $r->input('ip');
      $username = $r->input('username');
      $password = $r->input('password');
      $channel = $r->input('channel');

      $validator = Validator::make($r->all(), [
        'nama_tempat' => 'required',
        'ip' => 'required',
        'username' => 'required',
        'channel' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('cctv_create')->withErrors($validator)->withInput();
      }

      $cctv = new KameraCCTV;
      $cctv->nama_tempat = $nama_tempat;
      $cctv->ip = $ip;
      $cctv->username = $username;
      $cctv->password = $password;
      $cctv->channel = $channel;
      $cctv->link_kamera = 'rtsp://'.$ip.':554/user='.$username.'&password='.$password.'&channel='.$channel.'&stream=1.sdp?real_stream--rtp-caching=100';
      $cctv->save();

      return redirect()->route('cctv_index')->with('message', 'Kamera CCTV berhasil disimpan.');
    }

    public function edit($id)
    {
      $cctv = KameraCCTV::findOrFail($id);
      return view('semaya.cctv.edit', ['cctv' => $cctv]);
    }

    public function update(Request $r)
    {
      $id = $r->input('id');
      $nama_tempat = $r->input('nama_tempat');
      $ip = $r->input('ip');
      $username = $r->input('username');
      $password = $r->input('password');
      $channel = $r->input('channel');

      $validator = Validator::make($r->all(), [
        'id' => 'required',
        'nama_tempat' => 'required',
        'ip' => 'required',
        'username' => 'required',
        'channel' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('cctv_edit', ['id' => $id])->withErrors($validator)->withInput();
      }

      $cctv = KameraCCTV::findOrFail($id);
      $cctv->nama_tempat = $nama_tempat;
      $cctv->ip = $ip;
      $cctv->username = $username;
      $cctv->password = $password;
      $cctv->channel = $channel;
      $cctv->link_kamera = 'rtsp://'.$ip.':554/user='.$username.'&password='.$password.'&channel='.$channel.'&stream=1.sdp?real_stream--rtp-caching=100';
      $cctv->save();

      return redirect()->route('cctv_index')->with('message', 'Kamera CCTV berhasil diedit.');
    }

    public function destroy($id)
    {
      $cctv = KameraCCTV::findOrFail($id);
      $cctv->delete();

      return redirect()->route('cctv_index')->with('message', 'Kamera CCTV berhasil dihapus.');
    }
}
