<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Admin;
use App\Models\Community;
use App\Models\Gender;
use App\Models\HousingProfile;
use App\Models\HousingProfileAnswer;
use App\Models\Incident;
use App\Models\Publication;
use App\Models\Urgency;
use App\Models\User;
use App\Services\AdminService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RedirectController extends Controller
{
    private $userService;
    private $adminService;

    public function __construct(UserService $user_service, AdminService $admin_service)
    {
        $this->userService = $user_service;
        $this->adminService = $admin_service;
    }
    public function redirectHome()
    {

        $guard = 'users';
    
        if (Auth::guard('admin')->check()) {
            $guard = 'admin';
        }

        $user_id = $this->userService->getUserByGuard($guard)->id;
        
        $community_chat = Address::where('user_id', $user_id)->pluck('community_id')->first();
    

        $publications = Publication::with('user', 'incident', 'urgency', 'media', 'address', 'community')
        ->where('community_id', $community_chat)
        ->where('active', true)
        ->where('solved', false)
        ->where('created_at', '>=', Carbon::now()->subMonth())
        ->orderBy('urgency_id', 'desc')
        ->orderBy('created_at', 'asc')
        ->get();
        
        return Inertia::render('Home', [
            'user' => $this->userService->getUserByGuard($guard),
            'user_id' => $user_id,
            'publications' => $publications->toArray()
        ]);
    }

    public function redirectListUsers()
    {
        $users = User::with(['address.community'])->get();
        $answers = HousingProfileAnswer::with(['question.section'])->get();
        $admins = Admin::with(['community'])->get();

        return Inertia::render('Admin/ListUsers', [
            'users' => $users,
            'admins' => $admins,
            'answers' => $answers,
        ]);
    }

    public function redirectCreatePublication()
    {
        $incidents = Incident::with('urgency')->get();
        $urgencies = Urgency::all();

        return Inertia::render('Publications/CreatePublication', [
            'incidents' => $incidents,
            'urgencies' => $urgencies
        ]);
    }

    public function redirectUpdatePublication($id)
    {
        
        $publication = Publication::with('user', 'incident', 'urgency', 'media', 'address', 'community')->findOrFail($id);
        $incidents = Incident::with('urgency')->get();
        $urgencies = Urgency::all();

        return Inertia::render('Publications/UpdatePublication', [
            'publication' => $publication,
            'incidents' => $incidents,
            'urgencies' => $urgencies
        ]);
    }

    public function redirectLoginUser()
    {
        return Inertia::render('Login/Login')
            ->withViewData(['rootView' => 'views.app']);
    }

    public function redirectLoginAdmin()
    {
        return Inertia::render('Login/AdminLogin')
            ->withViewData(['rootView' => 'views.app']);
    }

    public function redirectRegister()
    {
        $genders = Gender::all();
        $communities = Community::where('active', true)->get();
        $housing_profile_questions = HousingProfile::with('section')
            ->get()
            ->groupBy(function ($item) {
                return $item->section->section_title;
            });

        return Inertia::render('Registers/Register', [
            'housing_profile_questions' => $housing_profile_questions,
            'genders' => $genders,
            'communities' => $communities
        ]);
    }

    public function redirectUpdateUser($id)
    {
        $user = $this->userService->getUser($id);

        return Inertia::render('User/UpdateUser', [
            'user' => $user,
        ]);
    }
    public function redirectUpdatePersonalInformation($id)
    {
        $user = $this->userService->getUser($id);
        $genders = Gender::all();

        return Inertia::render('User/UpdatePersonalInfo', [
            'user' => $user,
            'genders' => $genders
        ]);
    }
    public function redirectUpdateUserAddress($id)
    {
        $user = $this->userService->getUser($id);
        $address = Address::where('user_id', $id)->with('community')->first();
        $communities = Community::where('active', true)->get();
        return Inertia::render('User/UpdateUserAddress', [
            'user' => $user,
            'address' => $address,
            'communities' => $communities
        ]);
    }
    public function redirectUpdateUserHousingProfile($id)
    {
        $questions = HousingProfile::with('section')
            ->get()
            ->groupBy(function ($item) {
                return $item->section->section_title;
            });
        $answers = HousingProfileAnswer::where('user_id', $id)->pluck('check', 'question_id');

        return Inertia::render('User/UpdateHousingProfileAnswers', [
            'user_id' => (int) $id,
            'housing_profile_answers' => $answers,
            'housing_profile_questions' => $questions
        ]);
    }

    public function redirectAdminRegister()
    {
        $communities = Community::where('active', true)->get();

        return Inertia::render('Registers/AdminRegister', [
            'communities' => $communities
        ]);
    }

     public function redirectUpdateAdmin($id)
    {
        $admin = $this->adminService->getAdmin($id);

        return Inertia::render('Admin/UpdateAdmin', [
            'admin' => $admin,
        ]);
    }
}
