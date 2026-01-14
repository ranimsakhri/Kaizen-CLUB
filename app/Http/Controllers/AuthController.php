<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Afficher la page login
     */
    public function showLogin()
    {
        // Rediriger si déjà connecté
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }

        return view('Auth.login'); // lowercase 'auth' pour respecter Laravel
    }

    /**
     * Afficher la page register
     */
    public function showRegister()
    {
        // Rediriger si déjà connecté
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }

        return view('Auth.register');
    }

    /**
     * Traitement du login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Le format de l\'email est invalide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return $this->redirectToDashboard();
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->withInput($request->only('email'));
    }

    /**
     * Traitement du register
     */
   public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'is_admin' => false,
    ]);

    auth()->login($user);

    return redirect()->route('user.dashboard');
}


    /**
     * Logout
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            $userName = Auth::user()->name;

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('success', "Au revoir, {$userName} !");
        }

        return redirect()->route('login');
    }

    /**
     * Rediriger vers le dashboard approprié selon le rôle
     */
    private function redirectToDashboard()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Les noms de routes doivent correspondre à ton web.php
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }
}
