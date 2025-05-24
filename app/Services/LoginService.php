<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function authenticate(Request $request, string $guard)
    {
        $credentials = $request->only(['cpf', 'password']);
        
        if ($guard == 'users') {
            Auth::guard($guard)->attempt($credentials);
            $request->session()->regenerate();
            return redirect()->route('redirectHome')->with('success', 'Usuário autenticado com sucesso!');
        }

        if ($guard == 'admin') {
            $credentials = $request->only(['cpf', 'password', 'community']);
            Auth::guard($guard)->attempt($credentials);
            $request->session()->regenerate();
            return redirect()->route('redirectHome')->with('success', 'Administrador autenticado com sucesso!');
        }

        return back()->with('error', 'CPF ou senha inválido(s)')->withInput();
    }


    public function logout(Request $request)
    {
        $rota = 'redirectLoginUser';

        if (Auth::guard('admin')->check()) {
            $rota = 'redirectLoginAdmin';
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($rota)->with('success', 'Usuário deslogado com sucesso!');
    }
}
