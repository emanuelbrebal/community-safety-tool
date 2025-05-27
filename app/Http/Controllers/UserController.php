<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $user_service)
    {
        $this->userService = $user_service;
    }

    public function updateUser(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->userService->updateUser($request, $id);
            DB::commit();
            return redirect()->route('redirectListUsers')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao atualizar o usuário!');
        }
    }
    public function updateUserAddress(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->userService->updateUserAddress($request, $id);
            DB::commit();
            return redirect()->route('redirectListUsers')->with('success', 'Endereço de usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao atualizar o endereço do usuário!');
        }
    }

     public function updateUserHousingProfileAnswers(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->userService->updateFillUserHousingProfileAnswers($request, $id);
            DB::commit();
            return redirect()->route('redirectListUsers')->with('success', 'Perfil de moradia de usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao atualizar o Perfil de moradia do usuário!');
        }
    }

    public function banUser($id)
    {
        
        try {
            DB::beginTransaction();
            $this->userService->banUser($id);
            DB::commit();
            return redirect()->back()->with('success', 'Usuário banido com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao banir o usuário!');
        }
    }

    public function unbanUser($id)
    {
        try {
            DB::beginTransaction();
            $this->userService->unbanUser($id);
            DB::commit();
            return redirect()->back()->with('success', 'Usuário desbanido com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao desbanir o usuário!');
        }
    }

    
}
