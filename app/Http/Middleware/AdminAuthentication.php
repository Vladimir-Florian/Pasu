<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class AdminAuthentication
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->auth->check())
        {
            //dd($this->auth->user()->hasRole('admin'));
            if($this->auth->user()->hasRole('admin') == true)
            {
                return $next($request);

            }
            else
            {
                return redirect('/')->withErrors('You are not admin');             
            }
        }
        //return new RedirectResponse(url('/'));
        return redirect('/')->withErrors('You are not logged in');
        //return view('auth.login')->withErrors('You are not logged in');


    }
}
