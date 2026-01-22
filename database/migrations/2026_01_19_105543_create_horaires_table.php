<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activite_sportif_id'); // Clé étrangère
            $table->string('jour'); // ex: Lundi
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->timestamps();

            // Définir la relation
            $table->foreign('activite_sportif_id')
                  ->references('id')
                  ->on('activite_sportifs')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horaires');
    }
};
