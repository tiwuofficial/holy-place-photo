<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class SWCacheList
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
        $manifests = json_decode(file_get_contents(public_path('/mix-manifest.json')), true);
        $files = array_filter($manifests, function($key) {
            return $key !== '/sw.js';
        }, ARRAY_FILTER_USE_KEY);
        View::share('swCacheList', json_encode(array_values($files)));
        return $next($request);
    }
}
