<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class validateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     private $rules = [
        'name' => 'required',
        'password' => 'required',
        'email' => 'required|email',
    ];

    public function handle(Request $request, Closure $next)
    {

        return $next($request);
    }
}
