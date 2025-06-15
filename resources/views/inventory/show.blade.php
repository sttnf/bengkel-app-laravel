@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $inventoryItem->name }}</h1>
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
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-500 md:ml-2">{{ $inventoryItem->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="flex space-x-3">
                <button onclick="openStockModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Update Stock
                </button>
                <a href="{{ route('inventory.edit', $inventoryItem) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Item
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Item Overview -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Item Overview</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Basic Information</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Name:</span>
                                    <span class="font-medium">{{ $inventoryItem->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Category:</span>
                                    <span class="font-medium">
                                        @if($inventoryItem->category)
                                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">{{ $inventoryItem->category }}</span>
                                        @else
                                            <span class="text-gray-400">Not specified</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Part Number:</span>
                                    <span class="font-medium">{{ $inventoryItem->part_number ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Unit:</span>
                                    <span class="font-medium">{{ $inventoryItem->unit }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Supply Information</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Supplier:</span>
                                    <span class="font-medium">{{ $inventoryItem->supplier ?? 'Not specified' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Location:</span>
                                    <span class="font-medium">{{ $inventoryItem->location ?? 'Not specified' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Unit Price:</span>
                                    <span class="font-medium text-green-600">Rp {{ number_format($inventoryItem->unit_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Value:</span>
                                    <span class="font-semibold text-green-600">Rp {{ number_format($inventoryItem->getTotalValue(), 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stock History Chart Placeholder -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Stock Movement</h2>
                    <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <p class="text-gray-500">Stock movement chart coming soon</p>
                            <p class="text-sm text-gray-400">Track inventory changes over time</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Stock Status -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Stock Status</h3>
                    
                    <div class="space-y-4">
                        <!-- Current Stock -->
                        <div class="text-center p-4 rounded-lg {{ $inventoryItem->isLowStock() ? 'bg-red-50 border border-red-200' : 'bg-green-50 border border-green-200' }}">
                            <div class="text-3xl font-bold {{ $inventoryItem->isLowStock() ? 'text-red-600' : 'text-green-600' }}" id="current-stock">
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

                        <!-- Reorder Level -->
                        <div class="text-center p-4 rounded-lg bg-yellow-50 border border-yellow-200">
                            <div class="text-2xl font-bold text-yellow-600">{{ $inventoryItem->reorder_level }}</div>
                            <div class="text-sm text-gray-600">Reorder Level</div>
                        </div>

                        <!-- Stock Progress Bar -->
                        <div>
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Stock Level</span>
                                <span>{{ number_format(($inventoryItem->current_stock / max($inventoryItem->reorder_level * 2, $inventoryItem->current_stock)) * 100, 1) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                @php
                                    $percentage = ($inventoryItem->current_stock / max($inventoryItem->reorder_level * 2, $inventoryItem->current_stock)) * 100;
                                    $color = $inventoryItem->isLowStock() ? 'bg-red-500' : 'bg-green-500';
                                @endphp
                                <div class="{{ $color }} h-2 rounded-full transition-all duration-300" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <button onclick="openStockModal('add')" class="w-full bg-green-50 hover:bg-green-100 text-green-700 px-4 py-3 rounded-lg font-medium transition-colors border border-green-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Stock
                        </button>
                        <button onclick="openStockModal('remove')" class="w-full bg-red-50 hover:bg-red-100 text-red-700 px-4 py-3 rounded-lg font-medium transition-colors border border-red-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            Remove Stock
                        </button>
                        <a href="{{ route('inventory.edit', $inventoryItem) }}" class="w-full bg-blue-50 hover:bg-blue-100 text-blue-700 px-4 py-3 rounded-lg font-medium transition-colors border border-blue-200 text-center block">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Details
                        </a>
                    </div>
                </div>

                <!-- Item Stats -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistics</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Days in Stock</span>
                            <span class="font-medium">{{ $inventoryItem->created_at->diffInDays(now()) }} days</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Last Updated</span>
                            <span class="font-medium">{{ $inventoryItem->updated_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Stock Turns</span>
                            <span class="font-medium">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stock Update Modal -->
<div id="stockModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Update Stock</h3>
            <button onclick="closeStockModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form id="stockForm">
            @csrf
            <input type="hidden" id="stockType" name="type" value="">
            
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                <input type="number" id="quantity" name="quantity" min="1" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       placeholder="Enter quantity" required>
            </div>
            
            <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                <div class="text-sm text-gray-600">Current Stock: <span class="font-medium">{{ $inventoryItem->current_stock }} {{ $inventoryItem->unit }}</span></div>
                <div class="text-sm text-gray-600" id="newStockPreview"></div>
            </div>

            <div class="flex space-x-3">
                <button type="button" onclick="closeStockModal()" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                    Cancel
                </button>
                <button type="submit" id="submitBtn"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    Update Stock
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let currentStock = {{ $inventoryItem->current_stock }};

function openStockModal(type = 'add') {
    document.getElementById('stockModal').classList.remove('hidden');
    document.getElementById('stockModal').classList.add('flex');
    document.getElementById('stockType').value = type;
    
    const modalTitle = document.getElementById('modalTitle');
    const submitBtn = document.getElementById('submitBtn');
    
    if (type === 'add') {
        modalTitle.textContent = 'Add Stock';
        submitBtn.textContent = 'Add Stock';
        submitBtn.className = 'flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors';
    } else {
        modalTitle.textContent = 'Remove Stock';
        submitBtn.textContent = 'Remove Stock';
        submitBtn.className = 'flex-1 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors';
    }
    
    updateStockPreview();
}

function closeStockModal() {
    document.getElementById('stockModal').classList.add('hidden');
    document.getElementById('stockModal').classList.remove('flex');
    document.getElementById('stockForm').reset();
    document.getElementById('newStockPreview').textContent = '';
}

function updateStockPreview() {
    const quantity = parseInt(document.getElementById('quantity').value) || 0;
    const type = document.getElementById('stockType').value;
    const preview = document.getElementById('newStockPreview');
    
    if (quantity > 0) {
        const newStock = type === 'add' ? currentStock + quantity : currentStock - quantity;
        preview.textContent = `New Stock: ${newStock} {{ $inventoryItem->unit }}`;
        
        if (type === 'remove' && newStock < 0) {
            preview.className = 'text-sm text-red-600 font-medium';
            preview.textContent = 'Error: Insufficient stock available';
        } else {
            preview.className = 'text-sm text-blue-600 font-medium';
        }
    } else {
        preview.textContent = '';
    }
}

// Add event listener for quantity input
document.getElementById('quantity').addEventListener('input', updateStockPreview);

// Handle form submission
document.getElementById('stockForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const quantity = parseInt(formData.get('quantity'));
    const type = formData.get('type');
    
    if (type === 'remove' && quantity > currentStock) {
        alert('Insufficient stock available');
        return;
    }
    
    try {
        const response = await fetch(`{{ route('inventory.updateStock', $inventoryItem) }}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                quantity: quantity,
                type: type
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            currentStock = data.current_stock;
            document.getElementById('current-stock').textContent = currentStock;
            closeStockModal();
            
            // Show success message
            const successDiv = document.createElement('div');
            successDiv.className = 'fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded z-50';
            successDiv.textContent = data.message;
            document.body.appendChild(successDiv);
            
            setTimeout(() => {
                successDiv.remove();
            }, 3000);
            
            // Refresh the page to update all stock-related elements
            location.reload();
        } else {
            alert(data.error || 'An error occurred');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while updating stock');
    }
});
</script>
@endsection
