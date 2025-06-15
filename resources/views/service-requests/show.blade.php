@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Service Request #{{ $serviceRequest->id }}</h1>
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
                                <a href="{{ route('service-requests.index') }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">Service Requests</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-500 md:ml-2">#{{ $serviceRequest->id }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="flex space-x-3">
                @if($serviceRequest->status !== 'completed')
                    <button onclick="openStatusModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Update Status
                    </button>
                @endif
                <a href="{{ route('service-requests.edit', $serviceRequest) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Request
                </a>
            </div>
        </div>

        <!-- Status Banner -->
        <div class="mb-6">
            <div class="rounded-lg p-4 {{ $serviceRequest->status === 'pending' ? 'bg-yellow-50 border border-yellow-200' : ($serviceRequest->status === 'in_progress' ? 'bg-blue-50 border border-blue-200' : ($serviceRequest->status === 'completed' ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200')) }}">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        @if($serviceRequest->status === 'pending')
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.414L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                        @elseif($serviceRequest->status === 'in_progress')
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        @elseif($serviceRequest->status === 'completed')
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        @else
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium {{ $serviceRequest->status === 'pending' ? 'text-yellow-800' : ($serviceRequest->status === 'in_progress' ? 'text-blue-800' : ($serviceRequest->status === 'completed' ? 'text-green-800' : 'text-red-800')) }}">
                            Status: {{ ucfirst(str_replace('_', ' ', $serviceRequest->status)) }}
                        </h3>
                        <div class="mt-2 text-sm {{ $serviceRequest->status === 'pending' ? 'text-yellow-700' : ($serviceRequest->status === 'in_progress' ? 'text-blue-700' : ($serviceRequest->status === 'completed' ? 'text-green-700' : 'text-red-700')) }}">
                            @if($serviceRequest->status === 'pending')
                                <p>This service request is awaiting technician assignment and scheduling.</p>
                            @elseif($serviceRequest->status === 'in_progress')
                                <p>Service is currently being performed by {{ $serviceRequest->technician->name ?? 'assigned technician' }}.</p>
                            @elseif($serviceRequest->status === 'completed')
                                <p>Service has been completed successfully. Customer can pick up the vehicle.</p>
                            @else
                                <p>This service request has been cancelled.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Service Details -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Service Details</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-3">Service Information</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Service:</span>
                                    <span class="font-medium">{{ $serviceRequest->service->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Category:</span>
                                    <span class="font-medium">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">{{ $serviceRequest->service->category }}</span>
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Duration:</span>
                                    <span class="font-medium">{{ $serviceRequest->service->duration }} minutes</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Price:</span>
                                    <span class="font-semibold text-green-600">Rp {{ number_format($serviceRequest->service->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-3">Schedule Information</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Scheduled Date:</span>
                                    <span class="font-medium">{{ $serviceRequest->scheduled_date->format('M d, Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Scheduled Time:</span>
                                    <span class="font-medium">{{ $serviceRequest->scheduled_date->format('H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Created:</span>
                                    <span class="font-medium">{{ $serviceRequest->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Last Updated:</span>
                                    <span class="font-medium">{{ $serviceRequest->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($serviceRequest->notes)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Service Notes</h3>
                            <p class="text-gray-700">{{ $serviceRequest->notes }}</p>
                        </div>
                    @endif
                </div>

                <!-- Customer & Vehicle Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Customer & Vehicle</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-3">Customer Information</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Name:</span>
                                    <span class="font-medium">{{ $serviceRequest->customer->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Email:</span>
                                    <span class="font-medium">{{ $serviceRequest->customer->email }}</span>
                                </div>
                                @if($serviceRequest->customer->phone)
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Phone:</span>
                                        <span class="font-medium">{{ $serviceRequest->customer->phone }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-3">Vehicle Information</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Vehicle:</span>
                                    <span class="font-medium">{{ $serviceRequest->vehicle->vehicle->brand }} {{ $serviceRequest->vehicle->vehicle->model }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Year:</span>
                                    <span class="font-medium">{{ $serviceRequest->vehicle->vehicle->year }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">License Plate:</span>
                                    <span class="font-medium">{{ $serviceRequest->vehicle->license_plate }}</span>
                                </div>
                                @if($serviceRequest->vehicle->mileage)
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Mileage:</span>
                                        <span class="font-medium">{{ number_format($serviceRequest->vehicle->mileage) }} km</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service History Placeholder -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Service History</h2>
                    <div class="h-32 bg-gray-50 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h2m0-13h10a2 2 0 012 2v11a2 2 0 01-2 2H9m0-13v13"></path>
                            </svg>
                            <p class="text-gray-500">Service history will appear here</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Progress Tracking -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Progress Tracking</h3>
                    
                    <div class="space-y-4">
                        @php
                            $steps = [
                                'pending' => 'Request Submitted',
                                'in_progress' => 'Service In Progress',
                                'completed' => 'Service Completed'
                            ];
                            $currentStep = array_search($serviceRequest->status, array_keys($steps));
                        @endphp
                        
                        @foreach($steps as $status => $label)
                            @php
                                $stepIndex = array_search($status, array_keys($steps));
                                $isCompleted = $stepIndex <= $currentStep;
                                $isCurrent = $stepIndex === $currentStep;
                            @endphp
                            
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    @if($isCompleted)
                                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                    @elseif($isCurrent)
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                            <div class="w-3 h-3 bg-white rounded-full"></div>
                                        </div>
                                    @else
                                        <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium {{ $isCompleted ? 'text-green-600' : ($isCurrent ? 'text-blue-600' : 'text-gray-500') }}">
                                        {{ $label }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Technician Assignment -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Technician Assignment</h3>
                    
                    @if($serviceRequest->technician)
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12">
                                <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-sm font-medium text-blue-800">{{ substr($serviceRequest->technician->name, 0, 2) }}</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $serviceRequest->technician->name }}</div>
                                <div class="text-sm text-gray-500">{{ $serviceRequest->technician->specialization ?? 'General Technician' }}</div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <p class="text-gray-500">No technician assigned</p>
                        </div>
                    @endif
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        @if($serviceRequest->status !== 'completed')
                            <button onclick="openStatusModal()" class="w-full bg-blue-50 hover:bg-blue-100 text-blue-700 px-4 py-3 rounded-lg font-medium transition-colors border border-blue-200">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Update Status
                            </button>
                        @endif
                        <a href="{{ route('service-requests.edit', $serviceRequest) }}" class="w-full bg-green-50 hover:bg-green-100 text-green-700 px-4 py-3 rounded-lg font-medium transition-colors border border-green-200 text-center block">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Request
                        </a>
                        <button class="w-full bg-purple-50 hover:bg-purple-100 text-purple-700 px-4 py-3 rounded-lg font-medium transition-colors border border-purple-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H9.5a2 2 0 01-2-2V5a2 2 0 00-2-2H3a2 2 0 00-2 2v4a2 2 0 002 2h2"></path>
                            </svg>
                            Create Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Update Service Status</h3>
            <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form action="{{ route('service-requests.update-status', $serviceRequest) }}" method="POST">
            @csrf
            @method('PATCH')
            
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">New Status</label>
                <select id="status" name="status" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Select status</option>
                    <option value="pending" {{ $serviceRequest->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $serviceRequest->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $serviceRequest->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $serviceRequest->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="flex space-x-3">
                <button type="button" onclick="closeStatusModal()" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                    Cancel
                </button>
                <button type="submit" 
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    Update Status
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openStatusModal() {
    document.getElementById('statusModal').classList.remove('hidden');
    document.getElementById('statusModal').classList.add('flex');
}

function closeStatusModal() {
    document.getElementById('statusModal').classList.add('hidden');
    document.getElementById('statusModal').classList.remove('flex');
}
</script>
@endsection