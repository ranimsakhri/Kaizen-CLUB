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
        // Obliger l’authentification
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
     * ADMIN ➜ voir tous
     * USER ➜ voir seulement son profil
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->role !== 'admin' && Auth::id() != $user->id) {
            abort(403);
        }

        return view('User.show', compact('user'));
    }

    /**
     * ADMIN ONLY
     */
    public function edit(string $id)
    {
        abort_if(Auth::user()->role !== 'admin', 403);

        $user = User::findOrFail($id);
        return view('User.edit', compact('user'));
    }

    /**
     * ADMIN ONLY
     */
    public function update(Request $request, string $id)
    {
        abort_if(Auth::user()->role !== 'admin', 403);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);

        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:6',
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur modifié avec succès');
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
