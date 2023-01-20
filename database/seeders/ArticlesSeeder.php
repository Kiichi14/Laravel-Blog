<?php

namespace Database\Seeders;

use App\Models\articles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {
        for($i=0; $i < 30; $i++) {
            articles::create([
                'title' => $faker->sentence(4),
                'description' => $faker->sentence(5),
                'content' => $faker->text,
                'user_id'=>rand(1, 2),
                'published_at'=>$faker->date('Y_m_d')
            ])->categories()->attach([
                rand(1, 5),
            ]);
        }
    }
}
