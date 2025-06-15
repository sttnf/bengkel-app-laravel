<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = InventoryItem::query();

        // Apply filters
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('low_stock')) {
            $query->lowStock();
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('part_number', 'like', '%' . $request->search . '%')
                  ->orWhere('supplier', 'like', '%' . $request->search . '%');
            });
        }

        $inventoryItems = $query->paginate(15);
        $categories = InventoryItem::distinct('category')->pluck('category')->filter();

        return view('inventory.index', compact('inventoryItems', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'nullable|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'current_stock' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'unit' => 'required|string|max:20',
            'part_number' => 'nullable|string|max:30|unique:inventory_items',
            'supplier' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:50',
        ]);

        InventoryItem::create($validated);

        return redirect()->route('inventory.index')
                        ->with('success', 'Inventory item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryItem $inventoryItem): View
    {
        return view('inventory.show', compact('inventoryItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryItem $inventoryItem): View
    {
        return view('inventory.edit', compact('inventoryItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InventoryItem $inventoryItem): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'nullable|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'current_stock' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'unit' => 'required|string|max:20',
            'part_number' => 'nullable|string|max:30|unique:inventory_items,part_number,' . $inventoryItem->id,
            'supplier' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:50',
        ]);

        $inventoryItem->update($validated);

        return redirect()->route('inventory.index')
                        ->with('success', 'Inventory item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryItem $inventoryItem): RedirectResponse
    {
        $inventoryItem->delete();

        return redirect()->route('inventory.index')
                        ->with('success', 'Inventory item deleted successfully.');
    }

    /**
     * Update stock for an inventory item.
     */
    public function updateStock(Request $request, InventoryItem $inventoryItem): JsonResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer',
            'type' => 'required|in:add,remove',
        ]);

        $quantity = $validated['type'] === 'add' ? $validated['quantity'] : -$validated['quantity'];
        
        if ($validated['type'] === 'remove' && $inventoryItem->current_stock < $validated['quantity']) {
            return response()->json([
                'error' => 'Insufficient stock available.'
            ], 400);
        }

        $inventoryItem->updateStock($quantity);

        return response()->json([
            'success' => true,
            'current_stock' => $inventoryItem->fresh()->current_stock,
            'message' => 'Stock updated successfully.'
        ]);
    }

    /**
     * Get low stock items.
     */
    public function lowStock(): JsonResponse
    {
        $lowStockItems = InventoryItem::lowStock()->get();

        return response()->json($lowStockItems);
    }
}
