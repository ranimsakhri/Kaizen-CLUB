<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        // Obliger l’authentification pour toutes les méthodes
        $this->middleware('auth');
    }

    /**
     * ADMIN ONLY
     * Liste des utilisateurs
     */
    public function index()
    {
        abort_if(Auth::user()->role !== 'admin', 403);

        $users = User::all();
        return view('User.index', compact('users'));
    }

    /**
     * ADMIN ONLY
     */
    public function create()
    {
        abort_if(Auth::user()->role !== 'admin', 403);

        return view('User.create');
    }

    /**
     * ADMIN ONLY
     */
    public function store(Request $request)
    {
        abort_if(Auth::user()->role !== 'admin', 403);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,user',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur ajouté avec succès');
    }

    /**
     * SHOW
     * ADMIN ➜ voir tous
     * USER ➜ voir seulement son profil
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        // Si l'utilisateur n'est pas admin et ce n'est pas son propre profil → 403
        if (Auth::user()->role !== 'admin' && Auth::id() != $user->id) {
            abort(403, 'Accès refusé');
        }

        return view('User.show', compact('user'));
    }

    /**
     * EDIT
     * ADMIN ➜ modifier tous
     * USER ➜ modifier seulement son profil
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->role !== 'admin' && Auth::id() != $user->id) {
            abort(403, 'Accès refusé');
        }

        return view('User.edit', compact('user'));
    }

    /**
     * UPDATE
     * ADMIN ➜ modifier tous
     * USER ➜ modifier seulement son profil
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->role !== 'admin' && Auth::id() != $user->id) {
            abort(403, 'Accès refusé');
        }

        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6';
        }

        $request->validate($rules);

        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Si c'est admin → redirige vers liste utilisateurs
        if (Auth::user()->role === 'admin') {
            return redirect()->route('users.index')
                ->with('success', 'Utilisateur modifié avec succès');
        }

        // Si c'est un utilisateur normal → redirige vers son profil
        return redirect()->route('users.show', $user->id)
            ->with('success', 'Profil modifié avec succès');
    }

    /**
     * ADMIN ONLY
     */
    public function destroy(string $id)
    {
        abort_if(Auth::user()->role !== 'admin', 403);

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur supprimé avec succès');
    }
}
