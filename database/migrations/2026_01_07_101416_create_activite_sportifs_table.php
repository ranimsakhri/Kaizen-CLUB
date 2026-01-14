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
        Schema::create('activite_sportifs', function (Blueprint $table) {
            $table->id();                     // ID automatique
            $table->string('nom');            // Nom de l'activité
            $table->string('type');           // Type de sport (ex: Football, Natation)
            $table->integer('duree');         // Durée en minutes
            $table->decimal('prix', 8, 2);    // Prix si payant
            $table->integer('capacite');      // Capacité maximale
            $table->timestamps();             // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activite_sportifs');
    }
};
