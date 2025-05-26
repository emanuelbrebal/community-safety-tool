<?php

namespace App\Services;

use App\Models\Publication;
use App\Models\PublicationMedia;
use App\Models\PublicationAddress;
use App\Models\User;
use App\Models\UserPublication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PublicationService
{
    private $userService;

    public function __construct(UserService $user_service)
    {
        $this->userService = $user_service;
    }

    public function createPublication(Request $request)
    {
        $user_id = $this->getUserID();

        $community_id = $this->userService->getUserCommunityID($user_id);

        $publication_address = $this->createPublicationAddress($request);
        
        $publication = Publication::create([
            'title' => $request->title,
            'user_id' => $user_id,
            'message' => $request->message,
            'incident_id' => $request->incident_id,
            'incident_date' => $request->incident_date,
            'incident_time' => $request->incident_time,
            'urgency_id' => $request->urgency_id,
            'anonymous' => $request->anonymous,
            'active' => true,
            'publication_address_id' => $publication_address->id,
            'publication_media' => null,
            'solved' => false,
            'community_id' => $community_id
        ]);

       $this->createPublicationMedia($request, $publication);
        

        return $publication;
    }

    public function createPublicationAddress(Request $request)
    {
       return $publication_address = PublicationAddress::create([
            'public_place' => $request->public_place,
            'number' => $request->number,
            'complement' => $request->complement
        ]);
    }

    public function createPublicationMedia(Request $request, Publication $publication)
    {
        $publication_media = null;
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('img', 'public');
            $publication_media = PublicationMedia::create([
                'path' => $path
            ]);
        };

        if ($publication_media != null) {
            $publication->update([
                'publication_media_id' => $publication_media->id
            ]);
        };

        return $publication_media;
    }

    public function createUserPublication(Publication $publication){
        $user_id = $this->getUserID();
        return $user_publication = UserPublication::create([
            'user_id' => $user_id,
            'publication_id' => $publication->id
        ]);
    }


    public function getUserID()
    {
        $user_id = null;
        if (Auth::guard('users')->check()) {
            return $user_id = Auth::guard('users')->user()->id;
        }

        if (Auth::guard('admin')->check()) {
            return $user_id = Auth::guard('admin')->user()->id;
        }
        return $user_id;
    }
}
