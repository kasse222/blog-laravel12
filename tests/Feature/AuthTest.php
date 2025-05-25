<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\postJson;

it('crée un utilisateur via l’API register', function () {
    $response = postJson('/api/register', [
        'name' => 'Lamine Test',
        'email' => 'lamine.register@example.com',
        'password' => 'secret123',
        'password_confirmation' => 'secret123',
    ]);

    $response->assertStatus(201)
             ->assertJsonStructure([
                'user' => ['id', 'name', 'email', 'created_at', 'updated_at'],
                'token'
             ]);

    expect(User::where('email', 'lamine.register@example.com')->exists())->toBeTrue();
});


it('connecte un utilisateur via l’API login', function () {
    // Préparation d’un utilisateur existant
    $user = User::factory()->create([
        'email' => 'lamine.login@example.com',
        'password' => Hash::make('secret123'),
    ]);

    // Envoi de la requête de login
    $response = postJson('/api/login', [
        'email' => 'lamine.login@example.com',
        'password' => 'secret123',
    ]);

    // Vérifications
    $response->assertStatus(200)
             ->assertJsonStructure([
                 'user' => ['id', 'name', 'email', 'created_at', 'updated_at'],
                 'token'
             ]);
});
