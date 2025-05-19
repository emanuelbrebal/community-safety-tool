<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\HousingProfileAnswer;
use App\Models\Incident;
use App\Models\Publication;
use App\Models\Urgency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RedirectController extends Controller
{
    public function redirectHome()
    {
        $publications = Publication::with('user', 'incident', 'urgency', 'media', 'address')->orderBy('created_at', 'asc')->get();
        
        $user = 'users';
        if (Auth::guard('admin')->check()) {
            $user = 'admin';
        }
        
        return Inertia::render('Home', [
            'user' => Auth::guard($user)->user(),
            'publications' => $publications
        ]);
    }

    public function redirectRegister()
    {
        return Inertia::render('Registers/Register');
    }

    public function redirectListUsers()
    {
        $users = User::with(['address.community'])->get();
        $answers = HousingProfileAnswer::with(['question.section'])->get();

        return Inertia::render('Admin/ListUsers', [
            'users' => $users,
            'answers' => $answers,
        ]);
    }

    public function redirectCreatePublication(){
        $incidents = Incident::with('urgency')->get();
        $urgencies = Urgency::all();

        return Inertia::render('Publications/CreatePublication', [
            'incidents' => $incidents,
            'urgencies' => $urgencies
        ]);
    }
}
