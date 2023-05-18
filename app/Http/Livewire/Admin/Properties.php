<?php

namespace App\Http\Livewire\Admin;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class Properties extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = [
        'destroyProperty',
        'refreshComponent' => '$refresh',
    ];

    public function deleteProperty($id): void
    {
        $this->dispatchBrowserEvent('deleteProperty', ['id' => $id]);
    }

    public function destroyProperty($id): void
    {
        Property::destroy($id);
        $this->emit('refreshComponent');
    }

    public function render()
    {
        $properties = Property::query()
            ->where('title', 'LIKE', "%{$this->search}%")
            ->paginate(15);
        return view('livewire.admin.properties', compact('properties'));
    }
}
