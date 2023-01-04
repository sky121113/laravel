<?php

namespace App\Http\Middleware;

use Closure;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function redirectTo($tokenls)
    {
        if ($tokenls !== 'my-secret-token') {
            return redirect('home');
        } else {
            echo "567";
        }
        
        // return $next($tokenls);
    }
}