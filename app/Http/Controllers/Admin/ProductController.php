<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'محصولات';
        return view('admin.product.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد محصول';
        $categories = Category::query()->pluck('title', 'id');
        $brands = Brand::query()->pluck('name', 'id');
        return view('admin.product.create', compact('title', 'categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = saveImage($request->file, 'products');
        $product = Product::query()->create([
            'name' => $request->input('name'),
            'name_en' => $request->input('name_en'),
            'slug' => make_slug($request->input('name')),
            'price' => $request->input('price'),
            'count' => $request->input('count'),
            'image' => $image,
            'guaranty' => $request->input('guaranty'),
            'discount' => $request->input('discount'),
            'description' => $request->input('description'),
            'is_special' => $request->input('is_special') === 'on',
            'special_expiration' => ($request->input('special_expiration') !== null
                ? Verta::parse($request->input('special_expiration'))->datetime()
                : now()),
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
        ]);

        return redirect()->route('products.index')->with('message', 'محصول جدید با موفقیت اضافه شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $title = 'ویرایش محصول';
        $categories = Category::query()->pluck('title', 'id');
        $brands = Brand::query()->pluck('name', 'id');
        return view('admin.product.edit', compact('title', 'product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $image = saveImage($request->file, 'products');
        $product->update([
            'name' => $request->input('name'),
            'name_en' => $request->input('name_en'),
            'slug' => make_slug($request->input('name')),
            'price' => $request->input('price'),
            'count' => $request->input('count'),
            'image' => $image,
            'guaranty' => $request->input('guaranty'),
            'discount' => $request->input('discount'),
            'description' => $request->input('description'),
            'is_special' => $request->input('is_special') === 'on',
            'special_expiration' => ($request->input('special_expiration') !== null
                ? Verta::parse($request->input('special_expiration'))->datetime()
                : now()),
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
        ]);

        return redirect()->route('products.index')->with('message', 'محصول با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
