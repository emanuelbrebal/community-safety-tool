<?php

namespace App\Services;

use App\Models\Address;
use App\Models\HousingProfileAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function createUser(Request $request)
    {
        $born_date = \Carbon\Carbon::parse($request->born_date)->format('d/m/Y');
        $user = User::create([
            'first_name' => $request->first_name,
            'surname' => $request->surname,
            'cpf' => $request->cpf,
            'gender_id' => $request->gender_id,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'born_date' => $born_date,
            'password' => Hash::make($request->password)
        ]);

        $path = $request->file('profile_picture')->store('img', 'public');
        $user->update([
            'profile_picture' => $path
        ]);

        return $user;
    }
    public function createAddress(Request $request, User $user)
    {
        return  $address = Address::create([
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
    }

    public function createHousingProfilesAnswers(Request $request, User $user, Address $address)
    {
        foreach ($request->housing_questions as $questionId => $value) {
            HousingProfileAnswer::create([
                'user_id'    => $user->id,
                'address_id' => $address->id,
                'question_id' => $questionId,
                'check'      => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            ]);
        }
    }
}
