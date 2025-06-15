<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\CustomerVehicle;
use App\Models\Service;
use App\Models\Technician;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the service requests.
     */
    public function index(): View
    {
        $serviceRequests = ServiceRequest::with(['customer', 'vehicle', 'service', 'technician'])
            ->latest()
            ->paginate(10);

        return view('service-requests.index', compact('serviceRequests'));
    }

    /**
     * Show the form for creating a new service request.
     */
    public function create(): View
    {
        $customers = User::where('user_type', 'customer')->get();
        $services = Service::all();
        $technicians = Technician::all();
        
        return view('service-requests.create', compact('customers', 'services', 'technicians'));
    }

    /**
     * Store a newly created service request in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:customer_vehicles,id',
            'service_id' => 'required|exists:services,id',
            'technician_id' => 'nullable|exists:technicians,id',
            'description' => 'required|string|max:1000',
            'scheduled_date' => 'required|date|after:now',
            'estimated_completion' => 'nullable|date|after:scheduled_date',
        ]);

        $serviceRequest = ServiceRequest::create($validated);

        return redirect()->route('service-requests.show', $serviceRequest)
            ->with('success', 'Service request created successfully.');
    }

    /**
     * Display the specified service request.
     */
    public function show(ServiceRequest $serviceRequest): View
    {
        $serviceRequest->load(['customer', 'vehicle', 'service', 'technician', 'payments', 'reviews']);
        
        return view('service-requests.show', compact('serviceRequest'));
    }

    /**
     * Show the form for editing the specified service request.
     */
    public function edit(ServiceRequest $serviceRequest): View
    {
        $customers = User::where('user_type', 'customer')->get();
        $services = Service::all();
        $technicians = Technician::all();
        
        return view('service-requests.edit', compact('serviceRequest', 'customers', 'services', 'technicians'));
    }

    /**
     * Update the specified service request in storage.
     */
    public function update(Request $request, ServiceRequest $serviceRequest): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:customer_vehicles,id',
            'service_id' => 'required|exists:services,id',
            'technician_id' => 'nullable|exists:technicians,id',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'description' => 'required|string|max:1000',
            'scheduled_date' => 'required|date',
            'estimated_completion' => 'nullable|date|after:scheduled_date',
            'actual_completion' => 'nullable|date',
        ]);

        $serviceRequest->update($validated);

        return redirect()->route('service-requests.show', $serviceRequest)
            ->with('success', 'Service request updated successfully.');
    }

    /**
     * Remove the specified service request from storage.
     */
    public function destroy(ServiceRequest $serviceRequest): RedirectResponse
    {
        $serviceRequest->delete();

        return redirect()->route('service-requests.index')
            ->with('success', 'Service request deleted successfully.');
    }

    /**
     * Update the status of a service request.
     */
    public function updateStatus(Request $request, ServiceRequest $serviceRequest): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        $serviceRequest->update($validated);

        return back()->with('success', 'Service request status updated successfully.');
    }
}
