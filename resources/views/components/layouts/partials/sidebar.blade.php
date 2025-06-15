<div class="flex flex-col h-full bg-white border-r border-gray-200">
    <!-- Logo -->
    <div class="flex items-center justify-center h-16 bg-indigo-600">
        <div class="flex items-center space-x-2">
            <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 8.172V5L8 4z"></path>
            </svg>
            <span class="text-white text-lg font-bold">Workshop</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 border-r-2 border-indigo-600' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
            </svg>
            Dashboard
        </a>

        <!-- Service Requests -->
        <div x-data="{ open: {{ request()->is('service-requests*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="flex items-center">
                    <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Service Requests
                </div>
                <svg class="h-4 w-4 transform transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" class="ml-6 mt-2 space-y-1">
                <a href="{{ route('service-requests.index') }}" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-50 {{ request()->routeIs('service-requests.index') ? 'bg-indigo-50 text-indigo-700' : '' }}">All Requests</a>
                <a href="{{ route('service-requests.create') }}" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-50 {{ request()->routeIs('service-requests.create') ? 'bg-indigo-50 text-indigo-700' : '' }}">New Request</a>
            </div>
        </div>        <!-- Customers & Vehicles -->
        <div x-data="{ open: {{ request()->is('customer-vehicles*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="flex items-center">
                    <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    Customers & Vehicles
                </div>
                <svg class="h-4 w-4 transform transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" class="ml-6 mt-2 space-y-1">
                <a href="{{ route('customer-vehicles.index') }}" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-50 {{ request()->routeIs('customer-vehicles.index') ? 'bg-indigo-50 text-indigo-700' : '' }}">All Vehicles</a>
                <a href="{{ route('customer-vehicles.create') }}" class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-50 {{ request()->routeIs('customer-vehicles.create') ? 'bg-indigo-50 text-indigo-700' : '' }}">Add Vehicle</a>
            </div>
        </div>

        <!-- Payments -->
        <a href="{{ route('payments.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('payments*') ? 'bg-indigo-50 text-indigo-700 border-r-2 border-indigo-600' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Payments
        </a>

        <!-- Inventory -->
        <a href="{{ route('inventory.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('inventory*') ? 'bg-indigo-50 text-indigo-700 border-r-2 border-indigo-600' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            Inventory
        </a>        <!-- Services -->
        <a href="{{ route('services.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('services*') ? 'bg-indigo-50 text-indigo-700 border-r-2 border-indigo-600' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Services
        </a>

        <!-- Divider -->
        <div class="border-t border-gray-200 my-4"></div>

        <!-- Reports -->
        <a href="{{ route('dashboard.analytics') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard.analytics') ? 'bg-indigo-50 text-indigo-700 border-r-2 border-indigo-600' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Analytics
        </a>
    </nav>

    <!-- User info at bottom -->
    <div class="border-t border-gray-200 p-4">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center">
                <span class="text-white text-sm font-medium">{{ substr(Auth::user()->name, 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ ucfirst(Auth::user()->user_type ?? 'admin') }}</p>
            </div>
        </div>
    </div>
</div>
