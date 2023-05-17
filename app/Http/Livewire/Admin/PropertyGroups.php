<?php

namespace App\Http\Livewire\Admin;

use App\Models\PropertyGroup;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyGroups extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = [
        'destroyPropertyGroup',
        'refreshComponent' => '$refresh',
    ];

    public function deletePropertyGroup($id): void
    {
        $this->dispatchBrowserEvent('deletePropertyGroup', ['id' => $id]);
    }

    public function destroyPropertyGroup($id): void
    {
        PropertyGroup::destroy($id);
        $this->emit('refreshComponent');
    }


    public function render()
    {
        $propertyGroups = PropertyGroup::query()
            ->where('title', 'LIKE', "%{$this->search}%")
            ->paginate(15);
        return view('livewire.admin.property-groups', compact('propertyGroups'));
    }
}
