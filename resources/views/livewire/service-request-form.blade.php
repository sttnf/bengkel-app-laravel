<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Create Service Request</h2>
        <p class="text-gray-600 mt-1">Fill in the details to create a new service request</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Customer Selection -->
            <div>
                <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Customer *
                </label>
                <select wire:model.live="customer_id" id="customer_id" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
                    @endforeach
                </select>
                @error('customer_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Vehicle Selection -->
            <div>
                <label for="vehicle_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Vehicle *
                </label>
                <select wire:model="vehicle_id" id="vehicle_id" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        {{ empty($customerVehicles) ? 'disabled' : '' }}>
                    <option value="">Select Vehicle</option>
                    @foreach($customerVehicles as $customerVehicle)
                        <option value="{{ $customerVehicle->id }}">
                            {{ $customerVehicle->vehicle->brand }} {{ $customerVehicle->vehicle->model }} 
                            ({{ $customerVehicle->year }}) - {{ $customerVehicle->license_plate }}
                        </option>
                    @endforeach
                </select>
                @error('vehicle_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Service Selection -->
            <div>
                <label for="service_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Service *
                </label>
                <select wire:model="service_id" id="service_id" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Service</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">
                            {{ $service->name }} - ${{ number_format($service->price, 2) }}
                        </option>
                    @endforeach
                </select>
                @error('service_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Technician Selection -->
            <div>
                <label for="technician_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Technician (Optional)
                </label>
                <select wire:model="technician_id" id="technician_id" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Auto Assign</option>
                    @foreach($technicians as $technician)
                        <option value="{{ $technician->id }}">
                            {{ $technician->name }} - {{ $technician->specialization }}
                        </option>
                    @endforeach
                </select>
                @error('technician_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Scheduled Date -->
            <div>
                <label for="scheduled_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Scheduled Date *
                </label>
                <input type="datetime-local" wire:model="scheduled_date" id="scheduled_date"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('scheduled_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Estimated Completion -->
            <div>
                <label for="estimated_completion" class="block text-sm font-medium text-gray-700 mb-2">
                    Estimated Completion
                </label>
                <input type="datetime-local" wire:model="estimated_completion" id="estimated_completion"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('estimated_completion') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                Description *
            </label>
            <textarea wire:model="description" id="description" rows="4" 
                      class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                      placeholder="Describe the service requirements, issues, or special instructions..."></textarea>
            @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('service-requests.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
            </a>
            <button type="submit" 
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create Service Request
            </button>
        </div>
    </form>
</div>
