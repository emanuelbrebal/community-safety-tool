<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\HousingProfileAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RedirectController extends Controller
{
    public function redirectHome()
    {
        if (Auth::guard('admin')->check()) {
            return Inertia::render('Home', [
                'user' => Auth::guard('admin')->user()
            ]);
        }
        return Inertia::render('Home', [
            'user' => Auth::guard('users')->user()
        ]);
    }

    public function redirectRegister()
    {
        return Inertia::render('Register');
    }

    public function redirectListUsers()
    {
        $users = User::with(['address.community'])->get();
        $answers = HousingProfileAnswer::with(['question.section'])->get();

        return Inertia::render('ListUsers', [
            'users' => $users,
            'answers' => $answers,
        ]);
    }
}
