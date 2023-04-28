<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;


    public function render()
    {
        $categories = Category::query()
            ->where('title', 'LIKE', "%{$this->search}%")
            ->paginate(15);
        return view('livewire.admin.categories', compact('categories'));
    }
}
