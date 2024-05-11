<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create user roles.
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        User::factory()
        ->count(1000)
        ->create()
        ->each(function ($user) {
            $user->assignRole('user');
        });

        // Create a default user.
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@supportify.com',
            'password' => bcrypt('password'),
        ])->assignRole('admin');
    }
}
