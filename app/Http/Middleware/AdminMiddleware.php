<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        foreach(Auth::user()->role as $role)
        {
            if($role->name == 'admin')
            {
                return $next($request);
            }
        }
        return redirect('/');
    }
}
