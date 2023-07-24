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
        User::updateOrCreate(
            ['email' => 'sembara9090@gmail.com'],
            [
                'name' => 'Sebastianus Sembara',
                'password' => Hash::make('password'),
            ]
        );
    }
}
