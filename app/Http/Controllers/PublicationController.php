<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Http\Controllers\Controller;
use App\Models\PublicationAddress;
use App\Models\PublicationMedia;
use App\Services\PublicationService;
use App\Services\UpdatePublicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublicationController extends Controller
{

    private $publicationService;
    private $updatePublicationService;

    public function __construct(PublicationService $publication_service, UpdatePublicationService $update_publication_service)
    {
        $this->publicationService = $publication_service;
        $this->updatePublicationService = $update_publication_service;
    }

    public function createPublication(Request $request)
    {
        try {
            DB::beginTransaction();
            $publication = $this->publicationService->createPublication($request);
            $this->publicationService->createUserPublication($publication);
            DB::commit();
            return redirect()->route('redirectHome')->with('success', 'Publicação criada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Algum erro aconteceu ao criar a publicação!' . $e->getMessage());
        };
    }

    public function updatePublication(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->updatePublicationService->updatePublication($request, $id);
            DB::commit();
            return redirect('redirectHome')->with('success', 'Publicação editada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Algum erro aconteceu ao editar a publicação!');
        };
    }

    public function deactivatePublication($id)
    {
        try {
            DB::beginTransaction();
            $this->publicationService->deactivatePublication($id);
            DB::commit();
            return back()->with('success', 'Publicação desativada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Algum erro aconteceu ao tentar desativar a publicação!');
        };
    }


    public function reactivatePublication($id)
    {
        try {
            DB::beginTransaction();
            $this->publicationService->reactivatePublication($id);
            DB::commit();
            return back()->with('success', 'Publicação ativada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Algum erro aconteceu ao criar a desativar a publicação!');
        };
    }

    public function contactAuthorities($id)
    {
        try {
            DB::beginTransaction();
            $this->publicationService->contactAuthorities($id);
            DB::commit();
            return back()->with('success', 'Publicação resolvida com sucesso! Aguarde as ações das Autoridades!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Publicação já foi resolvida! Aguarde as ações das Autoridades!');
        };
    }

}
