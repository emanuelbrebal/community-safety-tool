<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function showLogin()
    {
        return Inertia::render('Login/Login')
            ->withViewData(['rootView' => 'views.app']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['cpf', 'password']);

        if (Auth::guard('users')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('redirectHome')->with('success', 'Login realizado com sucesso!');
        }
        return back()->with('error', 'CPF ou senha inválido(s)')->withInput();
    }

    public function logout(Request $request)
    {
        if(Auth::guard('admin')->check()){
            $rota = 'showAdminLogin';
        }

        if(Auth::guard('users')->check()){
            $rota = 'showLogin';
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route($rota)->with('success', 'Usuário deslogado com sucesso!');
    }

    public function showAdminLogin()
    {
        return Inertia::render('Login/AdminLogin')
            ->withViewData(['rootView' => 'views.app']);
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->only(['cpf', 'password']);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('redirectHome')->with('success', 'Login de Administrador realizado com sucesso!');
        }
        return back()->with('error', 'CPF ou senha inválido(s)')->withInput();
    }
}
