<?php

namespace App\Livewire;

use App\Models\InventoryItem;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class InventoryManagement extends Component
{
    use WithPagination;

    #[Validate('required|string|max:255')]
    public $name = '';
    
    #[Validate('nullable|string|max:100')]
    public $part_number = '';
    
    #[Validate('nullable|string|max:500')]
    public $description = '';
    
    #[Validate('required|string|max:100')]
    public $category = '';
    
    #[Validate('required|numeric|min:0')]
    public $unit_price = '';
    
    #[Validate('required|integer|min:0')]
    public $stock_quantity = '';
    
    #[Validate('required|integer|min:0')]
    public $minimum_stock_level = '';
    
    #[Validate('nullable|string|max:50')]
    public $supplier = '';

    public $search = '';
    public $categoryFilter = '';
    public $stockFilter = '';
    public $editingItemId = null;
    public $showForm = false;

    protected $queryString = ['search', 'categoryFilter', 'stockFilter'];

    public function render()
    {
        $inventoryItems = InventoryItem::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('part_number', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('category', $this->categoryFilter);
            })
            ->when($this->stockFilter === 'low', function ($query) {
                $query->whereRaw('stock_quantity <= minimum_stock_level');
            })
            ->when($this->stockFilter === 'out', function ($query) {
                $query->where('stock_quantity', 0);
            })
            ->orderBy('name')
            ->paginate(10);

        $categories = InventoryItem::distinct()->pluck('category')->filter();

        return view('livewire.inventory-management', compact('inventoryItems', 'categories'));
    }

    public function showCreateForm()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit($itemId)
    {
        $item = InventoryItem::findOrFail($itemId);
        
        $this->editingItemId = $itemId;
        $this->name = $item->name;
        $this->part_number = $item->part_number;
        $this->description = $item->description;
        $this->category = $item->category;
        $this->unit_price = $item->unit_price;
        $this->stock_quantity = $item->stock_quantity;
        $this->minimum_stock_level = $item->minimum_stock_level;
        $this->supplier = $item->supplier;
        
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'part_number' => $this->part_number,
            'description' => $this->description,
            'category' => $this->category,
            'unit_price' => $this->unit_price,
            'stock_quantity' => $this->stock_quantity,
            'minimum_stock_level' => $this->minimum_stock_level,
            'supplier' => $this->supplier,
        ];

        if ($this->editingItemId) {
            InventoryItem::findOrFail($this->editingItemId)->update($data);
            session()->flash('message', 'Inventory item updated successfully!');
        } else {
            InventoryItem::create($data);
            session()->flash('message', 'Inventory item created successfully!');
        }

        $this->resetForm();
        $this->showForm = false;
    }

    public function delete($itemId)
    {
        InventoryItem::findOrFail($itemId)->delete();
        session()->flash('message', 'Inventory item deleted successfully!');
    }

    public function adjustStock($itemId, $adjustment)
    {
        $item = InventoryItem::findOrFail($itemId);
        $newQuantity = max(0, $item->stock_quantity + $adjustment);
        
        $item->update(['stock_quantity' => $newQuantity]);
        
        session()->flash('message', 'Stock adjusted successfully!');
    }

    public function cancelEdit()
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm()
    {
        $this->editingItemId = null;
        $this->name = '';
        $this->part_number = '';
        $this->description = '';
        $this->category = '';
        $this->unit_price = '';
        $this->stock_quantity = '';
        $this->minimum_stock_level = '';
        $this->supplier = '';
        $this->resetErrorBag();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingStockFilter()
    {
        $this->resetPage();
    }
}
