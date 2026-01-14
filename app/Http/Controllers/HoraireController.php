<?php

namespace App\Http\Controllers;

use App\Models\Horaire;
use Illuminate\Http\Request;

class HoraireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer tous les horaires
        $horaires = Horaire::all();

        // Afficher la liste
        return view('Horaire.index', compact('horaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Afficher le formulaire d'ajout
        return view('Horaire.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
        ]);

        // Enregistrer l'horaire
        Horaire::create([
            'date' => $request->date,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
        ]);

        // Redirection
        return redirect()->route('horaires.index')
            ->with('success', 'Horaire ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer un horaire par ID
        $horaire = Horaire::findOrFail($id);

        // Afficher les détails
        return view('Horaire.show', compact('horaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupérer l'horaire à modifier
        $horaire = Horaire::findOrFail($id);

        // Afficher le formulaire de modification
        return view('Horaire.edit', compact('horaire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation
        $request->validate([
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
        ]);

        // Récupérer l'horaire
        $horaire = Horaire::findOrFail($id);

        // Mise à jour
        $horaire->update([
            'date' => $request->date,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
        ]);

        // Redirection
        return redirect()->route('Horaire.index')
            ->with('success', 'Horaire modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupérer l'horaire
        $horaire = Horaire::findOrFail($id);

        // Suppression
        $horaire->delete();

        // Redirection
        return redirect()->route('Horaire.index')
            ->with('success', 'Horaire supprimé avec succès');
    }
}
