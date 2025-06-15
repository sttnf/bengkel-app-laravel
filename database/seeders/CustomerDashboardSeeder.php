<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\CustomerVehicle;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;

class CustomerDashboardSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create a test customer
        $customer = User::create([
            'name' => 'John Doe',
            'email' => 'customer@test.com',
            'phone_number' => '081234567890',
            'user_type' => 'customer',
            'password' => Hash::make('password'),
        ]);

        // Create some vehicles if they don't exist
        $vehicles = [
            ['brand' => 'Toyota', 'model' => 'Avanza', 'type' => 'MPV'],
            ['brand' => 'Honda', 'model' => 'Civic', 'type' => 'Sedan'],
            ['brand' => 'Yamaha', 'model' => 'NMAX', 'type' => 'Motorcycle'],
        ];

        foreach ($vehicles as $vehicleData) {
            Vehicle::firstOrCreate($vehicleData);
        }

        // Create customer vehicles
        $toyotaAvanza = Vehicle::where('brand', 'Toyota')->where('model', 'Avanza')->first();
        $hondaCivic = Vehicle::where('brand', 'Honda')->where('model', 'Civic')->first();

        $customerVehicle1 = CustomerVehicle::create([
            'user_id' => $customer->id,
            'vehicle_id' => $toyotaAvanza->id,
            'year' => 2020,
            'color' => 'Silver',
            'license_plate' => 'B 1234 ABC',
            'mileage' => 45000,
            'purchase_date' => '2020-01-15',
        ]);

        $customerVehicle2 = CustomerVehicle::create([
            'user_id' => $customer->id,
            'vehicle_id' => $hondaCivic->id,
            'year' => 2019,
            'color' => 'White',
            'license_plate' => 'B 5678 DEF',
            'mileage' => 60000,
            'purchase_date' => '2019-06-20',
        ]);

        // Create some services if they don't exist
        $services = [
            [
                'name' => 'Oil Change',
                'category' => 'maintenance',
                'description' => 'Regular engine oil change service',
                'base_price' => 150000,
                'estimated_hours' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Brake Service',
                'category' => 'repair',
                'description' => 'Brake pad replacement and brake system check',
                'base_price' => 300000,
                'estimated_hours' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'General Checkup',
                'category' => 'inspection',
                'description' => 'Complete vehicle inspection',
                'base_price' => 100000,
                'estimated_hours' => 1.5,
                'is_active' => true,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::firstOrCreate(['name' => $serviceData['name']], $serviceData);
        }

        // Create service requests
        $oilChangeService = Service::where('name', 'Oil Change')->first();
        $brakeService = Service::where('name', 'Brake Service')->first();

        $serviceRequest1 = ServiceRequest::create([
            'user_id' => $customer->id,
            'customer_vehicle_id' => $customerVehicle1->id,
            'service_id' => $oilChangeService->id,
            'description' => 'Regular oil change for my Toyota Avanza',
            'preferred_date' => now()->addDays(3),
            'priority' => 'medium',
            'status' => 'completed',
        ]);

        $serviceRequest2 = ServiceRequest::create([
            'user_id' => $customer->id,
            'customer_vehicle_id' => $customerVehicle2->id,
            'service_id' => $brakeService->id,
            'description' => 'Brake pads need replacement, making noise',
            'preferred_date' => now()->addDays(5),
            'priority' => 'high',
            'status' => 'in_progress',
        ]);

        // Create payments
        Payment::create([
            'request_id' => $serviceRequest1->id,
            'amount' => 150000,
            'payment_method' => 'cash',
            'status' => 'completed',
            'payment_date' => now()->subDays(1),
        ]);

        $this->command->info('Customer dashboard test data created successfully!');
    }
}
