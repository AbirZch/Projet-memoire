<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\error;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'], 
        ]);
        $rememberMe=false;
        if ($request->has('remember')) $rememberMe=true;
        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();
            $user=Auth::user();
            if ($user->role === "admin") return redirect('/admin');
            if ($user->role === "teacher") return redirect("/teachers/me");
            if ( !isset($user->email_verified_at ) )
            {
                return redirect('/email/verify');
            }
            else  return redirect('/me');
           
        }
        Log::error('log in error');

        return redirect('/')->withErrors([
            'email' => 'Votre email ou mot de passe est incorrect. Veuillez le vérifier.',
        ])->onlyInput('email');
    }


    /**
     * Log the user out of the application.
     */
}
