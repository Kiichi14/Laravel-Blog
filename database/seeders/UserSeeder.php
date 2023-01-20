<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i < 2; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => bcrypt('users123'),
                'role'=> 'user',
            ]);
        }
    }
}
