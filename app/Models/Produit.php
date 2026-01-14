<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    // Colonnes que l'on peut remplir via create() ou update()
    protected $fillable = [
        'nom',
        'prix',
        'categorie_id', // la clé étrangère vers la catégorie
    ];

    /**
     * Relation avec la catégorie
     * Un produit appartient à une seule catégorie
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
