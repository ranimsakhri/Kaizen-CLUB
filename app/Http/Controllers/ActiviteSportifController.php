<?php

namespace App\Http\Controllers;

use App\Models\ActiviteSportif;
use Illuminate\Http\Request;

class ActiviteSportifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer toutes les activités sportives
        $activites = ActiviteSportif::all();

        // Afficher la vue index
        return view('ActiviteSportif.index', compact('activites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Afficher le formulaire d'ajout
        return view('ActiviteSportif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'duree' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'capacite' => 'required|integer|min:1',
        ]);

        // Enregistrement dans la base de données
        ActiviteSportif::create([
            'nom' => $request->nom,
            'type' => $request->type,
            'duree' => $request->duree,
            'prix' => $request->prix,
            'capacite' => $request->capacite,
        ]);

        // Redirection après succès
        return redirect()->route('activiteSportif.index')
            ->with('success', 'Activité sportive ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */


    public function show($id)
{
    // Récupérer l'activité par son ID
    $activiteSportif = ActiviteSportif::findOrFail($id);

    // Passer la variable à la vue
    return view('ActiviteSportif.show', compact('activiteSportif'));
}






    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    // Récupérer l'activité depuis la base de données
    $activiteSportif = ActiviteSportif::findOrFail($id);

    // Passer la variable à la vue
    return view('ActiviteSportif.edit', compact('activiteSportif'));
}

    public function update(Request $request, string $id)
    {
        // Validation
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'duree' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'capacite' => 'required|integer|min:1',
        ]);

        // Récupérer l'activité
        $activite = ActiviteSportif::findOrFail($id);

        // Mise à jour
        $activite->update([
            'nom' => $request->nom,
            'type' => $request->type,
            'duree' => $request->duree,
            'prix' => $request->prix,
            'capacite' => $request->capacite,
        ]);

        // Redirection après succès
        return redirect()->route('ActiviteSportif.index')
            ->with('success', 'Activité sportive modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupérer l'activité
        $activite = ActiviteSportif::findOrFail($id);

        // Suppression
        $activite->delete();

        // Redirection
        return redirect()->route('ActiviteSportif.index')
            ->with('success', 'Activité sportive supprimée avec succès');
    }
}
