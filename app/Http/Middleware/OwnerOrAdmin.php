<?php

namespace App\Http\Middleware;

use App\Models\Publication;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OwnerOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $loggedUser = Auth::guard('users')->user();
        $loggedAdmin = Auth::guard('admin')->user();
        
        $userIdToUpdate = $request->route('id'); 
        $userToUpdate = User::findOrFail($userIdToUpdate);
        
        if ($loggedAdmin && $loggedAdmin->community_id == $userToUpdate->community_id) {
            return $next($request);
        }
        
        if ($loggedUser && $loggedUser->id == $userToUpdate->id) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'Você não tem permissão para acessar esta página.');
    }
}
