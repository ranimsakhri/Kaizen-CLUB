<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('commandes', function (Blueprint $table) {
            if (!Schema::hasColumn('commandes', 'statut')) {
                $table->string('statut')->default('En attente')->after('total');
            }
            if (!Schema::hasColumn('commandes', 'details')) {
                $table->json('details')->nullable()->after('statut');
            }
        });
    }

    public function down()
    {
        Schema::table('commandes', function (Blueprint $table) {
            if (Schema::hasColumn('commandes', 'statut')) {
                $table->dropColumn('statut');
            }
            if (Schema::hasColumn('commandes', 'details')) {
                $table->dropColumn('details');
            }
        });
    }
};
