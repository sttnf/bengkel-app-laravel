@props(['stats'])

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm">Service Completion Rate</p>
                <p class="text-2xl font-bold">{{ number_format(($stats['completed_requests'] ?? 0) / max(($stats['total_service_requests'] ?? 1), 1) * 100, 1) }}%</p>
                <p class="text-green-100 text-xs mt-1">
                    {{ $stats['completed_requests'] ?? 0 }} of {{ $stats['total_service_requests'] ?? 0 }} completed
                </p>
            </div>
            <div class="p-3 bg-white/20 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="w-full bg-white/20 rounded-full h-2">
                <div class="bg-white h-2 rounded-full" style="width: {{ ($stats['completed_requests'] ?? 0) / max(($stats['total_service_requests'] ?? 1), 1) * 100 }}%"></div>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm">Monthly Revenue</p>
                <p class="text-2xl font-bold">Rp {{ number_format($stats['monthly_revenue'] ?? 0, 0, ',', '.') }}</p>
                <p class="text-blue-100 text-xs mt-1">
                    @if(isset($stats['revenue_growth']) && $stats['revenue_growth'] != 0)
                        {{ $stats['revenue_growth'] > 0 ? '+' : '' }}{{ number_format($stats['revenue_growth'], 1) }}% from last month
                    @else
                        Current month revenue
                    @endif
                </p>
            </div>
            <div class="p-3 bg-white/20 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-sm">Active Services</p>
                <p class="text-2xl font-bold">{{ ($stats['pending_requests'] ?? 0) + ($stats['in_progress_requests'] ?? 0) }}</p>
                <p class="text-purple-100 text-xs mt-1">
                    {{ $stats['pending_requests'] ?? 0 }} pending, {{ $stats['in_progress_requests'] ?? 0 }} in progress
                </p>
            </div>
            <div class="p-3 bg-white/20 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center space-x-4">
            <div class="flex items-center">
                <div class="w-3 h-3 bg-yellow-300 rounded-full mr-2"></div>
                <span class="text-xs text-purple-100">Pending</span>
            </div>
            <div class="flex items-center">
                <div class="w-3 h-3 bg-blue-300 rounded-full mr-2"></div>
                <span class="text-xs text-purple-100">In Progress</span>
            </div>
        </div>
    </div>
</div>
