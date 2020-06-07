<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;

class Lingua {
    
    public function handle($request, Closure $next) {
        if (Session::has('lingua')) {
            App::setLocale(Session::get('lingua'));
        }
        
        return $next($request);
    }
}