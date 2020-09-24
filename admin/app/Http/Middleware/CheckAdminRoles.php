<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Seller;

class CheckAdminRoles
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
        $seller = Seller::where('api_token', $token)->first();

        if($seller->roles != 'adm') {
            return redirect()
                        ->back()
                        ->with('message', 'Nao autorizado!')
                        ->withInput();
        }

        return $next($request);
    }
}
