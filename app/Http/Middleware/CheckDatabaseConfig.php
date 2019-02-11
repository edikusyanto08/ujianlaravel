<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\HelperController as Helper;

class CheckDatabaseConfig
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $helper = new Helper;

        if ($helper->setDB()) {
          return $next($request);
        }

        abort(404);
    }
}
