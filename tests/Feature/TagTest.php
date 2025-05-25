<?php

use App\Models\Tag;
use App\Models\User;
use function Pest\Laravel\{actingAs, postJson, getJson};

it('permet à un utilisateur authentifié de créer un tag', function () {
    $user = User::factory()->create();

    $response = actingAs($user)->postJson('/api/tags', [
        'name' => 'VueJS'
    ]);

    $response->assertStatus(201)
             ->assertJsonStructure(['message', 'tag' => ['id', 'name']]);

    expect(Tag::where('name', 'VueJS')->exists())->toBeTrue();
});

it('liste tous les tags', function () {
    $user = User::factory()->create();
    Tag::factory()->count(3)->create();

    $response = actingAs($user)->getJson('/api/tags');

    $response->assertStatus(200)
             ->assertJsonIsArray();
});
