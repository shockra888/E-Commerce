<?php

namespace App\Http\Middleware;


use Closure;

class AutoCheck
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
        if(!session()->has('Active')){
            return redirect('/')->with('Fail','You must log in first');
        }
        return $next($request);
    }
}
