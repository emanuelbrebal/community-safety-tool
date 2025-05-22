<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Address;
use App\Models\Community;
use App\Models\Gender;
use App\Models\HousingProfile;
use App\Models\HousingProfileAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisterController extends Controller
{
    
    public function createRegister(Request $request)
    {
        //aqui vem um service para criar o registro de usuário
        //outro para o endereço
        //e o outro para o perfil de moradia, cada um com seu form request
        //    dd($request);
        
        try {
            DB::beginTransaction();

            $user = User::create([
                'first_name' => $request->first_name,
                'surname' => $request->surname,
                'cpf' => $request->cpf,
                'gender_id' => $request->gender_id,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'born_date' => $request->born_date,
                'password' => Hash::make($request->password),
            ]);

            $address = Address::create([
                'community_id' => $request->community_id,
                'zip_code'     => $request->zip_code,
                'state'        => $request->state,
                'municipality' => $request->municipality,
                'district'     => $request->district,
                'public_place' => $request->public_place,
                'number'       => $request->number,
                'complement'   => $request->complement,
                'user_id'      => $user->id
            ]);

            foreach ($request->housing_questions as $questionId => $value) {
                HousingProfileAnswer::create([
                    'user_id'    => $user->id,
                    'address_id' => $address->id,
                    'question_id' => $questionId,
                    'check'      => filter_var($value, FILTER_VALIDATE_BOOLEAN),
                ]);
            }

            DB::commit();

            return redirect()->route('redirectHome')->with('success', 'Cadastro realizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Erro ao cadastrar usuário!');
        }
    }
}
