<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedBigInteger('activite_sportif_id')->after('id');
            $table->foreign('activite_sportif_id')->references('id')->on('activite_sportifs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['activite_sportif_id']);
            $table->dropColumn('activite_sportif_id');
        });
    }
};
