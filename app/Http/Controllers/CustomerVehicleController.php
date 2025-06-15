<?php

namespace App\Http\Controllers;

use App\Models\CustomerVehicle;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerVehicleController extends Controller
{
    /**
     * Display a listing of customer vehicles.
     */
    public function index(): View
    {
        $customerVehicles = CustomerVehicle::with(['customer', 'vehicle'])
            ->latest()
            ->paginate(10);

        return view('customer-vehicles.index', compact('customerVehicles'));
    }

    /**
     * Show the form for creating a new customer vehicle.
     */
    public function create(): View
    {
        $customers = User::where('user_type', 'customer')->get();
        $vehicles = Vehicle::all();
        
        return view('customer-vehicles.create', compact('customers', 'vehicles'));
    }

    /**
     * Store a newly created customer vehicle in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:50',
            'license_plate' => 'required|string|max:20|unique:customer_vehicles',
            'engine_number' => 'nullable|string|max:100',
            'chassis_number' => 'nullable|string|max:100',
            'purchase_date' => 'nullable|date',
            'mileage' => 'nullable|integer|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        $customerVehicle = CustomerVehicle::create($validated);

        return redirect()->route('customer-vehicles.show', $customerVehicle)
            ->with('success', 'Customer vehicle added successfully.');
    }

    /**
     * Display the specified customer vehicle.
     */
    public function show(CustomerVehicle $customerVehicle): View
    {
        $customerVehicle->load(['customer', 'vehicle', 'serviceRequests.service']);
        
        return view('customer-vehicles.show', compact('customerVehicle'));
    }

    /**
     * Show the form for editing the specified customer vehicle.
     */
    public function edit(CustomerVehicle $customerVehicle): View
    {
        $customers = User::where('user_type', 'customer')->get();
        $vehicles = Vehicle::all();
        
        return view('customer-vehicles.edit', compact('customerVehicle', 'customers', 'vehicles'));
    }

    /**
     * Update the specified customer vehicle in storage.
     */
    public function update(Request $request, CustomerVehicle $customerVehicle): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:50',
            'license_plate' => 'required|string|max:20|unique:customer_vehicles,license_plate,' . $customerVehicle->id,
            'engine_number' => 'nullable|string|max:100',
            'chassis_number' => 'nullable|string|max:100',
            'purchase_date' => 'nullable|date',
            'mileage' => 'nullable|integer|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        $customerVehicle->update($validated);

        return redirect()->route('customer-vehicles.show', $customerVehicle)
            ->with('success', 'Customer vehicle updated successfully.');
    }

    /**
     * Remove the specified customer vehicle from storage.
     */
    public function destroy(CustomerVehicle $customerVehicle): RedirectResponse
    {
        $customerVehicle->delete();

        return redirect()->route('customer-vehicles.index')
            ->with('success', 'Customer vehicle deleted successfully.');
    }

    /**
     * Get customer vehicles by customer ID (AJAX endpoint).
     */
    public function getByCustomer(Request $request)
    {
        $customerId = $request->get('customer_id');
        
        $vehicles = CustomerVehicle::with('vehicle')
            ->where('customer_id', $customerId)
            ->get();

        return response()->json($vehicles);
    }
}
