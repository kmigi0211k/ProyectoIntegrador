<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $person = \App\Models\Person::where('email', $request->email)->first();

        if (!$person) {
            return back()->withInput($request->only('email'))
                         ->withErrors(['email' => 'No encontramos a ningún usuario con ese correo electrónico.']);
        }

        // Generar el token manualmente
        $token = \Illuminate\Support\Str::random(60);
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => \Illuminate\Support\Facades\Hash::make($token),
                'created_at' => now()
            ]
        );

        // Enviar el correo real usando el sistema de notificaciones de Laravel
        $person->user->notify(new \Illuminate\Auth\Notifications\ResetPassword($token));

        return back()->with('status', 'Hemos enviado un enlace de recuperación a tu correo electrónico.');
    }
}
