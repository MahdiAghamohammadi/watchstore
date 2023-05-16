<div class="mt-5 row">
    @foreach($galleries as $gallery)
        <div class="p-2 border col-md-4 d-flex justify-content-around align-items-center border-danger">
            <img src="{{ asset("/images/admin/products-gallery/big/{$gallery->image}") }}" style="width: 100px" alt="">
            <div>
                <button class="btn btn-info" wire:click="deleteGallery({{ $product_id }}, {{ $gallery->id }})"><i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
    @endforeach
</div>
