<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoggedUserLoginAttempt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('users')->check() || Auth::guard('admin')->check()) {
            return redirect()->route('redirectHome')->with('error','Usuário já está logado! Faça o logout antes de continuar!');
        }
        return $next($request);
    }
}
