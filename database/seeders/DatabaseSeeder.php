<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            ProjectSeeder::class,
        ]);
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'role' => UserRole::Admin,
            'password' => Hash::make('123qweasd'),
        ]);
        User::create([
            'name' => 'Project Manager',
            'email' => 'manager@gmail.com',
            'role' => UserRole::Manager,
            'password' => Hash::make('123qweasd'),
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'role' => UserRole::User,
            'password' => Hash::make('123qweasd'),
        ]);
    }
}
