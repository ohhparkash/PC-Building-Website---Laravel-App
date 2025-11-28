<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing admin user first
        User::where('email', 'admin@ashbuilds.test')->delete();
        
        // Create fresh admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@ashbuilds.test',
            'password' => 'admin123',
            'is_admin' => true,
        ]);
    }
}
