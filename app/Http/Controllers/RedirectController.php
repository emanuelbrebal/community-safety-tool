<?php

namespace App\Http\Controllers;

use App\Models\HousingProfileAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RedirectController extends Controller
{
    public function redirectHome(){
        return Inertia::render('Home');
    }

    public function redirectRegister(){
        return view ('register');
    }

    public function redirectListUsers()
    {
        $users = User::with('address.community')->get();
        $answers = HousingProfileAnswer::with('question.section')->get();

        // dd($answers);
        return Inertia::render('ListUsers', [
            'users' => $users, 
            'answers' => $answers 
        ]);
    }
}
