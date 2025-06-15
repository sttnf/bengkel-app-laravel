<?php

namespace App\Livewire;

use App\Models\ServiceRequest;
use App\Models\CustomerVehicle;
use App\Models\Service;
use App\Models\Technician;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ServiceRequestForm extends Component
{
    #[Validate('required|exists:users,id')]
    public $customer_id = '';
    
    #[Validate('required|exists:customer_vehicles,id')]
    public $vehicle_id = '';
    
    #[Validate('required|exists:services,id')]
    public $service_id = '';
    
    #[Validate('nullable|exists:technicians,id')]
    public $technician_id = '';
    
    #[Validate('required|string|max:1000')]
    public $description = '';
    
    #[Validate('required|date|after:now')]
    public $scheduled_date = '';
    
    #[Validate('nullable|date|after:scheduled_date')]
    public $estimated_completion = '';

    public $customerVehicles = [];
    public $customers = [];
    public $services = [];
    public $technicians = [];

    public function mount()
    {
        $this->customers = User::where('user_type', 'customer')->get();
        $this->services = Service::all();
        $this->technicians = Technician::all();
    }

    public function updatedCustomerId($customerId)
    {
        $this->vehicle_id = '';
        $this->customerVehicles = CustomerVehicle::with('vehicle')
            ->where('customer_id', $customerId)
            ->get();
    }

    public function save()
    {
        $this->validate();

        ServiceRequest::create([
            'customer_id' => $this->customer_id,
            'vehicle_id' => $this->vehicle_id,
            'service_id' => $this->service_id,
            'technician_id' => $this->technician_id ?: null,
            'description' => $this->description,
            'scheduled_date' => $this->scheduled_date,
            'estimated_completion' => $this->estimated_completion ?: null,
            'status' => 'pending',
        ]);

        session()->flash('message', 'Service request created successfully!');
        
        $this->reset(['customer_id', 'vehicle_id', 'service_id', 'technician_id', 'description', 'scheduled_date', 'estimated_completion']);
        $this->customerVehicles = [];
        
        return redirect()->route('service-requests.index');
    }

    public function render()
    {
        return view('livewire.service-request-form');
    }
}
