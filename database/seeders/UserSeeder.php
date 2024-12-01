<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuarios y asociar imágenes

        User::factory(10)->create()->each(function ($user) {
            $user->image()->create([
                'url' => fake()->imageUrl(),
            ]);
        });
    }
}
