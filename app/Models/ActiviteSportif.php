<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
     // Relation avec les réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
