<x-layouts.dashboard>
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">My Vehicle Details</h1>
        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold mb-2 text-indigo-700">{{ $vehicle->vehicle->brand ?? '-' }} {{ $vehicle->vehicle->model ?? '' }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div><span class="font-medium text-gray-700">Year:</span> {{ $vehicle->year }}</div>
                    <div><span class="font-medium text-gray-700">Color:</span> {{ $vehicle->color }}</div>
                    <div><span class="font-medium text-gray-700">License Plate:</span> {{ $vehicle->license_plate }}</div>
                    <div><span class="font-medium text-gray-700">Engine Number:</span> {{ $vehicle->engine_number ?? '-' }}</div>
                    <div><span class="font-medium text-gray-700">Chassis Number:</span> {{ $vehicle->chassis_number ?? '-' }}</div>
                    <div><span class="font-medium text-gray-700">Purchase Date:</span> {{ $vehicle->purchase_date ? $vehicle->purchase_date->format('Y-m-d') : '-' }}</div>
                    <div><span class="font-medium text-gray-700">Mileage:</span> {{ $vehicle->mileage ? number_format($vehicle->mileage) . ' km' : '-' }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow mb-6 p-6">
            <h3 class="text-lg font-semibold mb-4 text-indigo-700">Service History</h3>
            @if($serviceHistory->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Service</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Technician</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total Payment</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($serviceHistory as $request)
                                <tr>
                                    <td class="px-4 py-2">{{ $request->scheduled_datetime ? $request->scheduled_datetime->format('Y-m-d') : '-' }}</td>
                                    <td class="px-4 py-2">{{ $request->service->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $request->technician->name ?? '-' }}</td>
                                    <td class="px-4 py-2 capitalize">{{ $request->status }}</td>
                                    <td class="px-4 py-2">{{ $request->payments->sum('amount') ? number_format($request->payments->sum('amount'), 2) : '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500">No service history found for this vehicle.</p>
            @endif
        </div>
        <div class="flex flex-col md:flex-row gap-2">
            <a href="{{ route('user.vehicles.index') }}" class="btn btn-secondary w-full md:w-auto">Back to My Vehicles</a>
            <a href="{{ route('user.vehicles.edit', $vehicle->id) }}" class="btn btn-primary w-full md:w-auto">Edit Vehicle</a>
        </div>
    </div>
</x-layouts.dashboard>
