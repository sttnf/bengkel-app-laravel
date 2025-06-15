<x-layouts.dashboard>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Service') }}: {{ $service->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('services.show', $service) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    View Service
                </a>
                <a href="{{ route('services.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Services
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Service Information Header -->
                    <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                        <h3 class="text-lg font-semibold text-blue-900 mb-2">Current Service Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <span class="font-medium text-blue-700">Requests:</span>
                                <span class="text-blue-600">{{ $service->serviceRequests->count() }} total</span>
                            </div>
                            <div>
                                <span class="font-medium text-blue-700">Completed:</span>
                                <span class="text-blue-600">{{ $service->serviceRequests->where('status', 'completed')->count() }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-blue-700">Revenue:</span>
                                <span class="text-blue-600">IDR {{ number_format($service->serviceRequests->where('status', 'completed')->count() * $service->base_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('services.update', $service) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Service Name -->
                        <div>
                            <x-input-label for="name" :value="__('Service Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $service->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Category -->
                        <div>
                            <x-input-label for="category" :value="__('Category')" />
                            <select id="category" name="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">Select Category</option>
                                <option value="Maintenance" {{ old('category', $service->category) == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="Repair" {{ old('category', $service->category) == 'Repair' ? 'selected' : '' }}>Repair</option>
                                <option value="Diagnostics" {{ old('category', $service->category) == 'Diagnostics' ? 'selected' : '' }}>Diagnostics</option>
                                <option value="Bodywork" {{ old('category', $service->category) == 'Bodywork' ? 'selected' : '' }}>Bodywork</option>
                                <option value="Electrical" {{ old('category', $service->category) == 'Electrical' ? 'selected' : '' }}>Electrical</option>
                                <option value="Tire Service" {{ old('category', $service->category) == 'Tire Service' ? 'selected' : '' }}>Tire Service</option>
                                <option value="Oil Change" {{ old('category', $service->category) == 'Oil Change' ? 'selected' : '' }}>Oil Change</option>
                                <option value="Other" {{ old('category', $service->category) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Base Price -->
                            <div>
                                <x-input-label for="base_price" :value="__('Base Price (IDR)')" />
                                <x-text-input id="base_price" class="block mt-1 w-full" type="number" name="base_price" :value="old('base_price', $service->base_price)" min="0" step="1000" required />
                                <x-input-error :messages="$errors->get('base_price')" class="mt-2" />
                                <p class="text-sm text-gray-500 mt-1">Enter price in Indonesian Rupiah</p>
                            </div>

                            <!-- Estimated Hours -->
                            <div>
                                <x-input-label for="estimated_hours" :value="__('Estimated Duration (Hours)')" />
                                <x-text-input id="estimated_hours" class="block mt-1 w-full" type="number" name="estimated_hours" :value="old('estimated_hours', $service->estimated_hours)" min="0.5" step="0.5" required />
                                <x-input-error :messages="$errors->get('estimated_hours')" class="mt-2" />
                                <p class="text-sm text-gray-500 mt-1">How many hours will this service take?</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" placeholder="Describe what this service includes...">{{ old('description', $service->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Service Preview Section -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Updated Service Preview</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Service Category:</span>
                                    <span id="preview-category" class="text-sm text-gray-500">{{ $service->category }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Estimated Cost:</span>
                                    <span id="preview-price" class="text-sm text-gray-500">IDR {{ number_format($service->base_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Duration:</span>
                                    <span id="preview-duration" class="text-sm text-gray-500">{{ $service->estimated_hours }} hours</span>
                                </div>
                            </div>
                        </div>

                        <!-- Warning for Services with Requests -->
                        @if($service->serviceRequests->count() > 0)
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            <strong>Notice:</strong> This service has {{ $service->serviceRequests->count() }} existing request(s). 
                                            Price changes will only affect new requests.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('services.show', $service) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Update Service') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Live preview functionality
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category');
            const priceInput = document.getElementById('base_price');
            const durationInput = document.getElementById('estimated_hours');
            
            const previewCategory = document.getElementById('preview-category');
            const previewPrice = document.getElementById('preview-price');
            const previewDuration = document.getElementById('preview-duration');

            function updatePreview() {
                // Update category
                previewCategory.textContent = categorySelect.value || 'Not selected';
                
                // Update price
                const price = parseInt(priceInput.value) || 0;
                previewPrice.textContent = 'IDR ' + price.toLocaleString('id-ID');
                
                // Update duration
                const duration = parseFloat(durationInput.value) || 0;
                previewDuration.textContent = duration + ' hour' + (duration !== 1 ? 's' : '');
            }

            categorySelect.addEventListener('change', updatePreview);
            priceInput.addEventListener('input', updatePreview);
            durationInput.addEventListener('input', updatePreview);
            
            // Initial update with current values
            updatePreview();
        });
    </script>
</x-layouts.dashboard>
