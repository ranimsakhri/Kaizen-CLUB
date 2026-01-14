<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horaire extends Model
{

    protected $table = 'horaires';
    protected $casts = [
    'date' => 'datetime', // ou 'date' si tu n’as pas besoin de l’heure
];

    protected $fillable = [
        'date',
        'heure_debut',
        'heure_fin',
    ];
}
