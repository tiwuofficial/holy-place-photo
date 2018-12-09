<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\View;

class CheckLogin
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
        if (!$request->session()->has('userId')) {
            $user = new User();
            $user->save();
            $request->session()->put('userId', $user->id);
        } else {
            $user = User::where('id', $request->session()->get('userId'))->first();
        }
        View::share('user', $user);
        return $next($request);
    }
}
