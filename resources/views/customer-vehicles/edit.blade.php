<x-layouts.dashboard>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Vehicle') }} - {{ $customerVehicle->vehicle->make }} {{ $customerVehicle->vehicle->model }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('customer-vehicles.show', $customerVehicle) }}" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    View Vehicle
                </a>
                <a href="{{ route('customer-vehicles.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Vehicles
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('customer-vehicles.update', $customerVehicle) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Customer Selection -->
                            <div class="md:col-span-2">
                                <x-input-label for="user_id" :value="__('Customer')" />
                                <select id="user_id" name="user_id" 
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                        required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ (old('user_id', $customerVehicle->user_id) == $customer->id) ? 'selected' : '' }}>
                                            {{ $customer->name }} - {{ $customer->email }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>

                            <!-- Vehicle Information (Read-only) -->
                            <div class="md:col-span-2 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-3">Vehicle Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                                    <div>
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Make:</span>
                                        <p class="text-gray-900 dark:text-gray-100">{{ $customerVehicle->vehicle->make }}</p>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Model:</span>
                                        <p class="text-gray-900 dark:text-gray-100">{{ $customerVehicle->vehicle->model }}</p>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Year:</span>
                                        <p class="text-gray-900 dark:text-gray-100">{{ $customerVehicle->vehicle->year }}</p>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Type:</span>
                                        <p class="text-gray-900 dark:text-gray-100 capitalize">{{ $customerVehicle->vehicle->type }}</p>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                    Note: Vehicle details cannot be modified. Contact administrator if changes are needed.
                                </p>
                            </div>

                            <!-- License Plate -->
                            <div>
                                <x-input-label for="license_plate" :value="__('License Plate')" />
                                <x-text-input id="license_plate" name="license_plate" type="text" class="mt-1 block w-full" 
                                              :value="old('license_plate', $customerVehicle->license_plate)" required />
                                <x-input-error :messages="$errors->get('license_plate')" class="mt-2" />
                            </div>

                            <!-- Current Mileage -->
                            <div>
                                <x-input-label for="current_mileage" :value="__('Current Mileage (km)')" />
                                <x-text-input id="current_mileage" name="current_mileage" type="number" min="0" class="mt-1 block w-full" 
                                              :value="old('current_mileage', $customerVehicle->current_mileage)" />
                                <x-input-error :messages="$errors->get('current_mileage')" class="mt-2" />
                            </div>

                            <!-- Purchase Date -->
                            <div>
                                <x-input-label for="purchase_date" :value="__('Purchase Date')" />
                                <x-text-input id="purchase_date" name="purchase_date" type="date" class="mt-1 block w-full" 
                                              :value="old('purchase_date', $customerVehicle->purchase_date?->format('Y-m-d'))" />
                                <x-input-error :messages="$errors->get('purchase_date')" class="mt-2" />
                            </div>

                            <!-- Insurance Expiry -->
                            <div>
                                <x-input-label for="insurance_expiry" :value="__('Insurance Expiry Date')" />
                                <x-text-input id="insurance_expiry" name="insurance_expiry" type="date" class="mt-1 block w-full" 
                                              :value="old('insurance_expiry', $customerVehicle->insurance_expiry?->format('Y-m-d'))" />
                                <x-input-error :messages="$errors->get('insurance_expiry')" class="mt-2" />
                                @if($customerVehicle->insurance_expiry && $customerVehicle->insurance_expiry->isPast())
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                        ⚠️ Insurance has expired on {{ $customerVehicle->insurance_expiry->format('F d, Y') }}
                                    </p>
                                @elseif($customerVehicle->insurance_expiry && $customerVehicle->insurance_expiry->diffInDays() <= 30)
                                    <p class="mt-1 text-sm text-yellow-600 dark:text-yellow-400">
                                        ⚠️ Insurance expires soon on {{ $customerVehicle->insurance_expiry->format('F d, Y') }}
                                    </p>
                                @endif
                            </div>

                            <!-- Vehicle Photos -->
                            <div class="md:col-span-2">
                                <x-input-label for="photos" :value="__('Vehicle Photos')" />
                                <input id="photos" name="photos[]" type="file" multiple accept="image/*" 
                                       class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" />
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    Upload new photos to replace existing ones (max 5 files, 2MB each).
                                </p>
                                <x-input-error :messages="$errors->get('photos')" class="mt-2" />
                                
                                <!-- Current Photos (if any) -->
                                <div class="mt-3">
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Current Photos:</p>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                                        <!-- Placeholder for existing photos -->
                                        <div class="aspect-square bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Photo management feature will be implemented in future updates.
                                    </p>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="md:col-span-2">
                                <x-input-label for="notes" :value="__('Notes')" />
                                <textarea id="notes" name="notes" rows="4" 
                                          class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                          placeholder="Any additional information about the vehicle...">{{ old('notes', $customerVehicle->notes) }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                            </div>

                            <!-- Last Updated Info -->
                            <div class="md:col-span-2 bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
                                <h4 class="font-medium text-blue-900 dark:text-blue-100 mb-2">Record Information</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="font-medium text-blue-700 dark:text-blue-300">Added:</span>
                                        <p class="text-blue-900 dark:text-blue-100">{{ $customerVehicle->created_at->format('F d, Y H:i') }}</p>
                                    </div>
                                    <div>
                                        <span class="font-medium text-blue-700 dark:text-blue-300">Last Updated:</span>
                                        <p class="text-blue-900 dark:text-blue-100">{{ $customerVehicle->updated_at->format('F d, Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 space-x-4">
                            <a href="{{ route('customer-vehicles.show', $customerVehicle) }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Update Vehicle') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
