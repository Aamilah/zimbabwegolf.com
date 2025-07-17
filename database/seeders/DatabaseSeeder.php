<?php

namespace Database\Seeders;

use App\Models\Tournaments;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::truncate();

        User::create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => bcrypt('password'),
            'department' => 'staff',
        ]);

        User::create([
            'name' => 'Player User',
            'email' => 'player@example.com',
            'password' => bcrypt('password'),
            'department' => 'player',
        ]);

        User::create([
            'name' => 'Official User',
            'email' => 'official@example.com',
            'password' => bcrypt('password'),
            'department' => 'tournament_official',
        ]);

    }
}
