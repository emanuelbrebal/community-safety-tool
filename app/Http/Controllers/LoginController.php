<?php

namespace App\Http\Controllers;

use App\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $login_service){
        $this->loginService = $login_service;
    }
    
    public function userLogin(Request $request)
    {
        try{
            return $this->loginService->authenticate($request, 'users');
        } catch (\Exception $e){
            return back()->with('error', 'Usuário não existe! Cadastre-se agora!');
        }
    }

    public function adminLogin(Request $request)
    {
        try{
            return $this->loginService->authenticate($request, 'admin');
        } catch (\Exception $e){
            return back()->with('error', 'Administrador não existe! Cadastre-se agora!');
        }
    }

    public function logout(Request $request)
    {
        try{
            return $this->loginService->logout($request);
        } catch(\Exception $e){
            return back()->with('error', 'Não foi possível realizar logout!');
        }
    }

}
