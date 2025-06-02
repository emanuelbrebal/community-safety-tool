<?php

namespace App\Services;

use App\Models\Publication;
use App\Models\PublicationMedia;
use App\Models\PublicationAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;


class UpdatePublicationService
{
    private $publicationService;

    public function __construct(PublicationService $publication_service)
    {
        $this->publicationService = $publication_service;
    }

    public function updatePublication(Request $request, $id)
    {
        $publication = $this->publicationService->getPublicationById($id);

        $publication->update([
            'title' => $request->title,
            'message' => $request->message,
            'anonymous' => $request->anonymous,
            'incident_date' => $request->incident_date,
            'incident_time' => $request->incident_time,
        ]);

        $this->updatePublicationAddress($request, $publication);

        $this->updatePublicationMedia($request, $publication);

        return $publication;
    }

    public function updatePublicationAddress(Request $request, Publication $publication)
    {
        $publication_address = $this->getPublicationAddress($publication);
        $publication_address->update([
            'public_place' => $request->public_place,
            'number' => $request->number,
            'complement' => $request->complement
        ]);
        return $publication_address;
    }

    public function updatepublicationMedia(Request $request, Publication $publication) {
        
        $publication_media = $this->getPublicationMedia($publication);
        
        if($request->hasFile('image')){
            $path = $request->file('image')->store('img', 'public');
            $publication_media->update([
                'path' => $path
            ]);
            
        }
        return $publication_media;
    }

    public function getPublicationId(Publication $publication){
        return $publication->id;
    }

    public function getPublicationAddress(Publication $publication) {
        $publication_id = $this->getPublicationId($publication);
        return $publication_address = PublicationAddress::where('publication_id', $publication_id)->first();
    }
    public function getPublicationMedia(Publication $publication) {
        $publication_id = $this->getPublicationId($publication);
        return $publication_media = PublicationMedia::where('publication_id', $publication_id)->first();
    }
}
