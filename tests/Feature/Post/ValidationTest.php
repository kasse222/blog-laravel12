<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('rejette la création de post sans données obligatoires', function () {
    $user = User::factory()->create();
    $token = $user->createToken('api')->plainTextToken;

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson('/api/posts', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['title', 'content']);
});
