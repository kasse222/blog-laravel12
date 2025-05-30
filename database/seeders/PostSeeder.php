<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

    class PostSeeder extends Seeder
    {
    /**
     * Run the database seeds.
     */
        public function run(): void
        {
            Post::all()->each(function ($post) {
                $tags = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id');
                $post->tags()->sync($tags);
            });
        }
    }

