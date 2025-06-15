<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Service;
use App\Models\CustomerVehicle;
use App\Models\ServiceRequest;

class CustomerTestSeeder extends Seeder
{
    public function run()
    {
        // Create a customer user
        $customer = User::create([
            'name' => 'John Customer',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
            'user_type' => 'customer',
            'phone_number' => '081234567890'
        ]);

        // Update services to have is_active field
        Service::query()->update(['is_active' => true]);

        // Create a customer vehicle
        $vehicle = Vehicle::first();
        if ($vehicle) {
            $customerVehicle = CustomerVehicle::create([
                'user_id' => $customer->id,
                'vehicle_id' => $vehicle->id,
                'year' => 2020,
                'color' => 'Red',
                'license_plate' => 'B1234ABC',
                'mileage' => 50000
            ]);
            
            // Create a service request
            $service = Service::first();
            if ($service) {
                ServiceRequest::create([
                    'user_id' => $customer->id,
                    'customer_vehicle_id' => $customerVehicle->id,
                    'service_id' => $service->id,
                    'description' => 'Oil change needed',
                    'preferred_date' => now()->addDays(1),
                    'priority' => 'medium',
                    'status' => 'pending'
                ]);
            }
        }

        $this->command->info('Customer test data created successfully!');
    }
}
