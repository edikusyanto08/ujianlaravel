<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\SekolahMaster;

class HelperController extends Controller
{
    public function setDB()
    {
      if (Auth::check()) {
        $master_sekolah = SekolahMaster::find(Auth::user()->sekolah_id);

        if (sizeof($master_sekolah) > 0) {
          config(['database.connections.absensi.database' => $master_sekolah->database2]);
          return true;
        }

        return false;
      }

      return false;
    }
}
