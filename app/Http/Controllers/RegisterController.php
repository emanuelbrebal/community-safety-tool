<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Address;
use App\Models\Community;
use App\Models\Gender;
use App\Models\HousingProfile;
use App\Models\HousingProfileAnswer;
use App\Models\User;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisterController extends Controller
{
    private $registerService;

    public function __construct(RegisterService $register_service)
    {
        $this->registerService = $register_service;
    }

    public function createRegister(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->registerService->createUser($request);
            $address = $this->registerService->createAddress($request, $user);
            $this->registerService->createHousingProfilesAnswers($request, $user, $address);
            DB::commit();

            return redirect()->route('redirectHome')->with('success', 'Cadastro realizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Erro ao cadastrar usuário!' . $e->getMessage());
        }
    }
}
