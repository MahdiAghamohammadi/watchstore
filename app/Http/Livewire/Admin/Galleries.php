<?php

namespace App\Http\Livewire\Admin;

use App\Models\Gallery;
use Livewire\Component;

class Galleries extends Component
{
    public $product_id;
    protected $listeners = [
        'destroyGallery',
        'refreshComponent' => '$refresh',
    ];

    public function deleteGallery($product_id, $id): void
    {
        $this->dispatchBrowserEvent('deleteGallery', ['product_id' => $product_id, 'id' => $id]);
    }

    public function destroyGallery($product_id, $id): void
    {
        $gallery = Gallery::query()->where('product_id', $product_id)->where('id', $id)->first();
        $path_big = public_path().'/images/admin/products-gallery/big/'.$gallery->image;
        $path_small = public_path().'/images/admin/products-gallery/small/'.$gallery->image;
        unlink($path_big);
        unlink($path_small);
        $gallery->delete();
        $this->emit('refreshComponent');
    }

    public function render()
    {
        $galleries = Gallery::query()->get();
        return view('livewire.admin.galleries', compact('galleries'));
    }
}
