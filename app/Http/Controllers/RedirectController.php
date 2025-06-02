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
use App\Models\PublicationAddress;
use App\Models\PublicationMedia;
use App\Models\Urgency;
use App\Models\User;
use App\Services\AdminService;
use App\Services\PublicationService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RedirectController extends Controller
{
    private $userService;
    private $adminService;
    private $publicationService;

    public function __construct(UserService $user_service, AdminService $admin_service, PublicationService $publication_service)
    {
        $this->userService = $user_service;
        $this->adminService = $admin_service;
        $this->publicationService = $publication_service;
    }

    public function redirectHome()
    {

        $guard = Auth::guard('admin')->check() ? 'admin' : 'users';
        $user = $this->userService->getUserByGuard($guard);

        if ($guard === 'admin') {
            $publications = $this->publicationService->getRelevantPublications($user->community_id);

            return Inertia::render('Home', [
                'admin' => $user,
                'admin_community_id' => $user->community_id,
                'publications' => $publications->toArray()
            ]);
        }

        $community_chat = Address::where('user_id', $user->id)->pluck('community_id')->first();

        $publications = $this->publicationService->getRelevantPublications($community_chat);

        return Inertia::render('Home', [
            'user' => $user,
            'user_id' => $user->id,
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

        $publication = Publication::with('user', 'incident', 'urgency', 'community')->findOrFail($id);
        $publication_id = $publication->id;
        $publication_address = PublicationAddress::where('publication_id', $publication_id)->first();
        $publication_media = PublicationMedia::where('publication_id', $publication_id)->get();

        $incidents = Incident::with('urgency')->get();
        $urgencies = Urgency::all();

        return Inertia::render('Publications/UpdatePublication', [
            'publication' => $publication,
            'publication_address' => $publication_address,
            'publication_media' => $publication_media,
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
            'admin_id' => $admin->id,
        ]);
    }
}
