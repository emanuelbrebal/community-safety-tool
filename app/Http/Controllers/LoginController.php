<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Community;
use App\Models\Gender;
use App\Models\HousingProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function redirectRegister(){
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

    public function createRegister(Request $request){
        //aqui vem o service para criar o registro de usuário
        return Inertia::render('Home');
    }
    

    public function listUsers(){
        $users = User::active()->orderByName()->all();

        return Inertia::render('Users', [
            'users' => $users
        ]);
    }
}
