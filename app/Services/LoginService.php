<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService
{
     public function authenticate(Request $request)
    {
        $guard = $request->input('guard');
        $credentials = $request->only(['cpf', 'password']);

        if ($guard === 'admin') {
            $credentials = $request->only(['community_id', 'cpf', 'password']);
        }

        if (Auth::guard($guard)->attempt($credentials)) {
            $request->session()->regenerate();
            $message = $guard === 'admin' ? 'Administrador autenticado com sucesso!' : 'Usuário autenticado com sucesso!';
            return redirect()->route('redirectHome')->with('success', $message);
        }

        return back()->with('error', 'Informação(ões) incorreta(as)')->withInput();
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
