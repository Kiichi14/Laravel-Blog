<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Technologie',
            'slug' => 'technologie'
        ]);
        Category::create([
            'name' => 'Evenement',
            'slug' => 'evenement'
        ]);
        Category::create([
            'name' => 'Actualités',
            'slug' => 'actualites'
        ]);
        Category::create([
            'name' => 'Jeux Video',
            'slug' => 'jeux video'
        ]);
        Category::create([
            'name' => 'Musique',
            'slug' => 'musique'
        ]);
    }
}
