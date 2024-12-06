<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate(["name"=>"index.usuarios"]);
        Permission::firstOrCreate(["name"=>"store.usuarios"]);
        Permission::firstOrCreate(["name"=>"show.usuarios"]);
        Permission::firstOrCreate(["name"=>"update.usuarios"]);
        Permission::firstOrCreate(["name"=>"destroy.usuarios"]);

        Permission::firstOrCreate(["name"=>"index.libros"]);
        Permission::firstOrCreate(["name"=>"store.libros"]);
        Permission::firstOrCreate(["name"=>"show.libros"]);
        Permission::firstOrCreate(["name"=>"update.libros"]);
        Permission::firstOrCreate(["name"=>"destroy.libros"]);
        $role_admin=Role::create(["name"=>"admin"]);
        $permissionsAdmin=Permission::query()->pluck("name");
        $role_admin->syncPermissions($permissionsAdmin);
        $student_role=Role::create(["name"=>"student"]);
        $student_role->syncPermissions(['index.libros']);

        $admin_user=User::create([
            "name"=>"jean",
            "email"=>"jean@example.com",
            "password"=>Hash::make("admin123"),
            "email_verified_at"=>now(),
        ]);

        $admin_user->assignRole("admin");


        $student_user=User::create([
            "name"=>"student 1",
            "email"=>"student1@example.com",
            "password"=>Hash::make("student123"),
            "email_verified_at"=>now(),
        ]);

        $student_user->assignRole("student");

    }
}
