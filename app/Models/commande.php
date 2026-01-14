<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commande extends Model
{
    protected $table = 'commandes';
  protected $fillable = [
    'user_id',
    'total',
    'details',
    'statut',
];


    // Relation avec l’utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accesseur pour récupérer les produits décodés
    public function getDetailsAttribute($value)
    {
        return json_decode($value, true);
    }
}
