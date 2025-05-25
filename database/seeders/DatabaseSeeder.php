<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
        {
            \App\Models\User::factory(10)
            ->hasPosts(3)
            ->create();

            \App\Models\Tag::factory(5)->create();

            // Associer des tags à chaque post
            \App\Models\Post::all()->each(function ($post) {
                $tags = \App\Models\Tag::inRandomOrder()->take(2)->pluck('id');
                $post->tags()->attach($tags);
            });

            // Générer des commentaires
            \App\Models\Post::all()->each(function ($post) {
                \App\Models\Comment::factory(2)->create([
                    'post_id' => $post->id,
                    'user_id' => \App\Models\User::inRandomOrder()->first()->id,
                ]);
            });
       }
}
