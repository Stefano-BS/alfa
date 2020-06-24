<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;

class Lingua {
    
    public function handle($request, Closure $next) {
        if (auth()->check()) {
            Session::put('lingua', auth()->user()->lingua);
            App::setLocale(Session::get('lingua'));
        } else if (Session::has('lingua')) {
            App::setLocale(Session::get('lingua'));
        }
        
        return $next($request);
    }
}