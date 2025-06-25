<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\CustomerVehicle;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserServiceController extends Controller
{
    /**
     * Display user's service requests.
     */
    public function index(): View
    {
        $user = Auth::user();

        $serviceRequests = $user->serviceRequests()
            ->with(['service', 'technician', 'payments', 'customerVehicle.vehicle'])
            ->latest()
            ->paginate(10);

        return view('user.services.index', compact('serviceRequests'));
    }

    /**
     * Show the form for creating a new service request.
     */
    public function create(): View
    {
        $user = Auth::user();
        $userVehicles = $user->customerVehicles()->with('vehicle')->get();
        $services = Service::where('is_active', true)->get();

        return view('user.services.create', compact('userVehicles', 'services'));
    }

    /**
     * Store a newly created service request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_vehicle_id' => 'required|exists:customer_vehicles,id',
            'service_id' => 'required|exists:services,id',
            'description' => 'required|string',
            'preferred_date' => 'required|date|after:today',
            'priority' => 'required|in:low,medium,high,urgent',
        ]);

        $user = Auth::user();

        // Verify the vehicle belongs to the user
        $customerVehicle = $user->customerVehicles()->findOrFail($validated['customer_vehicle_id']);

        $serviceRequest = ServiceRequest::create([
            'user_id' => $user->id,
            'vehicle_id' => $validated['customer_vehicle_id'], // Use vehicle_id to match database schema
            'service_id' => $validated['service_id'],
            'customer_notes' => $validated['description'], // Use customer_notes to match database schema
            'scheduled_datetime' => $validated['preferred_date'], // Use scheduled_datetime to match database schema
            'status' => 'pending',
        ]);

        return redirect()->route('user.services.show')
            ->with('success', 'Service request created successfully!');
    }

    /**
     * Display the specified service request.
     */
    public function show(ServiceRequest $serviceRequest): View
    {
        $user = Auth::user();

        // Ensure user can only view their own service requests
        if ($serviceRequest->user_id !== $user->id) {
            abort(403);
        }

        $serviceRequest->load(['service', 'technician', 'customerVehicle.vehicle', 'payments']);

        return view('user.services.show', compact('serviceRequest'));
    }

    /**
     * Show payment form for a service request.
     */
    public function payment(ServiceRequest $serviceRequest)
    {
        $user = Auth::user();

        // Ensure user can only pay for their own service requests
        if ($serviceRequest->user_id !== $user->id) {
            abort(403);
        }

        // Check if service is completed and payment is pending
        if ($serviceRequest->status !== 'completed') {
            return redirect()->route('user.services.show', $serviceRequest)
                ->with('error', 'Service must be completed before payment.');
        }

        $existingPayment = $serviceRequest->payments()
            ->where('status', 'completed')
            ->first();

        if ($existingPayment) {
            return redirect()->route('user.services.show', $serviceRequest)
                ->with('info', 'This service has already been paid for.');
        }

        return view('user.services.payment', compact('serviceRequest'));
    }

    /**
     * Process payment for a service request.
     */
    public function processPayment(Request $request, ServiceRequest $serviceRequest): RedirectResponse
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:cash,card,transfer,e_wallet',
            'amount' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        // Ensure user can only pay for their own service requests
        if ($serviceRequest->user_id !== $user->id) {
            abort(403);
        }

        // Create payment record
        Payment::create([
            'request_id' => $serviceRequest->id,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'status' => 'completed',
            'payment_date' => now(),
        ]);

        return redirect()->route('user.services.show', $serviceRequest)
            ->with('success', 'Payment processed successfully!');
    }
}
