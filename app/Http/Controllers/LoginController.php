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
use Inertia\Inertia;

class LoginController extends Controller
{
    public function redirectRegister()
    {
        $genders = Gender::all();
        $communities = Community::all()->where('active', true);
        $housing_profile_questions = HousingProfile::with('section')
            ->get()
            ->groupBy(function ($item) {
                return $item->section->section_title;
            });
        return Inertia::render('Register', [
            'genders' => $genders,
            'communities' => $communities,
            'housing_profile_questions' => $housing_profile_questions
        ]);
    }

    public function createRegister(Request $request)
    {
        //aqui vem um service para criar o registro de usuário
        //outro para o endereço
        //e o outro para o perfil de moradia, cada um com seu form request
        //    dd($request);
        DB::beginTransaction();

        try {

            // dd($request);

            $user = User::create([
                'first_name' => $request->first_name,
                'surname' => $request->surname,
                'cpf' => $request->cpf,
                'gender_id' => $request->gender_id,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'born_date' => $request->born_date,
                'password' => bcrypt($request->password),
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

            // $user->address_id = $address->id;
            $user->save();

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
