@props(['todaysStats'])

<div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-sm p-6 mb-8 text-white">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="text-xl font-semibold">Today's Overview</h2>
            <p class="text-blue-100">{{ now()->format('l, F j, Y') }}</p>
        </div>
        <div class="p-3 bg-white/10 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white/10 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-2 bg-white/20 rounded-lg mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold">{{ $todaysStats['appointments_today'] ?? 0 }}</p>
                    <p class="text-blue-100 text-sm">New Requests</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white/10 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-2 bg-white/20 rounded-lg mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold">{{ $todaysStats['completed_today'] ?? 0 }}</p>
                    <p class="text-blue-100 text-sm">Completed</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white/10 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-2 bg-white/20 rounded-lg mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold">Rp {{ number_format($todaysStats['revenue_today'] ?? 0, 0, ',', '.') }}</p>
                    <p class="text-blue-100 text-sm">Revenue</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white/10 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-2 bg-white/20 rounded-lg mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold">{{ $todaysStats['pending_today'] ?? 0 }}</p>
                    <p class="text-blue-100 text-sm">Pending</p>
                </div>
            </div>
        </div>
    </div>
</div>
