<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ActiviteSportif;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Afficher toutes les réservations
    public function index()
    {
        $reservations = Reservation::with('activiteSportif')->get();
        return view('Reservation.index', compact('reservations'));
    }

    // Afficher le formulaire pour créer une réservation pour une activité spécifique
    public function create($activite_id)
    {
        $activite = ActiviteSportif::findOrFail($activite_id);
        return view('Reservation.create', compact('activite'));
    }

    // Enregistrer la réservation
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'statut' => 'required|string|max:255',
            'activite_sportif_id' => 'required|exists:activite_sportifs,id', // Validation de l'activité
        ]);

        Reservation::create([
            'date' => $request->date,
            'statut' => $request->statut,
            'activite_sportif_id' => $request->activite_sportif_id,
        ]);

        return redirect()->route('Reservation.index')->with('success', 'Réservation ajoutée avec succès');
    }

    // Afficher une réservation spécifique
    public function show($id)
    {
        $reservation = Reservation::with('activiteSportif')->findOrFail($id);
        return view('Reservation.show', compact('reservation'));
    }

    // Formulaire pour éditer une réservation
    public function edit($id)
    {
        $reservation = Reservation::with('activiteSportif')->findOrFail($id);
        return view('Reservation.edit', compact('reservation'));
    }

    // Mettre à jour la réservation
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'statut' => 'required|string|max:255',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'date' => $request->date,
            'statut' => $request->statut,
        ]);

        return redirect()->route('Reservation.index')->with('success', 'Réservation modifiée avec succès');
    }

    // Supprimer une réservation
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('Reservation.index')->with('success', 'Réservation supprimée avec succès');
    }
}
