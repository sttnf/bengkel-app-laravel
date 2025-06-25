<x-layouts.dashboard>
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <h1 class="text-3xl font-extrabold mb-8 text-indigo-800 text-center">Edit Vehicle</h1>
        <form method="POST" action="{{ route('user.vehicles.update', $vehicle->id) }}"
            class="bg-white rounded-xl shadow-lg p-8 space-y-8">
            @csrf
            @method('PUT')
            <div>
                <label for="vehicle_id" class="block font-semibold text-gray-700 mb-2">Vehicle Type <span
                        class="text-red-500">*</span></label>
                <select name="vehicle_id" id="vehicle_id"
                    class="form-select w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"
                    required>
                    <option value="">Select Vehicle</option>
                    @foreach($vehicles as $v)
                        <option value="{{ $v->id }}" @selected($vehicle->vehicle_id == $v->id)>
                            {{ $v->brand }} {{ $v->model }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="year" class="block font-semibold text-gray-700 mb-2">Year <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="year" id="year"
                        class="form-input w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"
                        value="{{ old('year', $vehicle->year) }}" min="1900" max="{{ date('Y') + 1 }}" required>
                </div>
                <div>
                    <label for="color" class="block font-semibold text-gray-700 mb-2">Color <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="color" id="color"
                        class="form-input w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"
                        value="{{ old('color', $vehicle->color) }}" maxlength="50" required>
                </div>
                <div>
                    <label for="license_plate" class="block font-semibold text-gray-700 mb-2">License Plate <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="license_plate" id="license_plate"
                        class="form-input w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 uppercase tracking-wider transition"
                        value="{{ old('license_plate', $vehicle->license_plate) }}" maxlength="20" required>
                </div>
                <div>
                    <label for="engine_number" class="block font-semibold text-gray-700 mb-2">Engine Number</label>
                    <input type="text" name="engine_number" id="engine_number"
                        class="form-input w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"
                        value="{{ old('engine_number', $vehicle->engine_number) }}" maxlength="100">
                </div>
                <div>
                    <label for="chassis_number" class="block font-semibold text-gray-700 mb-2">Chassis Number</label>
                    <input type="text" name="chassis_number" id="chassis_number"
                        class="form-input w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"
                        value="{{ old('chassis_number', $vehicle->chassis_number) }}" maxlength="100">
                </div>
                <div>
                    <label for="purchase_date" class="block font-semibold text-gray-700 mb-2">Purchase Date</label>
                    <input type="date" name="purchase_date" id="purchase_date"
                        class="form-input w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"
                        value="{{ old('purchase_date', $vehicle->purchase_date ? $vehicle->purchase_date->format('Y-m-d') : null) }}">
                </div>
                <div>
                    <label for="mileage" class="block font-semibold text-gray-700 mb-2">Mileage (km)</label>
                    <input type="number" name="mileage" id="mileage"
                        class="form-input w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"
                        value="{{ old('mileage', $vehicle->mileage) }}" min="0">
                </div>
            </div>
            <div class="flex flex-col md:flex-row gap-3 mt-6">
                <a href="{{ route('user.vehicles.show', $vehicle->id) }}"
                    class="btn btn-secondary w-full md:w-auto">Cancel</a>
                <button type="submit" class="btn btn-primary w-full md:w-auto flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Update Vehicle
                </button>
            </div>
        </form>
    </div>
</x-layouts.dashboard>