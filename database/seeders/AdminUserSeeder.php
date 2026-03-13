<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@blog.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN,
                'is_active' => true,
                'bio' => 'System administrator with full access to all features.',
            ]
        );

        // Create author user
        User::updateOrCreate(
            ['email' => 'author@blog.com'],
            [
                'name' => 'Author User',
                'password' => Hash::make('password'),
                'role' => User::ROLE_AUTHOR,
                'is_active' => true,
                'bio' => 'Content creator with access to write and manage blogs.',
            ]
        );

        // Create regular user
        User::updateOrCreate(
            ['email' => 'user@blog.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'role' => User::ROLE_USER,
                'is_active' => true,
                'bio' => 'Regular user with basic access to the platform.',
            ]
        );
    }
}
