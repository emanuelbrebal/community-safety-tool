<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Http\Controllers\Controller;
use App\Models\PublicationAddress;
use App\Models\PublicationMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublicationController extends Controller
{
    public function createPublication(Request $request)
    {
        // $user = Auth::guard('users')->user();
        // dd($user);
        // fazer o model de user_publications e utilizar o id de $user e $publication

        try {
            DB::beginTransaction();

            $user_id = Auth::guard('users')->user()->id;
            
            $publication_address = PublicationAddress::create([
                'public_place' => $request->public_place,
                'number' => $request->number,
                'complement' => $request->complement
            ]);

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
            ]);
            
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
                $publication->save();
            };
            

            DB::commit();

            return redirect('redirectHome')->with('success', 'Publicação criada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Algum erro aconteceu ao criar a publicação!');
        };
    }
}
