<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::factory(10)
        ->create([
            'body' => fake()->sentence(),
            'commentable_id' => rand(1, 10), // ID de Post o Video
            'commentable_type' =>  Post::class ,
        ]);
        Comment::factory(10)
        ->create([
            'body' => fake()->sentence(),
            'commentable_id' => rand(1, 10), // ID de Post o Video
            'commentable_type' =>  Video::class ,
        ]);
    }
}
