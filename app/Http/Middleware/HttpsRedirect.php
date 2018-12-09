<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class HttpsRedirect {

    public function handle($request, Closure $next)
    {
        if (!$request->secure() && App::environment() !== 'local') {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
