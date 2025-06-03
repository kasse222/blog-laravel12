<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('rejette l’accès aux routes protégées sans token', function () {
    $response = $this->getJson('/api/posts');

    $response->assertStatus(401)
        ->assertJson(['message' => 'Unauthenticated.']);
});
