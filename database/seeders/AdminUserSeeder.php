<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'ynovee'], // Identifier to check existence
            [
                'name' => 'Admin',
                'email' => 'ynovee@gmail.com',
                'password' => 'password123',
            ]
        );
    }
}
