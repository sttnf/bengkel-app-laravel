@props(['items'])

<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Low Stock Items</h3>
            <a href="{{ route('inventory.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">View All</a>
        </div>
        
        @if($items->count() > 0)
            <div class="space-y-4">
                @foreach($items->take(5) as $item)
                <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg border border-red-100">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ $item->name }}</p>
                            <p class="text-xs text-gray-500">{{ $item->sku ?? 'No SKU' }}</p>
                            <div class="flex items-center mt-2">
                                <div class="flex-1 bg-red-200 rounded-full h-2 mr-2">
                                    <div class="bg-red-600 h-2 rounded-full" style="width: {{ ($item->current_stock / max($item->reorder_level ?? 10, 1)) * 100 }}%"></div>
                                </div>
                                <span class="text-xs text-red-600 font-medium">{{ $item->current_stock ?? 0 }} left</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">
                            Low Stock
                        </span>
                        <a href="{{ route('inventory.edit', $item) }}" class="text-blue-600 hover:text-blue-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <div class="w-16 h-16 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-sm font-medium text-gray-900 mb-1">All items well stocked</h3>
                <p class="text-sm text-gray-500 mb-4">No items are currently running low on stock.</p>
                <a href="{{ route('inventory.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    View Inventory
                </a>
            </div>
        @endif
    </div>
</div>
