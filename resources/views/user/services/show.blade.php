<x-layouts.dashboard>
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Service Request Details</h1>
        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold mb-2 text-indigo-700">Service: <span
                        class="font-normal text-gray-900">{{ $serviceRequest->service->name ?? '-' }}</span></h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div><span class="font-medium text-gray-700">Status:</span> <span
                            class="capitalize">{{ $serviceRequest->status }}</span></div>
                    <div><span class="font-medium text-gray-700">Scheduled Date:</span>
                        {{ $serviceRequest->scheduled_datetime ? $serviceRequest->scheduled_datetime->format('Y-m-d H:i') : '-' }}
                    </div>
                    <div><span class="font-medium text-gray-700">Vehicle:</span>
                        {{ $serviceRequest->customerVehicle->vehicle->name ?? '-' }}</div>
                    <div><span class="font-medium text-gray-700">Technician:</span>
                        {{ $serviceRequest->technician->name ?? '-' }}</div>
                </div>
                <div class="mb-2">
                    <span class="font-medium text-gray-700">Description:</span>
                    <div class="bg-gray-50 rounded p-2 mt-1 text-gray-800">{{ $serviceRequest->customer_notes }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow mb-6 p-6">
            <h3 class="text-lg font-semibold mb-4 text-indigo-700">Payments</h3>
            @if($serviceRequest->payments->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Method</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($serviceRequest->payments as $payment)
                                <tr>
                                    <td class="px-4 py-2">{{ number_format($payment->amount, 2) }}</td>
                                    <td class="px-4 py-2 capitalize">{{ $payment->payment_method }}</td>
                                    <td class="px-4 py-2 capitalize">{{ $payment->status }}</td>
                                    <td class="px-4 py-2">
                                        {{ $payment->payment_date ? $payment->payment_date->format('Y-m-d H:i') : '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500">No payments found.</p>
            @endif
        </div>
        <div class="flex flex-col md:flex-row gap-2">
            <a href="{{ route('user.services.index') }}" class="btn btn-secondary w-full md:w-auto">Back to My
                Services</a>
            @if($serviceRequest->status === 'completed' && !$serviceRequest->payments->where('status', 'completed')->count())
                <a href="{{ route('user.services.payment', $serviceRequest->id) }}"
                    class="btn btn-primary w-full md:w-auto">Pay Now</a>
            @endif
        </div>
    </div>
</x-layouts.dashboard>