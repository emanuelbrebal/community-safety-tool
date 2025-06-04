<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('users')->user()->active){
            return redirect()->back('redirectLoginUser')->with('error', 'Seu usuário foi banido ou excluído. Para mais detalhes, contacte seu administrador');
        }
        return $next($request);
    }
}
