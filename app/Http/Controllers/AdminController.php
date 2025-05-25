<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\AdminService;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private $adminService;
    private $registerService;

    public function __construct(AdminService $admin_service, RegisterService $register_service)
    {
        $this->adminService = $admin_service;
        $this->registerService = $register_service;
    }

    public function registerAdmin(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->registerService->createAdmin($request);
            DB::commit();
            return redirect()->route('redirectHome')->with('success', 'Administrador registrado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao registrar o administrado!');
        }
    }
    public function updateAdmin(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->adminService->updateAdmin($request, $id);
            DB::commit();
            return redirect()->route('redirectHome')->with('success', 'Administrador atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao atualizar o Administrador!');
        }
    }

    public function deactivateAdmin($id)
    {
        
        try {
            DB::beginTransaction();
            $this->adminService->deactivateAdmin($id);
            DB::commit();
            return redirect()->back()->with('success', 'Usuário banido com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao banir o usuário!');
        }
    }

    public function reactivateAdmin($id)
    {
        try {
            DB::beginTransaction();
            $this->adminService->reactivateAdmin($id);
            DB::commit();
            return redirect()->back()->with('success', 'Usuário desbanido com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao desbanir o usuário!');
        }
    }

     
}
