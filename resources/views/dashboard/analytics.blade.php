<x-layouts.dashboard>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Analytics Dashboard') }}
            </h2>
            <div class="flex space-x-3">
                <select id="dateRange" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                    <option value="7">Last 7 days</option>
                    <option value="30" selected>Last 30 days</option>
                    <option value="90">Last 90 days</option>
                    <option value="365">Last year</option>
                </select>
                <button onclick="exportReport()" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm hover:bg-green-700">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export Report
                </button>
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-700">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- KPI Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Revenue</dt>
                                    <dd class="text-2xl font-bold text-gray-900">${{ number_format($totalRevenue ?? 0, 2) }}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center text-sm">
                                <span class="text-green-600 font-medium">+12.5%</span>
                                <span class="text-gray-500 ml-1">vs last period</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Completed Services</dt>
                                    <dd class="text-2xl font-bold text-gray-900">{{ $completedServices ?? 0 }}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center text-sm">
                                <span class="text-green-600 font-medium">+8.2%</span>
                                <span class="text-gray-500 ml-1">vs last period</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Avg. Service Time</dt>
                                    <dd class="text-2xl font-bold text-gray-900">{{ $avgServiceTime ?? '2.5' }}h</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center text-sm">
                                <span class="text-red-600 font-medium">-5.3%</span>
                                <span class="text-gray-500 ml-1">vs last period</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Customer Satisfaction</dt>
                                    <dd class="text-2xl font-bold text-gray-900">{{ $customerSatisfaction ?? '4.8' }}/5</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center text-sm">
                                <span class="text-green-600 font-medium">+0.3</span>
                                <span class="text-gray-500 ml-1">vs last period</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Revenue Chart -->
                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Revenue Trends</h3>
                        <p class="text-sm text-gray-500">Monthly revenue over time</p>
                    </div>
                    <div class="p-6">
                        <div class="h-64">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Service Performance Chart -->
                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Service Performance</h3>
                        <p class="text-sm text-gray-500">Service requests by status</p>
                    </div>
                    <div class="p-6">
                        <div class="h-64">
                            <canvas id="serviceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Statistics -->
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Service Performance Analytics</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            <h4 class="text-md font-medium text-gray-700 mb-4">Most Popular Services</h4>
                            <div class="space-y-3">
                                @foreach($serviceStats ?? [] as $index => $service)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-sm font-medium text-blue-600">#{{ $index + 1 }}</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">{{ $service['name'] }}</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-sm font-semibold text-gray-900">{{ $service['service_requests_count'] }}</span>
                                            <span class="text-xs text-gray-500 ml-1">requests</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <h4 class="text-md font-medium text-gray-700 mb-4">Revenue by Service</h4>
                            <div class="space-y-3">
                                @foreach($revenueByService ?? [] as $index => $service)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-sm font-medium text-green-600">#{{ $index + 1 }}</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">{{ $service['name'] }}</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-sm font-semibold text-green-600">${{ number_format($service['total_revenue'], 2) }}</span>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ ($service['total_revenue'] / ($revenueByService[0]['total_revenue'] ?? 1)) * 100 }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>            <!-- Technician Performance -->
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Technician Performance</h3>
                    <p class="text-sm text-gray-500">Individual technician statistics and workload</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($technicianStats ?? [] as $technician)
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 rounded-xl border border-gray-200">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                                        <span class="text-lg font-bold text-indigo-600">{{ strtoupper(substr($technician['name'], 0, 2)) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $technician['name'] }}</div>
                                        <div class="text-xs text-gray-600">{{ $technician['specialization'] }}</div>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Completed Services</span>
                                        <span class="text-lg font-semibold text-indigo-600">{{ $technician['service_requests_count'] }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Avg. Rating</span>
                                        <span class="text-sm font-medium text-yellow-600">{{ $technician['rating'] ?? '4.8' }}/5 ⭐</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Revenue Generated</span>
                                        <span class="text-sm font-medium text-green-600">${{ number_format($technician['revenue'] ?? 0, 2) }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ min(($technician['service_requests_count'] / 10) * 100, 100) }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Inventory Analytics -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Inventory Overview</h3>
                        <p class="text-sm text-gray-500">Stock levels and alerts</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg border border-red-200">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.268 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-red-900">Low Stock Items</div>
                                        <div class="text-xs text-red-700">Requires immediate attention</div>
                                    </div>
                                </div>
                                <span class="text-xl font-bold text-red-600">{{ $lowStockCount ?? 0 }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-yellow-900">Total Inventory Value</div>
                                        <div class="text-xs text-yellow-700">Current stock value</div>
                                    </div>
                                </div>
                                <span class="text-xl font-bold text-yellow-600">${{ number_format($inventoryValue ?? 0, 2) }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg border border-green-200">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-green-900">Well Stocked Items</div>
                                        <div class="text-xs text-green-700">Above minimum threshold</div>
                                    </div>
                                </div>
                                <span class="text-xl font-bold text-green-600">{{ $wellStockedCount ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Customer Insights</h3>
                        <p class="text-sm text-gray-500">Customer behavior and trends</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg">
                                <div class="text-3xl font-bold text-indigo-600">{{ $totalCustomers ?? 0 }}</div>
                                <div class="text-sm text-indigo-700 mt-1">Total Customers</div>
                                <div class="text-xs text-indigo-600 mt-2">+{{ $newCustomersThisMonth ?? 0 }} new this month</div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <div class="text-lg font-bold text-gray-900">{{ $returnCustomers ?? 0 }}%</div>
                                    <div class="text-xs text-gray-600">Return Rate</div>
                                </div>
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <div class="text-lg font-bold text-gray-900">${{ number_format($avgOrderValue ?? 0, 0) }}</div>
                                    <div class="text-xs text-gray-600">Avg Order</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Advanced Monthly Revenue Chart -->
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Revenue Trends & Forecasting</h3>
                            <p class="text-sm text-gray-500">Monthly revenue analysis with trend prediction</p>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="toggleChartType('line')" class="px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200">Line</button>
                            <button onclick="toggleChartType('bar')" class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">Bar</button>
                            <button onclick="toggleChartType('area')" class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">Area</button>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="h-80">
                        <canvas id="advancedRevenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js and Custom Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>

    <script>
        // Sample data - replace with actual data from your controller
        const revenueData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Revenue',
                data: [12000, 19000, 3000, 5000, 20000, 30000, 45000, 32000, 28000, 35000, 42000, 38000],
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4
            }]
        };

        const serviceData = {
            labels: ['Completed', 'In Progress', 'Pending', 'Cancelled'],
            datasets: [{
                data: [{{ $completedServices ?? 65 }}, {{ $inProgressServices ?? 25 }}, {{ $pendingServices ?? 8 }}, {{ $cancelledServices ?? 2 }}],
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderWidth: 0
            }]
        };

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: revenueData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Service Chart
        const serviceCtx = document.getElementById('serviceChart').getContext('2d');
        const serviceChart = new Chart(serviceCtx, {
            type: 'doughnut',
            data: serviceData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Advanced Revenue Chart
        const advancedCtx = document.getElementById('advancedRevenueChart').getContext('2d');
        const advancedChart = new Chart(advancedCtx, {
            type: 'line',
            data: {
                labels: revenueData.labels,
                datasets: [
                    revenueData.datasets[0],
                    {
                        label: 'Forecast',
                        data: [null, null, null, null, null, null, null, null, null, null, null, 38000, 42000, 45000],
                        borderColor: 'rgba(156, 163, 175, 0.8)',
                        backgroundColor: 'rgba(156, 163, 175, 0.1)',
                        borderDash: [5, 5],
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': $' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Chart type toggle function
        function toggleChartType(type) {
            advancedChart.config.type = type;
            advancedChart.update();
        }

        // Export report function
        function exportReport() {
            // This would typically generate and download a PDF report
            alert('Export functionality would be implemented here');
        }

        // Date range change handler
        document.getElementById('dateRange').addEventListener('change', function() {
            // This would update charts based on selected date range
            console.log('Date range changed to:', this.value);
        });
    </script>
</x-layouts.dashboard>
