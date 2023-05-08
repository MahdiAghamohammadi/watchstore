<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = [
        'destroyProduct',
        'refreshComponent' => '$refresh',
    ];

    public function deleteProduct($id)
    {
        $this->dispatchBrowserEvent('deleteProduct', ['id' => $id]);
    }

    public function destroyProduct($id)
    {
        Product::destroy($id);
        $this->emit('refreshComponent');
    }

    public function render()
    {
        $products = Product::query()
            ->where('name', 'LIKE', "%{$this->search}%")
            ->orWhere('name_en', 'LIKE', "%{$this->search}%")
            ->orWhere('description', 'LIKE', "%{$this->search}%")
            ->paginate(15);
        return view('livewire.admin.products', compact('products'));
    }
}
