@props(['requests'])

<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Recent Service Requests</h3>
            <a href="{{ route('service-requests.index') }}"
                class="text-sm font-medium text-blue-600 hover:text-blue-700">View All</a>
        </div>

        @if($requests->count() > 0)
            <div class="space-y-4">
                @foreach($requests->take(5) as $request)
                    <div
                        class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">#{{ $request->id }} -
                                    {{ $request->service?->name ?? 'Service not found' }}</p>
                                <p class="text-xs text-gray-500">
                                    @if($request->customerVehicle && $request->customerVehicle->customer)
                                        {{ $request->customerVehicle->customer->name }}
                                    @else
                                        Customer not found
                                    @endif
                                </p>
                                <p class="text-xs text-gray-400">{{ $request->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($request->status === 'completed') bg-green-100 text-green-700
                                    @elseif($request->status === 'in_progress') bg-blue-100 text-blue-700
                                    @elseif($request->status === 'confirmed') bg-yellow-100 text-yellow-700
                                        @else bg-gray-100 text-gray-700
                                    @endif">
                                {{ ucfirst($request->status) }}
                            </span>
                            <a href="{{ route('service-requests.show', $request) }}" class="text-blue-600 hover:text-blue-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
                <h3 class="text-sm font-medium text-gray-900 mb-1">No service requests</h3>
                <p class="text-sm text-gray-500 mb-4">No recent service requests to display.</p>
                <a href="{{ route('service-requests.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    Create New Request
                </a>
            </div>
        @endif
    </div>
</div>