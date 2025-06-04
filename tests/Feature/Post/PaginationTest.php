<?php

use App\Models\Post;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use function Pest\Laravel\getJson;

it('retourne une pagination correcte avec PostResource', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);
    Post::factory()->count(15)->for($user)->create();

    $response = getJson('/api/posts');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'content',
                    'tags',
                    'user',
                    'created_at',
                ],
            ],
            'links',
            'meta',
        ]);

    expect(count($response->json('data')))->toBe(10);
});
