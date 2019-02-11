<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;

class AlumniController extends Controller
{
  public function index()
  {
    $siswa = Siswa::where('lulus', 1)->paginate(10);
    $no = $siswa->firstItem();
    return view('semaya.master.alumni.index', ['data' => $siswa, 'no' => $no]);
  }
}
