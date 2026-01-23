<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ActiviteSportif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Afficher toutes les réservations
     */
    public function index()
    {
        if (auth()->user()->is_admin) {
            // Admin : toutes les réservations avec relations
            $reservations = Reservation::with('activiteSportif', 'user')->latest()->get();
        } else {
            // User : uniquement ses propres réservations
            $reservations = Reservation::with('activiteSportif')
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        return view('Reservation.index', compact('reservations'));
    }

    /**
     * Afficher le formulaire de création de réservation pour une activité
     */
    public function create($activite_id)
    {
        $activite = ActiviteSportif::findOrFail($activite_id);

        // Vérification si l'activité est complète
        if ($activite->reservations()->count() >= $activite->capacite) {
            return redirect()->route('activiteSportif.index')
                ->with('error', 'Désolé, cette activité est complète. Aucune place disponible.');
        }

        return view('Reservation.create', compact('activite'));
    }

    /**
     * Enregistrer une nouvelle réservation
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'statut' => 'required|in:en attente,confirmée,annulée',
            'activite_sportif_id' => 'required|exists:activite_sportifs,id',
        ]);

        $activite = ActiviteSportif::findOrFail($request->activite_sportif_id);

        // Vérification serveur finale (même si déjà vérifié dans create)
        if ($activite->reservations()->count() >= $activite->capacite) {
            return redirect()->back()
                ->with('error', 'Désolé, l\'activité est maintenant complète. Réservation impossible.');
        }

        Reservation::create([
            'date' => $request->date,
            'statut' => $request->statut,
            'activite_sportif_id' => $request->activite_sportif_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('Reservation.index')
            ->with('success', 'Réservation ajoutée avec succès !');
    }

    /**
     * Afficher les détails d'une réservation
     */
    public function show($id)
    {
        $reservation = Reservation::with('activiteSportif', 'user')->findOrFail($id);

        // Sécurité : seul l'admin ou le propriétaire peut voir
        if (!auth()->user()->is_admin && $reservation->user_id !== auth()->id()) {
            abort(403, "Vous n'avez pas accès à cette réservation.");
        }

        return view('Reservation.show', compact('reservation'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        $reservation = Reservation::with('activiteSportif')->findOrFail($id);

        if (!auth()->user()->is_admin && $reservation->user_id !== auth()->id()) {
            abort(403, "Vous n'avez pas accès à cette réservation.");
        }

        return view('Reservation.edit', compact('reservation'));
    }

    /**
     * Mettre à jour une réservation
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        if (!auth()->user()->is_admin && $reservation->user_id !== auth()->id()) {
            abort(403, "Vous n'avez pas accès à cette réservation.");
        }

        $request->validate([
            'date' => 'required|date',
            'statut' => 'required|in:en attente,confirmée,annulée',
        ]);

        $reservation->update($request->only(['date', 'statut']));

        return redirect()->route('Reservation.index')
            ->with('success', 'Réservation modifiée avec succès');
    }

    /**
     * Supprimer une réservation
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        if (!auth()->user()->is_admin && $reservation->user_id !== auth()->id()) {
            abort(403, "Vous n'avez pas accès à cette réservation.");
        }

        $reservation->delete();

        return redirect()->route('Reservation.index')
            ->with('success', 'Réservation supprimée avec succès');
    }
}
