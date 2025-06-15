<x-layouts.dashboard>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Inventory Item') }}
            </h2>
            <a href="{{ route('inventory.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Inventory
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('inventory.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Item Name -->
                            <div>
                                <x-input-label for="name" :value="__('Item Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Part Number -->
                            <div>
                                <x-input-label for="part_number" :value="__('Part Number')" />
                                <x-text-input id="part_number" class="block mt-1 w-full" type="text" name="part_number" :value="old('part_number')" />
                                <x-input-error :messages="$errors->get('part_number')" class="mt-2" />
                                <p class="text-sm text-gray-500 mt-1">Optional unique identifier</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Category -->
                            <div>
                                <x-input-label for="category" :value="__('Category')" />
                                <select id="category" name="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select Category</option>
                                    <option value="Engine Parts" {{ old('category') == 'Engine Parts' ? 'selected' : '' }}>Engine Parts</option>
                                    <option value="Brake Parts" {{ old('category') == 'Brake Parts' ? 'selected' : '' }}>Brake Parts</option>
                                    <option value="Electrical" {{ old('category') == 'Electrical' ? 'selected' : '' }}>Electrical</option>
                                    <option value="Filters" {{ old('category') == 'Filters' ? 'selected' : '' }}>Filters</option>
                                    <option value="Fluids" {{ old('category') == 'Fluids' ? 'selected' : '' }}>Fluids</option>
                                    <option value="Tires" {{ old('category') == 'Tires' ? 'selected' : '' }}>Tires</option>
                                    <option value="Tools" {{ old('category') == 'Tools' ? 'selected' : '' }}>Tools</option>
                                    <option value="Accessories" {{ old('category') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                                    <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>

                            <!-- Unit -->
                            <div>
                                <x-input-label for="unit" :value="__('Unit of Measurement')" />
                                <select id="unit" name="unit" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                    <option value="">Select Unit</option>
                                    <option value="pcs" {{ old('unit') == 'pcs' ? 'selected' : '' }}>Pieces</option>
                                    <option value="liter" {{ old('unit') == 'liter' ? 'selected' : '' }}>Liter</option>
                                    <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>Kilogram</option>
                                    <option value="meter" {{ old('unit') == 'meter' ? 'selected' : '' }}>Meter</option>
                                    <option value="box" {{ old('unit') == 'box' ? 'selected' : '' }}>Box</option>
                                    <option value="bottle" {{ old('unit') == 'bottle' ? 'selected' : '' }}>Bottle</option>
                                    <option value="set" {{ old('unit') == 'set' ? 'selected' : '' }}>Set</option>
                                </select>
                                <x-input-error :messages="$errors->get('unit')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Unit Price -->
                            <div>
                                <x-input-label for="unit_price" :value="__('Unit Price (IDR)')" />
                                <x-text-input id="unit_price" class="block mt-1 w-full" type="number" name="unit_price" :value="old('unit_price')" min="0" step="100" required />
                                <x-input-error :messages="$errors->get('unit_price')" class="mt-2" />
                            </div>

                            <!-- Current Stock -->
                            <div>
                                <x-input-label for="current_stock" :value="__('Current Stock')" />
                                <x-text-input id="current_stock" class="block mt-1 w-full" type="number" name="current_stock" :value="old('current_stock')" min="0" required />
                                <x-input-error :messages="$errors->get('current_stock')" class="mt-2" />
                            </div>

                            <!-- Reorder Level -->
                            <div>
                                <x-input-label for="reorder_level" :value="__('Reorder Level')" />
                                <x-text-input id="reorder_level" class="block mt-1 w-full" type="number" name="reorder_level" :value="old('reorder_level')" min="0" required />
                                <x-input-error :messages="$errors->get('reorder_level')" class="mt-2" />
                                <p class="text-sm text-gray-500 mt-1">Minimum stock before reordering</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Supplier -->
                            <div>
                                <x-input-label for="supplier" :value="__('Supplier')" />
                                <x-text-input id="supplier" class="block mt-1 w-full" type="text" name="supplier" :value="old('supplier')" />
                                <x-input-error :messages="$errors->get('supplier')" class="mt-2" />
                            </div>

                            <!-- Location -->
                            <div>
                                <x-input-label for="location" :value="__('Storage Location')" />
                                <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" placeholder="e.g., Shelf A1, Warehouse 2" />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Inventory Preview -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Inventory Item Preview</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Item:</span>
                                        <span id="preview-name" class="text-sm text-gray-500">Not entered</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Category:</span>
                                        <span id="preview-category" class="text-sm text-gray-500">Not selected</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Unit Price:</span>
                                        <span id="preview-price" class="text-sm text-gray-500">IDR 0</span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Current Stock:</span>
                                        <span id="preview-stock" class="text-sm text-gray-500">0</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Reorder Level:</span>
                                        <span id="preview-reorder" class="text-sm text-gray-500">0</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Total Value:</span>
                                        <span id="preview-total" class="text-sm font-weight text-green-600">IDR 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('inventory.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Add Item') }}
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
            const nameInput = document.getElementById('name');
            const categorySelect = document.getElementById('category');
            const priceInput = document.getElementById('unit_price');
            const stockInput = document.getElementById('current_stock');
            const reorderInput = document.getElementById('reorder_level');
            
            const previewName = document.getElementById('preview-name');
            const previewCategory = document.getElementById('preview-category');
            const previewPrice = document.getElementById('preview-price');
            const previewStock = document.getElementById('preview-stock');
            const previewReorder = document.getElementById('preview-reorder');
            const previewTotal = document.getElementById('preview-total');

            function updatePreview() {
                // Update name
                previewName.textContent = nameInput.value || 'Not entered';
                
                // Update category
                previewCategory.textContent = categorySelect.value || 'Not selected';
                
                // Update price
                const price = parseInt(priceInput.value) || 0;
                previewPrice.textContent = 'IDR ' + price.toLocaleString('id-ID');
                
                // Update stock
                const stock = parseInt(stockInput.value) || 0;
                previewStock.textContent = stock.toString();
                
                // Update reorder level
                const reorder = parseInt(reorderInput.value) || 0;
                previewReorder.textContent = reorder.toString();
                
                // Update total value
                const total = price * stock;
                previewTotal.textContent = 'IDR ' + total.toLocaleString('id-ID');
            }

            // Add event listeners
            nameInput.addEventListener('input', updatePreview);
            categorySelect.addEventListener('change', updatePreview);
            priceInput.addEventListener('input', updatePreview);
            stockInput.addEventListener('input', updatePreview);
            reorderInput.addEventListener('input', updatePreview);
            
            // Initial update
            updatePreview();
        });
    </script>
</x-layouts.dashboard>
