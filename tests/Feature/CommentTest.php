<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use function Pest\Laravel\{getJson, postJson};

it('permet à un utilisateur authentifié de créer un commentaire', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    Sanctum::actingAs($user);

    $response = postJson('/api/comments', [
        'post_id' => $post->id,
        'body' => 'Ceci est un commentaire.'
    ]);

    $response->assertStatus(201)
             ->assertJsonStructure([
                 'message',
                 'comment' => ['id', 'body', 'user', 'post_id', 'created_at']
             ]);

    expect(Comment::where('body', 'Ceci est un commentaire.')->exists())->toBeTrue();
});

it('liste les commentaires avec leurs relations', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    Comment::factory()->count(2)->create([
        'user_id' => $user->id,
        'post_id' => $post->id,
    ]);

    Sanctum::actingAs($user);

    $response = getJson('/api/comments');

    $response->assertStatus(200)
             ->assertJsonStructure([
                 'message',
                 'comments' => [
                     ['id', 'body', 'user', 'post_id', 'created_at']
                 ]
             ]);
});
