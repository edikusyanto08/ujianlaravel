<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guru;
use App\JenisPelajaran;
use App\Pelajaran;
use App\GuruPelajaran;

class GuruMataPelajaranController extends Controller
{
    public function index($id)
    {
      $guru = Guru::findOrFail($id);
      $jenis_pelajaran = JenisPelajaran::all();
      return view('semaya.guru_pelajaran.index', ['guru'=>$guru, 'jenis_pelajaran'=>$jenis_pelajaran]);
    }

    public function storeTeacherLessons($id, Request $r)
    {
      $lesson_id = $r->input('lesson_id');

      if (count($lesson_id) == 0) {
        return redirect()->route('guru_mata_pelajaran_index', ['id' => $id])->with('error', 'Pilih minimal 1 pelajaran.');
      }

      $get_guru_pelajaran = GuruPelajaran::where('guru_id', $id)->delete();

      foreach ($lesson_id as $key => $value) {
        $guru_pelajaran = new GuruPelajaran;
        $guru_pelajaran->pelajaran_id = $key;
        $guru_pelajaran->guru_id = $id;
        $guru_pelajaran->save();
      }

      return redirect()->route('guru_mata_pelajaran_index', ['id' => $id])->with('message', 'Pengaturan pelajaran berhasil disimpan.');
    }
}
