<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    /**
     * Liste des produits par catégorie (ADMIN + USER)
     */
    public function index()
    {
        // Charger toutes les catégories avec leurs produits
        $categories = Categorie::with('produits')->get();

        return view('Produit.index', compact('categories'));
    }

    /**
     * Formulaire d'ajout (ADMIN SEULEMENT)
     */
    public function create()
    {
        $this->authorizeAdmin();

        // Charger toutes les catégories pour le select
        $categories = Categorie::all();

        return view('Produit.create', compact('categories'));
    }

    /**
     * Enregistrement (ADMIN SEULEMENT)
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $this->validateProduit($request);

        Produit::create($request->only('nom', 'prix', 'categorie_id'));

        return redirect()
            ->route('produit.index')
            ->with('success', 'Produit ajouté avec succès');
    }

    /**
     * Détails produit (ADMIN + USER)
     */
    public function show($id)
    {
        // Charger le produit avec sa catégorie
        $produit = Produit::with('categorie')->findOrFail($id);

        return view('Produit.show', compact('produit'));
    }

    /**
     * Formulaire édition (ADMIN SEULEMENT)
     */
    public function edit($id)
    {
        $this->authorizeAdmin();

        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();

        return view('Produit.edit', compact('produit', 'categories'));
    }

    /**
     * Mise à jour (ADMIN SEULEMENT)
     */
    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $this->validateProduit($request);

        $produit = Produit::findOrFail($id);
        $produit->update($request->only('nom', 'prix', 'categorie_id'));

        return redirect()
            ->route('produit.index')
            ->with('success', 'Produit modifié avec succès');
    }

    /**
     * Suppression (ADMIN SEULEMENT)
     */
    public function destroy($id)
    {
        $this->authorizeAdmin();

        Produit::findOrFail($id)->delete();

        return redirect()
            ->route('produit.index')
            ->with('success', 'Produit supprimé avec succès');
    }

    /**
     * Vérification ADMIN
     */
    private function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Accès refusé');
        }
    }

    /**
     * Validation des produits
     */
    private function validateProduit(Request $request)
    {
        $request->validate([
            'nom'          => 'required|string|max:255',
            'prix'         => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id', // obligatoire pour le menu
        ]);
    }
}
