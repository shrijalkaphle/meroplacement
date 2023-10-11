<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if($request->session()->exists('user')) {
            if($request->session()->get('user')['role'] == 'admin' || $request->session()->get('user')['role'] == 'staff') {
                return $next($request);
            }
        }
        return redirect()->back();
    }
}
