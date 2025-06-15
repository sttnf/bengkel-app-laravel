<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Vehicles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">My Vehicles</h3>
                        <a href="{{ route('user.vehicles.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Add Vehicle
                        </a>
                    </div>

                    @if($userVehicles->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($userVehicles as $vehicle)
                            <div class="border dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition duration-150 ease-in-out">
                                <div class="flex items-center mb-4">
                                    <div class="p-3 rounded-full bg-blue-500 text-white">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $vehicle->vehicle->brand }} {{ $vehicle->vehicle->model }}</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $vehicle->year }} - {{ $vehicle->color }}</p>
                                    </div>
                                </div>

                                <div class="space-y-2 mb-4">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">License Plate:</span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $vehicle->license_plate }}</span>
                                    </div>
                                    @if($vehicle->mileage)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Mileage:</span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($vehicle->mileage) }} km</span>
                                    </div>
                                    @endif
                                    @if($vehicle->purchase_date)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Purchase Date:</span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $vehicle->purchase_date->format('M d, Y') }}</span>
                                    </div>
                                    @endif
                                </div>

                                <div class="flex space-x-2">
                                    <a href="{{ route('user.vehicles.show', $vehicle) }}" class="flex-1 text-center px-3 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition duration-150 ease-in-out">
                                        View Details
                                    </a>
                                    <a href="{{ route('user.vehicles.edit', $vehicle) }}" class="flex-1 text-center px-3 py-2 bg-gray-600 text-white text-sm rounded hover:bg-gray-700 transition duration-150 ease-in-out">
                                        Edit
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $userVehicles->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No vehicles registered</h3>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">Add your first vehicle to start managing your automotive services.</p>
                            <div class="mt-6">
                                <a href="{{ route('user.vehicles.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    Add Your First Vehicle
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
