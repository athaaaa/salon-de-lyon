<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // 

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Salon De Lyon',
            'email' => 'admin@salondelyon.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);
    }
}