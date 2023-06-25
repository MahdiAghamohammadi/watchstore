<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;

    public function render()
    {
        $orders = Order::query()
            ->where('code', 'LIKE', "%{$this->search}%")
            ->orWhereHas('user', function ($query) {
                $query->where('name', 'LIKE', "%{$this->search}%")
                      ->orWhere('mobile', 'LIKE', "%{$this->search}%");
            })->paginate(15);
        return view('livewire.admin.orders', compact('orders'));
    }
}
