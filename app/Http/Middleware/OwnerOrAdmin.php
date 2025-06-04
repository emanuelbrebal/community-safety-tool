<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Publication;
use App\Models\User;
use App\Services\UserService;
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
    $userIdToUpdate = $request->route('id'); 

    if (Auth::guard('admin')->check()) {
        $loggedAdmin = Auth::guard('admin')->user();

        $userToUpdate = Admin::findOrFail($userIdToUpdate);

        if ($loggedAdmin->community_id === $userToUpdate->community_id) {
            return $next($request);
        }
    }

    if (Auth::guard('users')->check()) {
        $loggedUser = Auth::guard('users')->user();
        $userToUpdate = User::findOrFail($userIdToUpdate);

        if ($loggedUser->id === $userToUpdate->id) {
            return $next($request);
        }
    }

    return redirect()->back()->with('error', 'Você não tem permissão para acessar esta página.');
}
}
