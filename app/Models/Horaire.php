<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horaire extends Model
{


    protected $table = 'horaires';

    protected $casts = [
        'date' => 'date', // ou 'datetime'
    ];

    protected $fillable = [
        'activite_sportif_id',
        'date',
        'heure_debut',
        'heure_fin',
    ];

    public function activite()
    {
        return $this->belongsTo(ActiviteSportif::class, 'activite_sportif_id');
    }
}



