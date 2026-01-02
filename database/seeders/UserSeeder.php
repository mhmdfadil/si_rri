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
        // Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@rri.id',
            'password' => Hash::make('12345678'),
            'is_active' => true,
            'last_login_at' => now(),
        ]);

        // RRI Lhokseumawe
        User::create([
            'name' => 'RRI Lhokseumawe',
            'username' => 'rrilhokseumawe',
            'email' => 'rrilhokseumawe@gmail.com',
            'password' => Hash::make('12345678'),
            'is_active' => true,
            'last_login_at' => now(),
        ]);
    }
}
