<?php

namespace App\Http\Controllers;

use App\Models\CustomerVehicle;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserVehicleController extends Controller
{
    /**
     * Display user's vehicles.
     */
    public function index(): View
    {
        $user = Auth::user();
        $userVehicles = $user->customerVehicles()
            ->with('vehicle')
            ->latest()
            ->paginate(10);

        return view('user.vehicles.index', compact('userVehicles'));
    }

    /**
     * Show the form for creating a new vehicle.
     */
    public function create(): View
    {
        $vehicles = Vehicle::orderBy('brand')->orderBy('model')->get();
        
        return view('user.vehicles.create', compact('vehicles'));
    }

    /**
     * Store a newly created vehicle.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:50',
            'license_plate' => 'required|string|max:20|unique:customer_vehicles',
            'engine_number' => 'nullable|string|max:100',
            'chassis_number' => 'nullable|string|max:100',
            'purchase_date' => 'nullable|date',
            'mileage' => 'nullable|integer|min:0',
        ]);

        $user = Auth::user();

        CustomerVehicle::create([
            'user_id' => $user->id,
            'vehicle_id' => $validated['vehicle_id'],
            'year' => $validated['year'],
            'color' => $validated['color'],
            'license_plate' => $validated['license_plate'],
            'engine_number' => $validated['engine_number'],
            'chassis_number' => $validated['chassis_number'],
            'purchase_date' => $validated['purchase_date'],
            'mileage' => $validated['mileage'],
        ]);

        return redirect()->route('user.vehicles.index')
            ->with('success', 'Vehicle added successfully!');
    }

    /**
     * Display the specified vehicle.
     */
    public function show(CustomerVehicle $vehicle): View
    {
        $user = Auth::user();
        
        // Ensure user can only view their own vehicles
        if ($vehicle->user_id !== $user->id) {
            abort(403);
        }

        $vehicle->load('vehicle');
        
        // Get service history for this vehicle
        $serviceHistory = $vehicle->serviceRequests()
            ->with(['service', 'technician', 'payments'])
            ->latest()
            ->get();

        return view('user.vehicles.show', compact('vehicle', 'serviceHistory'));
    }

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit(CustomerVehicle $vehicle): View
    {
        $user = Auth::user();
        
        // Ensure user can only edit their own vehicles
        if ($vehicle->user_id !== $user->id) {
            abort(403);
        }

        $vehicles = Vehicle::orderBy('brand')->orderBy('model')->get();
        
        return view('user.vehicles.edit', compact('vehicle', 'vehicles'));
    }

    /**
     * Update the specified vehicle.
     */
    public function update(Request $request, CustomerVehicle $vehicle): RedirectResponse
    {
        $user = Auth::user();
        
        // Ensure user can only update their own vehicles
        if ($vehicle->user_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:50',
            'license_plate' => 'required|string|max:20|unique:customer_vehicles,license_plate,' . $vehicle->id,
            'engine_number' => 'nullable|string|max:100',
            'chassis_number' => 'nullable|string|max:100',
            'purchase_date' => 'nullable|date',
            'mileage' => 'nullable|integer|min:0',
        ]);

        $vehicle->update($validated);

        return redirect()->route('user.vehicles.show', $vehicle)
            ->with('success', 'Vehicle updated successfully!');
    }

    /**
     * Remove the specified vehicle.
     */
    public function destroy(CustomerVehicle $vehicle): RedirectResponse
    {
        $user = Auth::user();
        
        // Ensure user can only delete their own vehicles
        if ($vehicle->user_id !== $user->id) {
            abort(403);
        }

        // Check if vehicle has any service requests
        if ($vehicle->serviceRequests()->exists()) {
            return redirect()->route('user.vehicles.index')
                ->with('error', 'Cannot delete vehicle with existing service requests.');
        }

        $vehicle->delete();

        return redirect()->route('user.vehicles.index')
            ->with('success', 'Vehicle deleted successfully!');
    }
}
