<x-layouts.dashboard>
    <x-slot name="title">My Dashboard</x-slot>
    <x-slot name="subtitle">Welcome back! Here's an overview of your vehicles and services.</x-slot>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-blue-500 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m6.75 4.5v.375c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H14.25a1.125 1.125 0 00-1.125 1.125v.375" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-600">My Vehicles</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $customerStats['total_vehicles'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-green-500 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-600">Completed Services</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $customerStats['completed_requests'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-yellow-500 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-600">Pending Services</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $customerStats['pending_requests'] + $customerStats['in_progress_requests'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-purple-500 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-600">Total Spent</h3>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($customerStats['total_spent'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('user.vehicles.create') }}" class="group bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 hover:shadow-md hover:border-blue-200 transition-all duration-200">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-blue-500 text-white group-hover:bg-blue-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Add Vehicle</h3>
                    <p class="text-sm text-gray-600">Register a new vehicle</p>
                </div>
            </div>
        </a>

        <a href="{{ route('user.services.create') }}" class="group bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 hover:shadow-md hover:border-green-200 transition-all duration-200">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-green-500 text-white group-hover:bg-green-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-green-600 transition-colors">Request Service</h3>
                    <p class="text-sm text-gray-600">Book a new service</p>
                </div>
            </div>
        </a>

        <a href="{{ route('user.vehicles.index') }}" class="group bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 hover:shadow-md hover:border-purple-200 transition-all duration-200">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-purple-500 text-white group-hover:bg-purple-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m6.75 4.5v.375c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H14.25a1.125 1.125 0 00-1.125 1.125v.375" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-purple-600 transition-colors">My Vehicles</h3>
                    <p class="text-sm text-gray-600">Manage vehicles</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Service Requests -->
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Service Requests</h3>
                    <a href="{{ route('user.services.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">View All</a>
                </div>
                
                @if($userServiceRequests->count() > 0)
                    <div class="space-y-4">
                        @foreach($userServiceRequests->take(5) as $request)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $request->service?->name ?? 'Service not found' }}</p>
                                    <p class="text-xs text-gray-500">
                                        @if($request->customerVehicle && $request->customerVehicle->vehicle)
                                            {{ $request->customerVehicle->vehicle->brand }} {{ $request->customerVehicle->vehicle->model }} - {{ $request->customerVehicle->license_plate }}
                                        @else
                                            Vehicle not found
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-400">{{ $request->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($request->status === 'completed') bg-green-100 text-green-700
                                    @elseif($request->status === 'in_progress') bg-blue-100 text-blue-700
                                    @elseif($request->status === 'confirmed') bg-yellow-100 text-yellow-700
                                    @else bg-gray-100 text-gray-700
                                    @endif">
                                    {{ ucfirst($request->status) }}
                                </span>
                                <a href="{{ route('user.services.show', $request) }}" class="text-blue-600 hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 mb-1">No service requests</h3>
                        <p class="text-sm text-gray-500 mb-4">Get started by requesting your first service.</p>
                        <a href="{{ route('user.services.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Request Service
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- My Vehicles -->
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">My Vehicles</h3>
                    <a href="{{ route('user.vehicles.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">View All</a>
                </div>
                
                @if($userVehicles->count() > 0)
                    <div class="space-y-4">
                        @foreach($userVehicles->take(3) as $vehicle)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m6.75 4.5v.375c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H14.25a1.125 1.125 0 00-1.125 1.125v.375" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $vehicle->vehicle->brand }} {{ $vehicle->vehicle->model }}</p>
                                    <p class="text-xs text-gray-500">{{ $vehicle->year }} - {{ $vehicle->color }}</p>
                                    <p class="text-xs text-gray-400">{{ $vehicle->license_plate }}</p>
                                </div>
                            </div>
                            <a href="{{ route('user.vehicles.show', $vehicle) }}" class="text-blue-600 hover:text-blue-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m6.75 4.5v.375c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H14.25a1.125 1.125 0 00-1.125 1.125v.375" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 mb-1">No vehicles registered</h3>
                        <p class="text-sm text-gray-500 mb-4">Add your first vehicle to get started.</p>
                        <a href="{{ route('user.vehicles.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Add Vehicle
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.dashboard>
