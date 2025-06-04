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

    public function getPublicationById($id)
    {
        return $publication = Publication::with(['user', 'address', 'media', 'urgency', 'media', 'community'])->findOrFail($id);
    }

    public function createPublication(Request $request)
    {
        
        $user_id = $this->userService->getUserID();

        $community_id = $this->userService->getUserCommunityID($user_id);

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
            'solved' => false,
            'community_id' => $community_id
        ]);

        $this->createPublicationAddress($request, $publication, $community_id);
        $this->createPublicationMedia($request, $publication);

        return $publication;
    }

    public function createPublicationAddress(Request $request, Publication $publication, $community_id)
    {
        return $publication_address = PublicationAddress::create([
            'publication_id' => $publication->id,
            'public_place' => $request->public_place,
            'number' => $request->number,
            'complement' => $request->complement,
            'community_id' => $community_id
        ]);
    }

    public function createPublicationMedia(Request $request, Publication $publication)
    {
        $publication_media = null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('img', 'public');
            $publication_media = PublicationMedia::create([
                'publication_id' => $publication->id,
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

    public function createUserPublication(Publication $publication)
    {
        $user_id = $this->userService->getUserID();
        return $user_publication = UserPublication::create([
            'user_id' => $user_id,
            'publication_id' => $publication->id
        ]);
    }

    public function deactivatePublication($id)
    {
        $publication = $this->getPublicationById($id);
        if ($publication->active) {
            $publication->update([
                'active' => false
            ]);
            return redirect()->route('redirectHome')->with('success', 'Publicação desativada com sucesso!');
        }
        return back()->with('error', 'Publicação já está desativada!');
    }

    public function reactivatePublication($id)
    {
        $publication = $this->getPublicationById($id);
        if (!$publication->active) {
            $publication->update([
                'active' => true
            ]);
            return redirect()->route('redirectHome')->with('success', 'Publicação ativada com sucesso!');
        }
        return back()->with('error', 'Publicação já está ativada!');
    }

    public function getRelevantPublications($community_id)
    {
        return Publication::with('user', 'incident', 'urgency', 'media', 'address', 'community')
            ->where('community_id', $community_id)
            ->where('active', true)
            ->where('created_at', '>=', Carbon::now()->subMonth())
            ->orderBy('urgency_id', 'desc')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function contactAuthorities($id){
        $publication = $this->getPublicationById($id); 
        if ($publication->solved == false){
            return $publication->update(['solved' => true]);
        }
        return back()->with('error', 'Denúncia já resolvida! Autoridades à caminho!');
    }
}
