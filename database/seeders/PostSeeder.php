<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear posts y asociar imágenes

        Post::factory(10)->create()->each(function ($post) {
            $post->image()->create([
                'url' => fake()->imageUrl(),
            ]);
        });
    }
}
