@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Inventory Item</h1>
                    <nav class="flex mt-2" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="{{ route('inventory.index') }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">Inventory</a>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="{{ route('inventory.show', $inventoryItem) }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">{{ $inventoryItem->name }}</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-1 text-gray-500 md:ml-2">Edit</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
                <a href="{{ route('inventory.show', $inventoryItem) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Item
                </a>
            </div>
        </div>

        <!-- Warning Alert for Items with Usage -->
        @if($inventoryItem->current_stock < $inventoryItem->reorder_level)
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Low Stock Alert</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>This item is currently below its reorder level. Current stock: {{ $inventoryItem->current_stock }}, Reorder level: {{ $inventoryItem->reorder_level }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Item Information</h2>
                    
                    <form action="{{ route('inventory.update', $inventoryItem) }}" method="POST" id="inventoryForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Item Name -->
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Item Name *</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $inventoryItem->name) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                       placeholder="Enter item name">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                <select id="category" name="category" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category') border-red-500 @enderror">
                                    <option value="">Select category</option>
                                    <option value="Spare Parts" {{ old('category', $inventoryItem->category) == 'Spare Parts' ? 'selected' : '' }}>Spare Parts</option>
                                    <option value="Tools" {{ old('category', $inventoryItem->category) == 'Tools' ? 'selected' : '' }}>Tools</option>
                                    <option value="Consumables" {{ old('category', $inventoryItem->category) == 'Consumables' ? 'selected' : '' }}>Consumables</option>
                                    <option value="Lubricants" {{ old('category', $inventoryItem->category) == 'Lubricants' ? 'selected' : '' }}>Lubricants</option>
                                    <option value="Electronics" {{ old('category', $inventoryItem->category) == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                                    <option value="Other" {{ old('category', $inventoryItem->category) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('category')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Part Number -->
                            <div>
                                <label for="part_number" class="block text-sm font-medium text-gray-700 mb-2">Part Number</label>
                                <input type="text" id="part_number" name="part_number" value="{{ old('part_number', $inventoryItem->part_number) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('part_number') border-red-500 @enderror"
                                       placeholder="Enter part number">
                                @error('part_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Unit Price -->
                            <div>
                                <label for="unit_price" class="block text-sm font-medium text-gray-700 mb-2">Unit Price (Rp) *</label>
                                <input type="number" id="unit_price" name="unit_price" value="{{ old('unit_price', $inventoryItem->unit_price) }}" 
                                       min="0" step="0.01" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('unit_price') border-red-500 @enderror"
                                       placeholder="0.00">
                                @error('unit_price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Unit -->
                            <div>
                                <label for="unit" class="block text-sm font-medium text-gray-700 mb-2">Unit *</label>
                                <select id="unit" name="unit" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('unit') border-red-500 @enderror">
                                    <option value="">Select unit</option>
                                    <option value="pcs" {{ old('unit', $inventoryItem->unit) == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                                    <option value="liter" {{ old('unit', $inventoryItem->unit) == 'liter' ? 'selected' : '' }}>Liter</option>
                                    <option value="kg" {{ old('unit', $inventoryItem->unit) == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                                    <option value="meter" {{ old('unit', $inventoryItem->unit) == 'meter' ? 'selected' : '' }}>Meter</option>
                                    <option value="box" {{ old('unit', $inventoryItem->unit) == 'box' ? 'selected' : '' }}>Box</option>
                                    <option value="bottle" {{ old('unit', $inventoryItem->unit) == 'bottle' ? 'selected' : '' }}>Bottle</option>
                                    <option value="pack" {{ old('unit', $inventoryItem->unit) == 'pack' ? 'selected' : '' }}>Pack</option>
                                </select>
                                @error('unit')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Current Stock -->
                            <div>
                                <label for="current_stock" class="block text-sm font-medium text-gray-700 mb-2">Current Stock *</label>
                                <input type="number" id="current_stock" name="current_stock" value="{{ old('current_stock', $inventoryItem->current_stock) }}" 
                                       min="0" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('current_stock') border-red-500 @enderror"
                                       placeholder="0">
                                @error('current_stock')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Reorder Level -->
                            <div>
                                <label for="reorder_level" class="block text-sm font-medium text-gray-700 mb-2">Reorder Level *</label>
                                <input type="number" id="reorder_level" name="reorder_level" value="{{ old('reorder_level', $inventoryItem->reorder_level) }}" 
                                       min="0" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('reorder_level') border-red-500 @enderror"
                                       placeholder="0">
                                @error('reorder_level')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Supplier -->
                            <div>
                                <label for="supplier" class="block text-sm font-medium text-gray-700 mb-2">Supplier</label>
                                <input type="text" id="supplier" name="supplier" value="{{ old('supplier', $inventoryItem->supplier) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('supplier') border-red-500 @enderror"
                                       placeholder="Enter supplier name">
                                @error('supplier')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Storage Location</label>
                                <input type="text" id="location" name="location" value="{{ old('location', $inventoryItem->location) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('location') border-red-500 @enderror"
                                       placeholder="e.g., Warehouse A, Shelf B-3">
                                @error('location')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-between pt-6 mt-6 border-t border-gray-200">
                            <button type="button" onclick="confirmDelete()" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1H8a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete Item
                            </button>
                            <div class="flex space-x-3">
                                <a href="{{ route('inventory.show', $inventoryItem) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-medium transition-colors">
                                    Cancel
                                </a>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Update Item
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar - Preview -->
            <div class="space-y-6">
                <!-- Current Item Preview -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Information</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Name:</span>
                            <span class="font-medium">{{ $inventoryItem->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Category:</span>
                            <span class="font-medium">{{ $inventoryItem->category ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Unit Price:</span>
                            <span class="font-medium text-green-600">Rp {{ number_format($inventoryItem->unit_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Current Stock:</span>
                            <span class="font-medium {{ $inventoryItem->isLowStock() ? 'text-red-600' : 'text-green-600' }}">
                                {{ $inventoryItem->current_stock }} {{ $inventoryItem->unit }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Value:</span>
                            <span class="font-semibold text-green-600">Rp {{ number_format($inventoryItem->getTotalValue(), 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Live Preview -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Live Preview</h3>
                    <div class="space-y-3 text-sm" id="livePreview">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Name:</span>
                            <span class="font-medium" id="preview-name">{{ $inventoryItem->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Category:</span>
                            <span class="font-medium" id="preview-category">{{ $inventoryItem->category ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Unit Price:</span>
                            <span class="font-medium text-green-600" id="preview-price">Rp {{ number_format($inventoryItem->unit_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Stock:</span>
                            <span class="font-medium" id="preview-stock">{{ $inventoryItem->current_stock }} {{ $inventoryItem->unit }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Value:</span>
                            <span class="font-semibold text-green-600" id="preview-total">Rp {{ number_format($inventoryItem->getTotalValue(), 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Stock Status -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Stock Status</h3>
                    <div class="text-center p-4 rounded-lg {{ $inventoryItem->isLowStock() ? 'bg-red-50 border border-red-200' : 'bg-green-50 border border-green-200' }}">
                        <div class="text-2xl font-bold {{ $inventoryItem->isLowStock() ? 'text-red-600' : 'text-green-600' }}">
                            {{ $inventoryItem->current_stock }}
                        </div>
                        <div class="text-sm text-gray-600">Current Stock</div>
                        @if($inventoryItem->isLowStock())
                            <div class="mt-2">
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                    Low Stock Alert
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
        <div class="flex items-center mb-4">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-lg font-medium text-gray-900">Delete Inventory Item</h3>
            </div>
        </div>
        
        <div class="mb-4">
            <p class="text-sm text-gray-500">
                Are you sure you want to delete "{{ $inventoryItem->name }}"? This action cannot be undone.
            </p>
        </div>

        <div class="flex justify-end space-x-3">
            <button type="button" onclick="closeDeleteModal()" 
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                Cancel
            </button>
            <form action="{{ route('inventory.destroy', $inventoryItem) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    Delete Item
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Live preview functionality
function updatePreview() {
    const name = document.getElementById('name').value || '{{ $inventoryItem->name }}';
    const category = document.getElementById('category').value || 'N/A';
    const unitPrice = parseFloat(document.getElementById('unit_price').value) || {{ $inventoryItem->unit_price }};
    const currentStock = parseInt(document.getElementById('current_stock').value) || {{ $inventoryItem->current_stock }};
    const unit = document.getElementById('unit').value || '{{ $inventoryItem->unit }}';
    
    document.getElementById('preview-name').textContent = name;
    document.getElementById('preview-category').textContent = category;
    document.getElementById('preview-price').textContent = 'Rp ' + unitPrice.toLocaleString('id-ID');
    document.getElementById('preview-stock').textContent = currentStock + ' ' + unit;
    document.getElementById('preview-total').textContent = 'Rp ' + (unitPrice * currentStock).toLocaleString('id-ID');
}

// Add event listeners for live preview
document.getElementById('name').addEventListener('input', updatePreview);
document.getElementById('category').addEventListener('change', updatePreview);
document.getElementById('unit_price').addEventListener('input', updatePreview);
document.getElementById('current_stock').addEventListener('input', updatePreview);
document.getElementById('unit').addEventListener('change', updatePreview);

// Delete confirmation
function confirmDelete() {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}

// Form validation
document.getElementById('inventoryForm').addEventListener('submit', function(e) {
    const currentStock = parseInt(document.getElementById('current_stock').value) || 0;
    const reorderLevel = parseInt(document.getElementById('reorder_level').value) || 0;
    
    if (currentStock < 0) {
        e.preventDefault();
        alert('Current stock cannot be negative');
        return;
    }
    
    if (reorderLevel < 0) {
        e.preventDefault();
        alert('Reorder level cannot be negative');
        return;
    }
});
</script>
@endsection
