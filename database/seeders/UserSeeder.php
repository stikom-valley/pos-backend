<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'created_by' => 0,
            'email' => 'admin@example.com',
            'name' => 'admin',
            'email_verified_at' => now(),
            'uuid' => Str::uuid(),
            'remember_token' => Str::random(10),
            'password' => 'password',
        ]);

        $superadmin->assignRole('superadmin');

        User::factory()
            ->count(1)
            ->afterCreating(function ($user) {
                return $user->assignRole('admin');
            })
            ->create([
                'created_by' => $superadmin->id,
            ])
            ->each(function ($data) {
                User::factory()
                    ->count(3)
                    ->afterCreating(function ($user) {
                        return $user->assignRole('cashier');
                    })
                    ->create([
                        'created_by' => $data->id,
                    ]);
            });
    }
}
