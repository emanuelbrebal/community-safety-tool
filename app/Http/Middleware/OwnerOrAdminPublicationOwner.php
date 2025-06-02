<?php

namespace App\Http\Middleware;

use App\Models\Publication;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OwnerOrAdminPublicationOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ownerUser = Auth::guard('users')->user();
        $admin = Auth::guard('admin')->user();
        $publication_id = $request->route('id');
        $publication = Publication::findOrFail($publication_id); 

        if ($ownerUser){
            if($ownerUser->id == $publication->user_id ){
                return $next($request);
            }
        }
        if ($admin){
            if($admin->community_id == $publication->community_id){
                return $next($request);
            }
        }
        return redirect()->back()->with('error', 'Você não tem permissão para acessar a esta publicação.');
    }
}
