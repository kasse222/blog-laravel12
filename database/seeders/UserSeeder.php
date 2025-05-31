<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Dev',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // ou autre mot de passe sécurisé
                'remember_token' => Str::random(10),
            ]
        );

        User::factory(10)->hasPosts(3)->create();
    }
}
