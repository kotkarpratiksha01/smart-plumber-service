<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\Service;
class ServiceSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'Plumbing' => [
                'Pipe Repair','Tap Repair','Water Leakage Fix','Bathroom Fitting','Tank Cleaning','Drain Blockage Removal','New Installation'
            ],
            'Electrical / Wireman' => [
                'Fan Installation','Switch Repair','Wiring Installation','Power Failure Repair','MCB Replacement','Light Fitting','Inverter Connection'
            ],
            'AC Repair' => [
                'AC Installation','Gas Refilling','Cooling Repair','AC Cleaning','AC Maintenance'
            ],
            'Carpenter' => [
                'Furniture Repair','Door Installation','Window Repair','Modular Furniture Work'
            ],
            'Painting' => [
                'Home Painting','Wall Design','Waterproof Painting'
            ],
            'Cleaning' => [
                'Home Deep Cleaning','Sofa Cleaning','Carpet Cleaning'
            ],
        ];

        foreach ($data as $category => $services) {
            $cat = ServiceCategory::firstOrCreate(['name' => $category], ['slug' => \Str::slug($category)]);
            foreach ($services as $s) {
                Service::firstOrCreate(['service_category_id' => $cat->id, 'name' => $s], ['slug' => \Str::slug($s)]);
            }
        }
    }
}
