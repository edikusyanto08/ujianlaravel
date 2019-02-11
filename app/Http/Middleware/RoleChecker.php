<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Http\Controllers\RoleChecker as CheckRole;

class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role_id)
    {
      $role_checker = new CheckRole;
      $auth = Auth::user();

      if ($role_checker->roleFrom($auth->id) == $role_id) {
        return $next($request);
      }

      return view('404');
    }
}
