<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\RoleChecker;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
      return view('semaya.auth.login');
    }

    public function postLogin(Request $r)
    {
      $role_checker = new RoleChecker;
      $username = $r->input('username');
      $password = $r->input('password');

      $validator = Validator::make($r->all(),[
        'username'=>'required',
        'password'=>'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('login')->withErrors($validator)->withInput();
      }

      if (Auth::attempt(['username'=>$username,'password'=>$password],true)) {
        if (Auth::viaRemember()) {
          if ($role_checker->roleFrom(Auth::user()->id) == 1) { //login for root
            return redirect()->route('home');
          }
          elseif ($role_checker->roleFrom(Auth::user()->id) == 2) { //login for admin sas
            return redirect()->route('home');
          }
          elseif ($role_checker->roleFrom(Auth::user()->id) == 4) { //login for teacher
            return redirect()->route('home');
          }
          elseif ($role_checker->roleFrom(Auth::user()->id) == 5) { //login for student
            return redirect()->route('home');
          }

          Auth::logout();
          return redirect()->route('login')->with('message','Kombinasi nama pengguna dan kata sandi salah.')->withInput();
        }

        if ($role_checker->roleFrom(Auth::user()->id) == 1) { //login for root
          return redirect()->route('home');
        }
        elseif ($role_checker->roleFrom(Auth::user()->id) == 2) { //login for admin sas
          return redirect()->route('home');
        }
        elseif ($role_checker->roleFrom(Auth::user()->id) == 4) { //login for teacher
          return redirect()->route('home');
        }
        elseif ($role_checker->roleFrom(Auth::user()->id) == 5) { //login for student
          return redirect()->route('home');
        }

        Auth::logout();
        return redirect()->route('login')->with('message','Kombinasi nama pengguna dan kata sandi salah.')->withInput();
      }

      return redirect()->route('login')->with('message','Kombinasi nama pengguna dan kata sandi salah.')->withInput();
    }

    public function logout()
    {
      Auth::logout();
      return redirect('login');
    }
}
