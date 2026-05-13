<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plumber;

class PlumberSeeder extends Seeder
{
    public function run()
    {
        Plumber::insert([
            ['name' => 'Ramesh Sharma', 'phone' => '+919876543210', 'location' => 'Mumbai', 'services' => json_encode(['Leak Repair','Pipe Installation']), 'rating' => 4.6, 'experience_years' => 6, 'available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Suresh Patil', 'phone' => '+919812345678', 'location' => 'Pune', 'services' => json_encode(['Drain Cleaning','Bathroom Fitting']), 'rating' => 4.8, 'experience_years' => 8, 'available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Anita Rao', 'phone' => '+919800112233', 'location' => 'Nagpur', 'services' => json_encode(['Water Heater Repair','Pipe Replacement']), 'rating' => 4.5, 'experience_years' => 5, 'available' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
