<?php

namespace App\Http\Controllers;

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
}
