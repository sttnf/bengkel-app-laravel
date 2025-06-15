<x-layouts.dashboard>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Service Details') }}: {{ $service->name }}
                </h2>
                <nav class="flex mt-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <a href="{{ route('services.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Services</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{ $service->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('services.edit', $service) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit Service
                </a>
                <a href="{{ route('services.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Services
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Service Information -->
                <div class="lg:col-span-2 space-y-6">                    <!-- Basic Information Card -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-6">Service Information</h3>
                            
                            <!-- Service Header with Status -->
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $service->name }}</h1>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $service->category ?? 'General Service' }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $service->is_active ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Price Information -->
                                <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                                    <div class="text-center">
                                        <svg class="w-8 h-8 text-green-600 dark:text-green-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Base Price</p>
                                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                                            Rp {{ number_format($service->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Duration Information -->
                                <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
                                    <div class="text-center">
                                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Est. Duration</p>
                                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                            {{ $service->estimated_duration ?? 'TBD' }}
                                            @if($service->estimated_duration) hours @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Request Count -->
                                <div class="bg-purple-50 dark:bg-purple-900 p-4 rounded-lg">
                                    <div class="text-center">
                                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Requests</p>
                                        <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                                            {{ $service->serviceRequests->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            @if($service->description)
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <p class="text-gray-700 dark:text-gray-300">{{ $service->description }}</p>
                                </div>
                            </div>
                            @endif

                            <div class="mt-6 grid grid-cols-2 gap-4 text-sm text-gray-500 dark:text-gray-400 border-t dark:border-gray-700 pt-4">
                                <div>
                                    <span class="font-medium">Created:</span>
                                    {{ $service->created_at->format('M d, Y H:i') }}
                                </div>
                                <div>
                                    <span class="font-medium">Last Updated:</span>
                                    {{ $service->updated_at->format('M d, Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Analytics -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-4">Service Analytics</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="bg-gradient-to-r from-green-400 to-green-600 rounded-lg p-4 text-white">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-green-100 text-sm">Completed</p>
                                            <p class="text-2xl font-bold">{{ $service->serviceRequests->where('status', 'completed')->count() }}</p>
                                        </div>
                                        <svg class="w-8 h-8 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg p-4 text-white">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-blue-100 text-sm">In Progress</p>
                                            <p class="text-2xl font-bold">{{ $service->serviceRequests->where('status', 'in_progress')->count() }}</p>
                                        </div>
                                        <svg class="w-8 h-8 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-lg p-4 text-white">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-yellow-100 text-sm">Pending</p>
                                            <p class="text-2xl font-bold">{{ $service->serviceRequests->where('status', 'pending')->count() }}</p>
                                        </div>
                                        <svg class="w-8 h-8 text-yellow-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-r from-purple-400 to-purple-600 rounded-lg p-4 text-white">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-purple-100 text-sm">Total Revenue</p>
                                            <p class="text-xl font-bold">Rp {{ number_format($service->serviceRequests->where('status', 'completed')->sum('total_cost'), 0, ',', '.') }}</p>
                                        </div>
                                        <svg class="w-8 h-8 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Requests History -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Service Requests</h3>
                                <span class="text-sm text-gray-500">
                                    {{ $service->serviceRequests->count() }} total requests
                                </span>
                            </div>
                            
                            @if($service->serviceRequests->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($service->serviceRequests->take(10) as $request)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $request->user->name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $request->user->email }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($request->customerVehicle)
                                                            <div class="text-sm text-gray-900">
                                                                {{ $request->customerVehicle->vehicle->brand }} {{ $request->customerVehicle->vehicle->model }}
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                {{ $request->customerVehicle->license_plate }}
                                                            </div>
                                                        @else
                                                            <span class="text-sm text-gray-500">Vehicle not specified</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        {{ $request->scheduled_datetime ? \Carbon\Carbon::parse($request->scheduled_datetime)->format('M d, Y H:i') : 'Not scheduled' }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @php
                                                            $statusColors = [
                                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                                'confirmed' => 'bg-blue-100 text-blue-800',
                                                                'in_progress' => 'bg-indigo-100 text-indigo-800',
                                                                'completed' => 'bg-green-100 text-green-800',
                                                                'cancelled' => 'bg-red-100 text-red-800',
                                                            ];
                                                        @endphp
                                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$request->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                            {{ ucfirst($request->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                @if($service->serviceRequests->count() > 10)
                                    <div class="mt-4 text-center">
                                        <p class="text-sm text-gray-500">
                                            Showing 10 of {{ $service->serviceRequests->count() }} requests
                                        </p>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No service requests</h3>
                                    <p class="mt-1 text-sm text-gray-500">This service hasn't been requested yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Statistics Sidebar -->
                <div class="space-y-6">
                    <!-- Service Statistics -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-semibold mb-4">Service Statistics</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Total Requests:</span>
                                    <span class="text-lg font-bold text-blue-600">{{ $service->serviceRequests->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Completed:</span>
                                    <span class="text-lg font-bold text-green-600">{{ $service->serviceRequests->where('status', 'completed')->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">In Progress:</span>
                                    <span class="text-lg font-bold text-indigo-600">{{ $service->serviceRequests->where('status', 'in_progress')->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Pending:</span>
                                    <span class="text-lg font-bold text-yellow-600">{{ $service->serviceRequests->where('status', 'pending')->count() }}</span>
                                </div>
                            </div>
                            
                            @php
                                $totalRevenue = $service->serviceRequests->where('status', 'completed')->sum('final_price') ?: $service->serviceRequests->where('status', 'completed')->count() * $service->base_price;
                            @endphp
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Est. Revenue:</span>
                                    <span class="text-lg font-bold text-green-600">
                                        IDR {{ number_format($totalRevenue, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <a href="{{ route('services.edit', $service) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit Service
                                </a>
                                
                                @if($service->serviceRequests->count() === 0)
                                    <form method="POST" action="{{ route('services.destroy', $service) }}" onsubmit="return confirm('Are you sure you want to delete this service?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete Service
                                        </button>
                                    </form>
                                @else
                                    <div class="text-center text-sm text-gray-500">
                                        Cannot delete service with existing requests
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
