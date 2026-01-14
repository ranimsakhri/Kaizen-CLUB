<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horaires', function (Blueprint $table) {
            $table->id();                   // id auto-incrémenté
            $table->date('date');           // date de l'horaire
            $table->time('heure_debut');    // heure de début
            $table->time('heure_fin');      // heure de fin
            $table->timestamps();           // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horaires');
    }
};
