<?php

use App\Models\Tag;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use function Pest\Laravel\{postJson, getJson};

it('permet à un utilisateur authentifié de créer un tag', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = postJson('/api/tags', [
        'name' => 'VueJS'
    ]);

    $response->assertStatus(201)
         ->assertJsonStructure([
             'message',
             'data' => [
                 'id',
                 'name',
                 'created_at',
                 'updated_at',
                 'posts_count', // ✅ correspond au TagResource
             ]
         ]);

    expect(Tag::where('name', 'VueJS')->exists())->toBeTrue();
});

it('liste tous les tags', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    Tag::factory()->count(3)->create();

    $response = getJson('/api/tags');

    $response->assertOk()
             ->assertJsonStructure([
                 'message',
                 'data' => [
                     '*' => ['id', 'name', 'created_at', 'updated_at']
                 ]
             ]);
});
