<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['nom' => 'Boissons chaudes', 'icone' => '☕', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Boissons froides', 'icone' => '🥤', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Petit-déjeuner', 'icone' => '🥐', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Déjeuner', 'icone' => '🍝', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Desserts', 'icone' => '🍰', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Snacks', 'icone' => '🍟', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
