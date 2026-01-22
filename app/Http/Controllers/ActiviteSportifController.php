<?php

namespace App\Http\Controllers;

use App\Models\ActiviteSportif;
use Illuminate\Http\Request;

class ActiviteSportifController extends Controller
{
    public function __construct()
    {
        // Seules les actions admin sont protégées
        $this->middleware('is_admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Afficher toutes les activités (accessible aux utilisateurs normaux)
     */
    public function index()
    {
        $activites = ActiviteSportif::with('horaires')->get();
        return view('ActiviteSportif.index', compact('activites'));
    }

    /**
     * Afficher le détail d'une activité (accessible aux utilisateurs normaux)
     */
  public function show($id)
{
    $activiteSportif = ActiviteSportif::with('horaires')->findOrFail($id);

    // Vérifier si la capacité est atteinte
    $nbParticipants = $activiteSportif->reservations()->count();

    if($nbParticipants >= $activiteSportif->capacite) {
        // Redirection avec message d'erreur
        return redirect()->route('activiteSportif.index')
                         ->with('error', 'Cette activité a atteint le nombre maximum de participants.');
    }

    $activites = ActiviteSportif::all(); // récupère toutes les activités pour l'affichage
    return view('ActiviteSportif.show', compact('activiteSportif', 'activites'));
}



    /**
     * Créer une activité (admin)
     */
    public function create()
    {
        return view('ActiviteSportif.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'duree' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'capacite' => 'required|integer|min:1',
        ]);

        ActiviteSportif::create($request->all());

        return redirect()->route('activiteSportif.index')
                         ->with('success', 'Activité sportive ajoutée avec succès');
    }

    /**
     * Modifier une activité (admin)
     */
    public function edit($id)
    {
        $activiteSportif = ActiviteSportif::findOrFail($id);
        return view('ActiviteSportif.edit', compact('activiteSportif'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'duree' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'capacite' => 'required|integer|min:1',
        ]);

        $activite = ActiviteSportif::findOrFail($id);
        $activite->update($request->all());

        return redirect()->route('activiteSportif.index')
                         ->with('success', 'Activité sportive modifiée avec succès');
    }

    /**
     * Supprimer une activité (admin)
     */
    public function destroy($id)
    {
        $activite = ActiviteSportif::findOrFail($id);
        $activite->delete();

        return redirect()->route('activiteSportif.index')
                         ->with('success', 'Activité sportive supprimée avec succès');
    }
}
