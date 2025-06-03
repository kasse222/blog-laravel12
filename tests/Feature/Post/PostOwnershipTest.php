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
        ->assertStatus(403); // Forbidden
});
