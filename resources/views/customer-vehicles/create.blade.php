<x-layouts.dashboard>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Add New Vehicle') }}
            </h2>
            <a href="{{ route('customer-vehicles.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Vehicles
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('customer-vehicles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Customer Selection -->
                            <div class="md:col-span-2">
                                <x-input-label for="user_id" :value="__('Customer')" />
                                <select id="user_id" name="user_id" 
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                        required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('user_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }} - {{ $customer->email }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>

                            <!-- Vehicle Selection -->
                            <div class="md:col-span-2">
                                <x-input-label for="vehicle_id" :value="__('Vehicle')" />
                                <select id="vehicle_id" name="vehicle_id" 
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                        required>
                                    <option value="">Select Vehicle</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->make }} {{ $vehicle->model }} ({{ $vehicle->year }}) - {{ ucfirst($vehicle->type) }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('vehicle_id')" class="mt-2" />
                                
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    Don't see the vehicle you're looking for? 
                                    <button type="button" onclick="toggleNewVehicleForm()" 
                                            class="text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                        Add a new vehicle
                                    </button>
                                </p>
                            </div>

                            <!-- New Vehicle Form (Hidden by default) -->
                            <div id="newVehicleForm" class="md:col-span-2 hidden border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Add New Vehicle</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <x-input-label for="new_make" :value="__('Make')" />
                                        <x-text-input id="new_make" name="new_make" type="text" class="mt-1 block w-full" :value="old('new_make')" />
                                        <x-input-error :messages="$errors->get('new_make')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="new_model" :value="__('Model')" />
                                        <x-text-input id="new_model" name="new_model" type="text" class="mt-1 block w-full" :value="old('new_model')" />
                                        <x-input-error :messages="$errors->get('new_model')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="new_year" :value="__('Year')" />
                                        <select id="new_year" name="new_year" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            <option value="">Select Year</option>
                                            @for($year = date('Y'); $year >= 1980; $year--)
                                                <option value="{{ $year }}" {{ old('new_year') == $year ? 'selected' : '' }}>
                                                    {{ $year }}
                                                </option>
                                            @endfor
                                        </select>
                                        <x-input-error :messages="$errors->get('new_year')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="new_type" :value="__('Type')" />
                                        <select id="new_type" name="new_type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            <option value="">Select Type</option>
                                            <option value="car" {{ old('new_type') == 'car' ? 'selected' : '' }}>Car</option>
                                            <option value="motorcycle" {{ old('new_type') == 'motorcycle' ? 'selected' : '' }}>Motorcycle</option>
                                            <option value="truck" {{ old('new_type') == 'truck' ? 'selected' : '' }}>Truck</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('new_type')" class="mt-2" />
                                    </div>

                                    <div class="md:col-span-2">
                                        <x-input-label for="new_engine" :value="__('Engine')" />
                                        <x-text-input id="new_engine" name="new_engine" type="text" class="mt-1 block w-full" :value="old('new_engine')" placeholder="e.g., 1.5L Turbo" />
                                        <x-input-error :messages="$errors->get('new_engine')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- License Plate -->
                            <div>
                                <x-input-label for="license_plate" :value="__('License Plate')" />
                                <x-text-input id="license_plate" name="license_plate" type="text" class="mt-1 block w-full" :value="old('license_plate')" required />
                                <x-input-error :messages="$errors->get('license_plate')" class="mt-2" />
                            </div>

                            <!-- Current Mileage -->
                            <div>
                                <x-input-label for="current_mileage" :value="__('Current Mileage (km)')" />
                                <x-text-input id="current_mileage" name="current_mileage" type="number" min="0" class="mt-1 block w-full" :value="old('current_mileage')" />
                                <x-input-error :messages="$errors->get('current_mileage')" class="mt-2" />
                            </div>

                            <!-- Purchase Date -->
                            <div>
                                <x-input-label for="purchase_date" :value="__('Purchase Date')" />
                                <x-text-input id="purchase_date" name="purchase_date" type="date" class="mt-1 block w-full" :value="old('purchase_date')" />
                                <x-input-error :messages="$errors->get('purchase_date')" class="mt-2" />
                            </div>

                            <!-- Insurance Expiry -->
                            <div>
                                <x-input-label for="insurance_expiry" :value="__('Insurance Expiry Date')" />
                                <x-text-input id="insurance_expiry" name="insurance_expiry" type="date" class="mt-1 block w-full" :value="old('insurance_expiry')" />
                                <x-input-error :messages="$errors->get('insurance_expiry')" class="mt-2" />
                            </div>

                            <!-- Vehicle Photos -->
                            <div class="md:col-span-2">
                                <x-input-label for="photos" :value="__('Vehicle Photos')" />
                                <input id="photos" name="photos[]" type="file" multiple accept="image/*" 
                                       class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" />
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    You can upload multiple photos of the vehicle (max 5 files, 2MB each).
                                </p>
                                <x-input-error :messages="$errors->get('photos')" class="mt-2" />
                            </div>

                            <!-- Notes -->
                            <div class="md:col-span-2">
                                <x-input-label for="notes" :value="__('Notes')" />
                                <textarea id="notes" name="notes" rows="4" 
                                          class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                          placeholder="Any additional information about the vehicle...">{{ old('notes') }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 space-x-4">
                            <a href="{{ route('customer-vehicles.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Add Vehicle') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleNewVehicleForm() {
            const form = document.getElementById('newVehicleForm');
            const vehicleSelect = document.getElementById('vehicle_id');
            
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
                vehicleSelect.required = false;
                vehicleSelect.value = '';
            } else {
                form.classList.add('hidden');
                vehicleSelect.required = true;
                // Clear new vehicle form
                document.getElementById('new_make').value = '';
                document.getElementById('new_model').value = '';
                document.getElementById('new_year').value = '';
                document.getElementById('new_type').value = '';
                document.getElementById('new_engine').value = '';
            }
        }
    </script>
</x-layouts.dashboard>
