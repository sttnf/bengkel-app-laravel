<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Display a listing of the payments.
     */
    public function index(): View
    {
        $payments = Payment::with(['serviceRequest.user', 'serviceRequest.service'])
            ->latest()
            ->paginate(10);

        // Calculate statistics
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        $completedPayments = Payment::where('status', 'completed')->count();
        $pendingPayments = Payment::where('status', 'pending')->count();
        $averagePayment = Payment::where('status', 'completed')->avg('amount') ?? 0;

        return view('payments.index', compact(
            'payments', 
            'totalRevenue', 
            'completedPayments', 
            'pendingPayments', 
            'averagePayment'
        ));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create(Request $request): View
    {
        $serviceRequestId = $request->get('service_request_id');
        $serviceRequest = $serviceRequestId ? ServiceRequest::findOrFail($serviceRequestId) : null;
        $serviceRequests = ServiceRequest::with(['customer', 'service'])->get();
        
        return view('payments.create', compact('serviceRequest', 'serviceRequests'));
    }

    /**
     * Store a newly created payment in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'request_id' => 'required|exists:service_requests,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,card,transfer,other',
            'status' => 'required|in:pending,completed,failed,refunded',
            'transaction_reference' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        $payment = Payment::create($validated);

        return redirect()->route('payments.show', $payment)
            ->with('success', 'Payment recorded successfully.');
    }

    /**
     * Display the specified payment.
     */
    public function show(Payment $payment): View
    {
        $payment->load(['serviceRequest.customer', 'serviceRequest.service', 'serviceRequest.vehicle']);
        
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified payment.
     */
    public function edit(Payment $payment): View
    {
        $serviceRequests = ServiceRequest::with(['customer', 'service'])->get();
        
        return view('payments.edit', compact('payment', 'serviceRequests'));
    }

    /**
     * Update the specified payment in storage.
     */
    public function update(Request $request, Payment $payment): RedirectResponse
    {
        $validated = $request->validate([
            'request_id' => 'required|exists:service_requests,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,card,transfer,other',
            'status' => 'required|in:pending,completed,failed,refunded',
            'transaction_reference' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        $payment->update($validated);

        return redirect()->route('payments.show', $payment)
            ->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified payment from storage.
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully.');
    }

    /**
     * Process payment and update status.
     */
    public function process(Request $request, Payment $payment): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:completed,failed',
            'transaction_reference' => 'nullable|string|max:255',
        ]);

        $payment->update($validated);

        return back()->with('success', 'Payment processed successfully.');
    }
}
