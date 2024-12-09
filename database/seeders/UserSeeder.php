<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'last_activity_at' => now(),
        ]);

        // Crear usuarios de prueba
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'last_activity_at' => now()->subDays(10),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'last_activity_at' => now()->subDays(20),
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'last_activity_at' => now()->subDays(35), // Usuario inactivo
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
