<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Service::query();

        // Apply filters
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $services = $query->paginate(15);
        $categories = Service::distinct('category')->pluck('category')->filter();

        return view('services.index', compact('services', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'estimated_hours' => 'required|numeric|min:0',
        ]);

        Service::create($validated);

        return redirect()->route('services.index')
                        ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service): View
    {
        $service->load(['serviceRequests.user', 'serviceRequests.customerVehicle.vehicle']);
        
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service): View
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'estimated_hours' => 'required|numeric|min:0',
        ]);

        $service->update($validated);

        return redirect()->route('services.index')
                        ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service): RedirectResponse
    {
        // Check if service has any associated requests
        if ($service->serviceRequests()->exists()) {
            return redirect()->route('services.index')
                            ->with('error', 'Cannot delete service with existing requests.');
        }

        $service->delete();

        return redirect()->route('services.index')
                        ->with('success', 'Service deleted successfully.');
    }

    /**
     * Get popular services.
     */
    public function popular(): JsonResponse
    {
        $popularServices = Service::popular(5)->get();

        return response()->json($popularServices);
    }

    /**
     * Get services by category.
     */
    public function byCategory(string $category): JsonResponse
    {
        $services = Service::byCategory($category)->get();

        return response()->json($services);
    }
}
