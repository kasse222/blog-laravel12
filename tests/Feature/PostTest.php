<?php

use function Pest\Laravel\actingAs;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('affiche la liste des posts pour un utilisateur connecté', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);
    Post::factory()->count(3)->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->getJson('/api/posts');


    $response->assertStatus(200)
             ->assertJsonCount(3); // Vérifie qu'on a bien 3 posts
});

it('crée un post pour un utilisateur authentifié', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $payload = [
        'title' => 'Nouveau Post',
        'content' => 'Contenu du post',
    ];

    $response = $this->actingAs($user)->postJson('/api/posts', $payload);

    $response->assertStatus(201)
             ->assertJsonPath('data.title', 'Nouveau Post');

});