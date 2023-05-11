<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function addGallery(Product $product)
    {
        $title = 'گالری محصول';
        return view('admin.product.create_gallery', compact('title','product'));
    }

    public function storeGallery(Request $request, Product $product)
    {
        $image = saveImage($request->file, 'products-gallery');
        Gallery::query()->create([
            'image' => $image,
            'product_id' => $product->id,
        ]);
        return redirect()->back()->with('message', 'عکس با موفقیت ذخیره شد');
    }
}
