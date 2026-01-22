<?php

namespace App\Http\Controllers;

use App\Models\Horaire;
use App\Models\ActiviteSportif;
use Illuminate\Http\Request;

class HoraireController extends Controller
{
    public function __construct()
    {
        // Obliger l'authentification
        $this->middleware('auth');

        // Seuls les admins peuvent créer, éditer ou supprimer un horaire
        $this->middleware('is_admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Affiche la liste des horaires par activité
     */
    public function index()
    {
        // Récupérer toutes les activités avec leurs horaires
        $activites = ActiviteSportif::with('horaires')->get();

        return view('Horaire.index', compact('activites'));
    }

    /**
     * Formulaire création d'un horaire
     */
    public function create(ActiviteSportif $activiteSportif)
    {
        return view('Horaire.create', compact('activiteSportif'));
    }

    /**
     * Enregistrement d'un nouvel horaire
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'activite_sportif_id' => 'required|exists:activite_sportifs,id',
            'date' => 'required|date',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
        ]);

        // Création de l'horaire
        Horaire::create($request->only('activite_sportif_id', 'date', 'heure_debut', 'heure_fin'));

        return redirect()->route('activiteSportif.show', $request->activite_sportif_id)
            ->with('success', 'Horaire ajouté avec succès');
    }

    /**
     * Formulaire édition d'un horaire
     */
    public function edit(Horaire $horaire)
    {
        $activiteSportif = $horaire->activiteSportif;
        return view('Horaire.edit', compact('horaire', 'activiteSportif'));
    }

    /**
     * Mise à jour d'un horaire
     */
    public function update(Request $request, Horaire $horaire)
    {
        $request->validate([
            'date' => 'required|date',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
        ]);

        $horaire->update($request->only('date', 'heure_debut', 'heure_fin'));

        return redirect()->route('activiteSportif.show', $horaire->activite_sportif_id)
            ->with('success', 'Horaire modifié avec succès');
    }

    /**
     * Suppression d'un horaire
     */
    public function destroy(Horaire $horaire)
    {
        $activiteId = $horaire->activite_sportif_id;
        $horaire->delete();

        return redirect()->route('activiteSportif.show', $activiteId)
            ->with('success', 'Horaire supprimé avec succès');
    }
}
