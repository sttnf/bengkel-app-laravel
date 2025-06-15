<x-layouts.dashboard>
    <x-slot name="title">Workshop Dashboard</x-slot>
    <x-slot name="subtitle">Welcome back! Here's an overview of your workshop performance.</x-slot>

    <!-- Quick Actions Bar -->
    <x-dashboard.actions />

    <!-- Today's Overview -->
    <x-dashboard.today-overview :todaysStats="$todaysStats" />

    <!-- Statistics Cards -->
    <x-dashboard.stats-grid :stats="$stats" />

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Recent Service Requests -->
        <x-dashboard.service-requests :requests="$recentServiceRequests" />

        <!-- Low Stock Items -->
        <x-dashboard.low-stock :items="$lowStockItems" />
    </div>

    <!-- Additional Stats Row -->
    <x-dashboard.summary-cards :stats="$stats" />

    @push('scripts')
        <script>
            function refreshDashboard() {
                window.location.reload();
            }
        </script>
    @endpush
</x-layouts.dashboard>