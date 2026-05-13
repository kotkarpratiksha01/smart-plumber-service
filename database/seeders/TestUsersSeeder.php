<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Plumber;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    public function run()
    {
        // admin
        User::updateOrCreate([
            'email' => 'admin@example.com'
        ],[
            'name' => 'Admin User',
            'password' => Hash::make('secret123'),
            'role' => 'admin'
        ]);

        // create a plumber and a plumber-user
        $plumber = Plumber::create([
            'name' => 'Demo Plumber',
            'phone' => '+919999999999',
            'location' => 'Demo City',
            'services' => json_encode(['Leak Repair','Drain Cleaning']),
            'rating' => 4.7,
            'experience_years' => 4,
            'available' => true,
        ]);

        User::updateOrCreate([
            'email' => 'plumber@example.com'
        ],[
            'name' => 'Demo Plumber',
            'password' => Hash::make('plumber123'),
            'role' => 'plumber',
            'plumber_id' => $plumber->id,
        ]);

        // regular user
        User::updateOrCreate([
            'email' => 'user@example.com'
        ],[
            'name' => 'Demo User',
            'password' => Hash::make('user1234'),
            'role' => 'user',
        ]);
    }
}
