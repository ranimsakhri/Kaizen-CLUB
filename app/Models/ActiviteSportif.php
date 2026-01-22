<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActiviteSportif extends Model
{
    protected $table = 'activite_sportifs';

    protected $fillable = [
        'nom',
        'type',
        'duree',
        'prix',
        'capacite',
    ];

    /**
     * Relation avec les réservations
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'activite_sportif_id', 'id');
    }

    /**
     * Relation avec les horaires
     */
    public function horaires(): HasMany
    {
        return $this->hasMany(Horaire::class, 'activite_sportif_id', 'id');
    }
}
