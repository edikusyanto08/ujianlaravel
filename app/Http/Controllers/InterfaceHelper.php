<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\SekolahMaster;
use App\User;

class InterfaceHelper extends Controller
{
    public function date($format, $date)
    {
      $final_format = Carbon::createFromFormat($format, $date)->format('Y-m-d');
      return $final_format;
    }

    public function schoolFrom($user_id)
    {
      $user = User::findOrFail($user_id);
      $sekolah = SekolahMaster::find($user->sekolah_id);
      return $sekolah->id;
    }
}
