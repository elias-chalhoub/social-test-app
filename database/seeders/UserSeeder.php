<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create()->each(function ($user) {
            $user->followers()->attach([fake()->numberBetween(1, 5)]);
            $user->followers()->attach([fake()->numberBetween(5, 10)]);
            $user->followers()->attach([fake()->numberBetween(10, 20)]);
        });
    }
}
