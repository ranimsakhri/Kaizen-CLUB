<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    // Affiche toutes les commandes selon le rôle
    public function index()
{
    $user = Auth::user();

    if ($user->role === 'admin') {
        // L'admin voit toutes les commandes
        $commandes = Commande::with('user')->get();
    } else {
        // L'utilisateur normal ne voit que ses commandes
        $commandes = Commande::with('user')
                              ->where('user_id', $user->id)
                              ->get();
    }

    return view('Commande.index', compact('commandes', 'user'));
}


    // Formulaire pour passer une commande depuis un produit
 public function create($produitId = null)
{
    $produits = Produit::all(); // récupérer tous les produits
    $categories = Categorie::all(); // récupérer toutes les catégories

    return view('Commande.create', compact('produits', 'categories'));
}



    // Enregistrer une nouvelle commande
    public function store(Request $request)
    {
        $request->validate([
            'produits' => 'required|array',
            'produits.*.id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
            'adresse' => 'nullable|string',
        ]);

        $produitsSelectionnes = [];
        foreach ($request->produits as $p) {
            if (!empty($p['selected'])) {
                $produit = Produit::find($p['id']);
                $produitsSelectionnes[] = [
                    'id' => $produit->id,
                    'nom' => $produit->nom,
                    'prix' => $produit->prix,
                    'quantite' => $p['quantite'],
                ];
            }
        }

        if (empty($produitsSelectionnes)) {
            return redirect()->back()->withErrors('Veuillez sélectionner au moins un produit.');
        }

        $total = array_reduce($produitsSelectionnes, fn($sum, $p) => $sum + ($p['prix'] * $p['quantite']), 0);

        $livraison = $request->has('livraison') && $request->livraison == 1;
        $adresse = $livraison ? $request->adresse : null;

        if ($livraison) {
            $total += 8.60;
        }

        Commande::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'details' => json_encode($produitsSelectionnes),
            'statut' => 'en attente',
            'livraison' => $livraison,
            'adresse' => $adresse,
        ]);

        return redirect()->route('commandes.index')
                         ->with('success', 'Commande ajoutée avec succès !');
    }

    // Affiche une commande spécifique
    public function show($id)
    {
        $commande = Commande::findOrFail($id);

        if (Auth::user()->role !== 'admin' && Auth::id() !== $commande->user_id) {
            abort(403, 'Accès refusé');
        }

        $produits = is_string($commande->details) ? json_decode($commande->details, true) : $commande->details;

        return view('Commande.show', compact('commande', 'produits'));
    }

    // Formulaire pour modifier une commande (admin seulement)
    public function edit($id)
    {
        $commande = Commande::findOrFail($id);

        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('Commande.edit', compact('commande'));
    }

    // Mettre à jour une commande (statut seulement)
    public function update(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);

        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'statut' => 'required|string|in:en attente,confirmée,livrée,annulée',
        ]);

        $commande->update([
            'statut' => $request->statut,
        ]);

        return redirect()->route('commandes.show', $commande->id)
                         ->with('success', 'Commande mise à jour avec succès');
    }

    // Supprimer une commande (admin seulement)
    public function destroy($id)
    {
        $commande = Commande::findOrFail($id);

        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $commande->delete();

        return redirect()->route('commandes.index')
                         ->with('success', 'Commande supprimée avec succès');
    }
}
