<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Seller;

class Auth
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
        
        $token = $request->cookie('token');

        if(!$token) {
            return redirect()->route('auth.signin');
        }

        $user = Seller::where('api_token', $token)->first();

        if(!$user) {
            return redirect()->route('auth.signin'); 
        }
   

        return $next($request);
    }
}
