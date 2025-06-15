<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@bengkel.com',
            'phone_number' => '081234567890',
            'user_type' => 'admin',
            'password' => bcrypt('password'),
        ]);

        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'manager@bengkel.com',
            'phone_number' => '081234567891',
            'user_type' => 'manager',
            'password' => bcrypt('password'),
        ]);

        $technician1 = User::create([
            'name' => 'John Technician',
            'email' => 'john@bengkel.com',
            'phone_number' => '081234567892',
            'user_type' => 'technician',
            'password' => bcrypt('password'),
        ]);

        $technician2 = User::create([
            'name' => 'Jane Technician',
            'email' => 'jane@bengkel.com',
            'phone_number' => '081234567893',
            'user_type' => 'technician',
            'password' => bcrypt('password'),
        ]);

        $customer = User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'phone_number' => '081234567894',
            'user_type' => 'customer',
            'password' => bcrypt('password'),
        ]);

        // Create technician profiles
        \App\Models\Technician::create([
            'user_id' => $technician1->id,
            'specialization' => 'Engine Repair',
            'experience_years' => 5,
            'skills' => ['Engine Diagnostics', 'Transmission Repair', 'Oil Change'],
        ]);

        \App\Models\Technician::create([
            'user_id' => $technician2->id,
            'specialization' => 'Electrical Systems',
            'experience_years' => 3,
            'skills' => ['Wiring', 'Battery Replacement', 'Lighting Systems'],
        ]);

        // Create sample vehicles
        $toyota = \App\Models\Vehicle::create(['brand' => 'Toyota', 'model' => 'Avanza']);
        $honda = \App\Models\Vehicle::create(['brand' => 'Honda', 'model' => 'Jazz']);
        $suzuki = \App\Models\Vehicle::create(['brand' => 'Suzuki', 'model' => 'Ertiga']);

        // Create customer vehicle
        $customerVehicle = \App\Models\CustomerVehicle::create([
            'user_id' => $customer->id,
            'vehicle_id' => $toyota->id,
            'year' => 2020,
            'license_plate' => 'B 1234 ABC',
            'color' => 'Silver',
            'vin_number' => 'VIN123456789',
        ]);

        // Create sample services
        $services = [
            [
                'name' => 'Oil Change',
                'category' => 'Maintenance',
                'description' => 'Regular engine oil change service',
                'base_price' => 150000,
                'estimated_hours' => 0.5,
            ],
            [
                'name' => 'Brake Inspection',
                'category' => 'Safety',
                'description' => 'Complete brake system inspection',
                'base_price' => 200000,
                'estimated_hours' => 1.0,
            ],
            [
                'name' => 'Engine Tune-up',
                'category' => 'Performance',
                'description' => 'Complete engine tune-up service',
                'base_price' => 500000,
                'estimated_hours' => 2.5,
            ],
        ];

        foreach ($services as $serviceData) {
            \App\Models\Service::create($serviceData);
        }

        // Create sample inventory items
        $inventoryItems = [
            [
                'name' => 'Engine Oil 5W-30',
                'category' => 'Lubricants',
                'unit_price' => 75000,
                'current_stock' => 50,
                'reorder_level' => 10,
                'unit' => 'Liter',
                'part_number' => 'OIL5W30',
                'supplier' => 'Shell Indonesia',
                'location' => 'Warehouse A1',
            ],
            [
                'name' => 'Brake Pad Set',
                'category' => 'Brake System',
                'unit_price' => 250000,
                'current_stock' => 25,
                'reorder_level' => 5,
                'unit' => 'Set',
                'part_number' => 'BP001',
                'supplier' => 'Brembo Indonesia',
                'location' => 'Warehouse B2',
            ],
            [
                'name' => 'Air Filter',
                'category' => 'Filters',
                'unit_price' => 85000,
                'current_stock' => 30,
                'reorder_level' => 8,
                'unit' => 'Piece',
                'part_number' => 'AF001',
                'supplier' => 'Mann Filter',
                'location' => 'Warehouse C1',
            ],
        ];

        foreach ($inventoryItems as $itemData) {
            \App\Models\InventoryItem::create($itemData);
        }
    }
}
