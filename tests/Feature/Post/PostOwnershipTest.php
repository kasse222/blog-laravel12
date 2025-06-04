<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('un utilisateur peut supprimer son propre post', function () {
    $user = User::factory()->create();
    $post = Post::factory()->for($user)->create();

    $this->actingAs($user, 'sanctum')
        ->deleteJson("/api/posts/{$post->id}")
        ->assertStatus(200)
        ->assertJson(['message' => 'Article supprimé avec succès']);
});

test('un utilisateur ne peut pas supprimer le post d’un autre', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    $post = Post::factory()->for($owner)->create();

    $this->actingAs($other, 'sanctum')
        ->deleteJson("/api/posts/{$post->id}")
        ->assertStatus(403); // Interdiction de SUPPRIMER
});

it('rejette la modification d’un post par un autre utilisateur', function () {
    $owner = \App\Models\User::factory()->create();
    $other = \App\Models\User::factory()->create();
    $post = \App\Models\Post::factory()->for($owner)->create();

    $payload = [
        'title' => 'Tentative de modif',
        'content' => 'Contenu modifié',
    ];

    $this->actingAs($other, 'sanctum')
        ->putJson("/api/posts/{$post->id}", $payload)
        ->assertStatus(403); // Interdiction de MODIFIER
});

test('un utilisateur ne peut pas modifier le post d’un autre', function () {
    $owner = \App\Models\User::factory()->create();
    $other = \App\Models\User::factory()->create();

    $post = \App\Models\Post::factory()->for($owner)->create([
        'title' => 'Titre original',
        'content' => 'Contenu original',
    ]);

    $payload = [
        'title' => 'Titre modifié',
        'content' => 'Contenu modifié',
    ];

    $this->actingAs($other, 'sanctum')
        ->putJson("/api/posts/{$post->id}", $payload)
        ->assertStatus(403) // Forbidden
        ->assertJson([
            'message' => 'This action is unauthorized.'
        ]);
});
