<?php

namespace App\Http\Controllers;

use App\Guru;
use App\RoleUser;
use App\Siswa;
use App\User;
use Auth;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function recoverStudent() {
        $student = Siswa::all();
        $sekolah_id = Auth::user()->sekolah_id;

        foreach ($student as $row) {
            if ($sekolah_id < 10) {
                $first_char = '0'.$sekolah_id.'-'.$row->nis;
            }
            else {
                $first_char = $sekolah_id.'-'.$row->nis;
            }

            $user = new User;
            $user->username = $first_char;
            $user->password = bcrypt($row->pin);
            $user->sekolah_id = $sekolah_id;
            $user->save();

            $role_user = new RoleUser;
            $role_user->user_id = $user->id;
            $role_user->role_id = 5;
            $role_user->save();
        }
    }

    public function recoverTeacher() {
        $teacher = Guru::all();
        $sekolah_id = Auth::user()->sekolah_id;

        foreach ($teacher as $row) {
            $user = new User;
            $user->username = $row->nomor_kartu;
            $user->password = bcrypt($row->pin);
            $user->sekolah_id = $sekolah_id;
            $user->save();

            $role_user = new RoleUser;
            $role_user->user_id = $user->id;
            $role_user->role_id = 4;
            $role_user->save();
        }
    }
}
