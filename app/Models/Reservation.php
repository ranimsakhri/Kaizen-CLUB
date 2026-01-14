<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $fillable = [
        'date',
        'statut',
        'activite_sportif_id'
    ];

    public function activiteSportif()
    {
        return $this->belongsTo(\App\Models\ActiviteSportif::class);
    }
}
