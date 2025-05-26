<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Admin;
use App\Models\Community;
use App\Models\Gender;
use App\Models\HousingProfile;
use App\Models\HousingProfileAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function updateUser(Request $request, $id)
    {
        $user = $this->getUser($id);

        $password = $user->password;

        if ($request->password) {
            $password = Hash::make($request->password);
        }

        $path = $user->profile_picture;
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('img', 'public');
        }

        $user->update([
            'first_name' => $request->first_name,
            'surname' => $request->surname,
            'gender_id' => $request->gender_id,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => $password,
            'profile_picture' => $path
        ]);
    }

    public function updateUserAddress(Request $request, $id)
    {

        $address = Address::where('user_id', $id);

        $address->update([
            'zip_code' => $request->zip_code,
            'state' => $request->state,
            'municipality' => $request->municipality,
            'district' => $request->district,
            'public_place' => $request->public_place,
            'number' => $request->number,
            'complement' => $request->complement
        ]);
    }

    public function updateFillUserHousingProfileAnswers(Request $request, $id)
    {
        $user = $this->getUser($id);
        $answers = HousingProfileAnswer::where('user_id', $id)->select('id', 'check', 'question_id')->get();

        foreach ($request->input('housing_questions', []) as $questionId => $newCheckValue) {
            $answerModel = $answers->firstWhere('question_id', $questionId);
            if ($answerModel && $answerModel->check != $newCheckValue) {
                $answerModel->update([
                    'check' => $newCheckValue
                ]);
            }
        }
    }


    public function banUser($id)
    {
        $user = $this->getUser($id);
        if ($user->active) {
            $user->update([
                'active' => false
            ]);

            return;
        }
        return back()->with('error', 'Usuário já está banido!');
    }

    public function unbanUser($id)
    {
        $user = $this->getUser($id);
        if (!$user->active) {
            $user->update([
                'active' => true
            ]);

            return $user;
        }
        return back()->with('error', 'Usuário já está ativo!');
    }

    public function getUser($id)
    {
        return User::with('gender', 'address')->findOrFail($id);
    }
    public function getuserByGuard($guard)
    {
        return Auth::guard($guard)->user();
    }
    public function getUserCommunityID($id)
    {
        $user = $this->getUser($id);
        return $user->address->community_id;
    }
}
