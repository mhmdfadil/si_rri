<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@unimal.ac.id',
            'password' => Hash::make('12345678'),
            'is_active' => true,
            'last_login_at' => now(),
        ]);
    }
}