<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function adminIndex()
    {
        // Solo el admin puede ver esto
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $users = User::with('person')->orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function toggleAdmin(User $user)
    {
        // Evitar quitarse el admin a uno mismo
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'No puedes quitarte el permiso de administrador a ti mismo.');
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        return redirect()->back()->with('success', 'Rol de usuario actualizado correctamente.');
    }
}
