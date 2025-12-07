<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@farmlink.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Carlos Miguel M. Carla',
            'email' => 'carlos@farmlink.com',
            'password' => Hash::make('secure123'), 
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);
    }
}