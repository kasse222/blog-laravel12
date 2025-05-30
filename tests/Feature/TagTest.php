<?php

use App\Models\Tag;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use function Pest\Laravel\{postJson, getJson};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/*it('permet à un utilisateur authentifié de créer un tag', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

   $name = 'VueJS-' . uniqid(); // éviter l'erreur unique

    $response = postJson('/api/tags', [
        'name' => $name,
    ]);
dd($response->json());
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
*/
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
