<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Petugas Gudang',
            'username' => 'petugas',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'petugas',
        ]);
    }
}
