<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Seller;
use Illuminate\Http\Response;

class VerifyEmailMiddleware
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

   
        $seller = Seller::where('email', $request->username)
                                   ->orWhere('company_name', $request->username)
                                   ->first();

        if(!$seller) {
            return redirect()
                        ->route('auth.signin')
                        ->with('message', 'Lojista não encontrado')
                        ->withInput();
        }

        if(\is_null($seller->email_verified_at)) {
            return redirect()
                        ->route('auth.signin')
                        ->with('message', 'Verifique o email para continuar')
                        ->withInput();
        }

        return $next($request);
    }
}
