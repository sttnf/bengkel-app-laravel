<x-layouts.dashboard>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create New Service') }}
            </h2>
            <a href="{{ route('services.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Services
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('services.store') }}" class="space-y-6">
                        @csrf

                        <!-- Service Name -->
                        <div>
                            <x-input-label for="name" :value="__('Service Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Category -->
                        <div>
                            <x-input-label for="category" :value="__('Category')" />
                            <select id="category" name="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">Select Category</option>
                                <option value="Maintenance" {{ old('category') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="Repair" {{ old('category') == 'Repair' ? 'selected' : '' }}>Repair</option>
                                <option value="Diagnostics" {{ old('category') == 'Diagnostics' ? 'selected' : '' }}>Diagnostics</option>
                                <option value="Bodywork" {{ old('category') == 'Bodywork' ? 'selected' : '' }}>Bodywork</option>
                                <option value="Electrical" {{ old('category') == 'Electrical' ? 'selected' : '' }}>Electrical</option>
                                <option value="Tire Service" {{ old('category') == 'Tire Service' ? 'selected' : '' }}>Tire Service</option>
                                <option value="Oil Change" {{ old('category') == 'Oil Change' ? 'selected' : '' }}>Oil Change</option>
                                <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Base Price -->
                            <div>
                                <x-input-label for="base_price" :value="__('Base Price (IDR)')" />
                                <x-text-input id="base_price" class="block mt-1 w-full" type="number" name="base_price" :value="old('base_price')" min="0" step="1000" required />
                                <x-input-error :messages="$errors->get('base_price')" class="mt-2" />
                                <p class="text-sm text-gray-500 mt-1">Enter price in Indonesian Rupiah</p>
                            </div>

                            <!-- Estimated Hours -->
                            <div>
                                <x-input-label for="estimated_hours" :value="__('Estimated Duration (Hours)')" />
                                <x-text-input id="estimated_hours" class="block mt-1 w-full" type="number" name="estimated_hours" :value="old('estimated_hours')" min="0.5" step="0.5" required />
                                <x-input-error :messages="$errors->get('estimated_hours')" class="mt-2" />
                                <p class="text-sm text-gray-500 mt-1">How many hours will this service take?</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" placeholder="Describe what this service includes...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Service Features Section -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Service Preview</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Service Category:</span>
                                    <span id="preview-category" class="text-sm text-gray-500">Not selected</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Estimated Cost:</span>
                                    <span id="preview-price" class="text-sm text-gray-500">IDR 0</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Duration:</span>
                                    <span id="preview-duration" class="text-sm text-gray-500">0 hours</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('services.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Create Service') }}
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
            
            // Initial update
            updatePreview();
        });
    </script>
</x-layouts.dashboard>
