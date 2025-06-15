@props(['stats'])

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-blue-500 text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-600">Total Service Requests</h3>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_service_requests'] ?? 0) }}</p>
                <p class="text-xs text-blue-600">{{ $stats['pending_requests'] ?? 0 }} pending</p>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-green-500 text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-600">Monthly Revenue</h3>
                <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($stats['monthly_revenue'] ?? 0, 0, ',', '.') }}</p>
                <p class="text-xs {{ ($stats['revenue_growth'] ?? 0) >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ ($stats['revenue_growth'] ?? 0) >= 0 ? '+' : '' }}{{ number_format(abs($stats['revenue_growth'] ?? 0), 1) }}% from last month
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-purple-500 text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-600">Total Customers</h3>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_customers'] ?? 0) }}</p>
                <p class="text-xs text-purple-600">+{{ $stats['new_customers_this_month'] ?? 0 }} this month</p>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-orange-500 text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-600">Inventory Items</h3>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_inventory_items'] ?? 0) }}</p>
                @if(($stats['low_stock_items'] ?? 0) > 0)
                    <p class="text-xs text-red-600">{{ $stats['low_stock_items'] }} items low stock</p>
                @else
                    <p class="text-xs text-green-600">All items well stocked</p>
                @endif
            </div>
        </div>
    </div>
</div>
