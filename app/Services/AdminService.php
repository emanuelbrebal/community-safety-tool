<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function updateAdmin(Request $request, $id)
    {
        $admin = $this->getAdmin($id);

        $password = $admin->password;

        if ($request->password) {
            $password = Hash::make($request->password);
        }

        $path = $admin->profile_picture;
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('img', 'public');
        }

        return $admin->update([
            'first_name' => $request->first_name,
            'surname' => $request->surname,
            'cpf' =>$request->cpf,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => $password,
            'profile_picture' => $path,
            'community_id' => $admin->community_id
        ]);
    }

    public function deactivateAdmin($id)
    {
        $admin = $this->getAdmin($id);
        if ($admin->active) {
            $admin->update([
                'active' => false
            ]);

            return;
        }
        return back()->with('error', 'Administrador já está desativado!');
    }

    public function reactivateAdmin($id)
    {
        $admin = $this->getAdmin($id);
        if (!$admin->active) {
            $admin->update([
                'active' => true
            ]);

            return;
        }
        return back()->with('error', 'Administrador já está ativado!');
    }

    public function getAdmin($id)
    {
        return Admin::with('community')->findOrFail($id);
    }
}
