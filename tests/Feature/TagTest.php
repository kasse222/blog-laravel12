<?php

use App\Models\Tag;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use function Pest\Laravel\{deleteJson, postJson, getJson, putJson};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('permet à un utilisateur authentifié de créer un tag', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

   $name = 'VueJS-' . uniqid(); // éviter l'erreur unique

    $response = postJson('/api/tags', [
        'name' => $name,
    ]);

    $response->assertStatus(201)
         ->assertJsonStructure([
             'message',
             'data' => [
                 'id',
                 'name',
                 'created_at',
                 'updated_at',
                 'posts_count',
             ]
         ]);
         
    expect(Tag::where('name', $name)->exists())->toBeTrue();
    
});

it('liste tous les tags', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user); // Authentification Sanctum

    Tag::factory()->count(3)->create();

    $response = getJson('/api/tags');

    $response->assertStatus(200)
             ->assertJsonStructure([
                 'message',
                 'data' => [
                     '*' => ['id', 'name', 'created_at', 'updated_at']
                 ]
             ]);
});

it('affiche un tag spécifique avec ses posts', function () {
    $user = \App\Models\User::factory()->create();
    \Laravel\Sanctum\Sanctum::actingAs($user);

    $tag = \App\Models\Tag::factory()->create();
    $posts = \App\Models\Post::factory()->count(2)->create();
    $tag->posts()->attach($posts->pluck('id'));

    $response = getJson("/api/tags/{$tag->id}");

    $response->assertStatus(200)
    ->assertJsonStructure([
        'data' => [
            'id',
            'name',
            'created_at',
            'updated_at',
            'posts' => [
                '*' => [
                    'id', 'title', 'slug', 'body', 'created_at', 'updated_at'
                ]
            ]
        ]
    ]);
});

it('met à jour un tag', function () {
    $user = \App\Models\User::factory()->create();
    \Laravel\Sanctum\Sanctum::actingAs($user);

    $tag = \App\Models\Tag::factory()->create();

    $newName = 'Updated-' . uniqid();

    $response = putJson("/api/tags/{$tag->id}", [
        'name' => $newName,
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment([
            'name' => $newName,
        ]);

    expect(\App\Models\Tag::find($tag->id)->name)->toBe($newName);
});

it('supprime un tag', function () {
    $user = \App\Models\User::factory()->create();
    \Laravel\Sanctum\Sanctum::actingAs($user);

    $tag = \App\Models\Tag::factory()->create();

    $response = deleteJson("/api/tags/{$tag->id}");

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Tag supprimé avec succès.'
        ]);

    expect(\App\Models\Tag::find($tag->id))->toBeNull();
});
