<x-layouts.dashboard>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Payment Details') }} - #{{ $payment->id }}
            </h2>
            <a href="{{ route('payments.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Payments
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Payment Information -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-4">Payment Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment ID</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">#{{ $payment->id }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                                    <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">
                                        Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                    </p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Method</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 capitalize">
                                        {{ str_replace('_', ' ', $payment->payment_method) }}
                                    </p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <div class="mt-1">
                                        @switch($payment->status)
                                            @case('pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                                    Pending
                                                </span>
                                                @break
                                            @case('completed')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                                    Completed
                                                </span>
                                                @break
                                            @case('failed')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                                    Failed
                                                </span>
                                                @break
                                            @case('refunded')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 dark:bg-purple-800 dark:text-purple-100">
                                                    Refunded
                                                </span>
                                                @break
                                        @endswitch
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Date</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $payment->created_at->format('F d, Y H:i') }}
                                    </p>
                                </div>
                                
                                @if($payment->paid_at)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Paid At</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $payment->paid_at->format('F d, Y H:i') }}
                                    </p>
                                </div>
                                @endif
                            </div>
                            
                            @if($payment->notes)
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $payment->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Service Request Information -->
                <div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-4">Related Service Request</h3>
                            
                            @if($payment->serviceRequest)
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Request ID</label>
                                        <a href="{{ route('service-requests.show', $payment->serviceRequest) }}" 
                                           class="mt-1 text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                            #{{ $payment->serviceRequest->id }}
                                        </a>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer</label>
                                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                            {{ $payment->serviceRequest->user->name }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service</label>
                                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                            {{ $payment->serviceRequest->service->name }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vehicle</label>
                                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                            {{ $payment->serviceRequest->customerVehicle->vehicle->make }} 
                                            {{ $payment->serviceRequest->customerVehicle->vehicle->model }}
                                            ({{ $payment->serviceRequest->customerVehicle->license_plate }})
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Request Status</label>
                                        <div class="mt-1">
                                            @switch($payment->serviceRequest->status)
                                                @case('pending')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Pending
                                                    </span>
                                                    @break
                                                @case('in_progress')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        In Progress
                                                    </span>
                                                    @break
                                                @case('completed')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Completed
                                                    </span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Cancelled
                                                    </span>
                                                    @break
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400">No service request associated with this payment.</p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Payment Actions -->
                    @if($payment->status === 'pending')
                    <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Actions</h3>
                            
                            <div class="space-y-3">
                                <form action="{{ route('payments.process', $payment) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                            onclick="return confirm('Mark this payment as completed?')">
                                        Mark as Completed
                                    </button>
                                </form>
                                
                                <form action="{{ route('payments.update', $payment) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="failed">
                                    <button type="submit" 
                                            class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                            onclick="return confirm('Mark this payment as failed?')">
                                        Mark as Failed
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
