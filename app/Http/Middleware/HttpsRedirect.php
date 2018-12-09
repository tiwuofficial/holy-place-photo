<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HttpsRedirect {

    public function handle(Request $request, Closure $next)
    {
        if ($_SERVER["HTTP_X_FORWARDED_PROTO"] != 'https' && App::environment() !== 'local') {
            return redirect()->secure($request->getRequestUri());
        }
        return $next($request);
    }
}
