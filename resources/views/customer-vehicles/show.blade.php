<x-layouts.dashboard>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $customerVehicle->vehicle->make }} {{ $customerVehicle->vehicle->model }} 
                ({{ $customerVehicle->license_plate }})
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('customer-vehicles.edit', $customerVehicle) }}" 
                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit Vehicle
                </a>
                <a href="{{ route('customer-vehicles.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Vehicles
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Vehicle Details -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-4">Vehicle Information</h3>
                            
                            <!-- Vehicle Image Placeholder -->
                            <div class="h-64 bg-gray-200 dark:bg-gray-700 rounded-lg mb-6 flex items-center justify-center">
                                <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Make</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $customerVehicle->vehicle->make }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Model</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $customerVehicle->vehicle->model }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $customerVehicle->vehicle->year }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 capitalize">{{ $customerVehicle->vehicle->type }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Engine</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $customerVehicle->vehicle->engine ?? 'N/A' }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">License Plate</label>
                                    <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $customerVehicle->license_plate }}</p>
                                </div>
                                
                                @if($customerVehicle->current_mileage)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Mileage</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ number_format($customerVehicle->current_mileage) }} km</p>
                                </div>
                                @endif
                                
                                @if($customerVehicle->purchase_date)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Purchase Date</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $customerVehicle->purchase_date->format('F d, Y') }}</p>
                                </div>
                                @endif
                                
                                @if($customerVehicle->insurance_expiry)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Insurance Expiry</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $customerVehicle->insurance_expiry->format('F d, Y') }}
                                        @if($customerVehicle->insurance_expiry->isPast())
                                            <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                                Expired
                                            </span>
                                        @elseif($customerVehicle->insurance_expiry->diffInDays() <= 30)
                                            <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                                Expiring Soon
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                @endif
                            </div>
                            
                            @if($customerVehicle->notes)
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $customerVehicle->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Service History -->
                    <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Service History</h3>
                                <a href="{{ route('service-requests.create', ['vehicle_id' => $customerVehicle->id]) }}" 
                                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                                    Request Service
                                </a>
                            </div>
                            
                            @forelse($customerVehicle->serviceRequests->take(5) as $serviceRequest)
                                <div class="border-l-4 border-blue-400 pl-4 mb-4 last:mb-0">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium">{{ $serviceRequest->service->name }}</h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $serviceRequest->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            @switch($serviceRequest->status)
                                                @case('pending')
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Pending
                                                    </span>
                                                    @break
                                                @case('in_progress')
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        In Progress
                                                    </span>
                                                    @break
                                                @case('completed')
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                        Completed
                                                    </span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                        Cancelled
                                                    </span>
                                                    @break
                                            @endswitch
                                            <a href="{{ route('service-requests.show', $serviceRequest) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm">
                                                View
                                            </a>
                                        </div>
                                    </div>
                                    @if($serviceRequest->description)
                                        <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">{{ Str::limit($serviceRequest->description, 100) }}</p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400">No service history available.</p>
                            @endforelse
                            
                            @if($customerVehicle->serviceRequests->count() > 5)
                                <div class="mt-4 text-center">
                                    <a href="{{ route('service-requests.index', ['vehicle_id' => $customerVehicle->id]) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm">
                                        View All Service History ({{ $customerVehicle->serviceRequests->count() }} total)
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Customer Information & Quick Actions -->
                <div>
                    <!-- Customer Info -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-4">Customer Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $customerVehicle->user->name }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $customerVehicle->user->email }}</p>
                                </div>
                                
                                @if($customerVehicle->user->phone)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $customerVehicle->user->phone }}</p>
                                </div>
                                @endif
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer Since</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $customerVehicle->user->created_at->format('M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Quick Actions</h3>
                            
                            <div class="space-y-3">
                                <a href="{{ route('service-requests.create', ['vehicle_id' => $customerVehicle->id]) }}" 
                                   class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded block text-center">
                                    Request Service
                                </a>
                                
                                <a href="{{ route('customer-vehicles.edit', $customerVehicle) }}" 
                                   class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded block text-center">
                                    Edit Vehicle
                                </a>
                                
                                <form action="{{ route('customer-vehicles.destroy', $customerVehicle) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                            onclick="return confirm('Are you sure you want to delete this vehicle? This action cannot be undone.')">
                                        Delete Vehicle
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Vehicle Statistics -->
                    <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-4">Statistics</h3>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Total Services</span>
                                    <span class="font-medium">{{ $customerVehicle->serviceRequests->count() }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Completed Services</span>
                                    <span class="font-medium">{{ $customerVehicle->serviceRequests->where('status', 'completed')->count() }}</span>
                                </div>
                                
                                @if($customerVehicle->serviceRequests->where('status', 'completed')->count() > 0)
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Total Spent</span>
                                    <span class="font-medium">
                                        Rp {{ number_format($customerVehicle->serviceRequests->where('status', 'completed')->sum('total_cost'), 0, ',', '.') }}
                                    </span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Last Service</span>
                                    <span class="font-medium">
                                        {{ $customerVehicle->serviceRequests->where('status', 'completed')->sortByDesc('updated_at')->first()?->updated_at->format('M d, Y') ?? 'Never' }}
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
