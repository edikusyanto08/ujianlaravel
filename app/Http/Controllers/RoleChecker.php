<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoleUser;

class RoleChecker extends Controller
{
    public function roleFrom($user_id)
    {
      $role_user = RoleUser::where('user_id',$user_id)->first();
      return $role_user->role_id;
    }
}
