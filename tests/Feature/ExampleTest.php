<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // tests/Feature/ExampleTest.php
        it('affiche le message de bienvenue', function () {
            $response = $this->getJson('/');

            $response->assertOk()
                    ->assertJson([
                        'message' => 'Bienvenue sur l’API Blog Laravel 12 🚀',
                        'status' => 'OK'
                    ]);
        });

    }
}
