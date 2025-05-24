<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Http\Controllers\Controller;
use App\Models\PublicationAddress;
use App\Models\PublicationMedia;
use App\Services\PublicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublicationController extends Controller
{

    private $publicationService;

    public function __construct(PublicationService $publication_service)
    {
        $this->publicationService = $publication_service;
    }

    public function createPublication(Request $request)
    {
        
        try {
            DB::beginTransaction();
            $publication = $this->publicationService->createPublication($request);
            $this->publicationService->createUserPublication($publication);
            DB::commit();
            return redirect('redirectHome')->with('success', 'Publicação criada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Algum erro aconteceu ao criar a publicação!' . $e->getMessage());
        };
    }
}
