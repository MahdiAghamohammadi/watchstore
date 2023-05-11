<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لیست برند ها';
        return view('admin.brand.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ساخت برند';
        return view('admin.brand.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $image = saveImage($request->file, 'brands');
        Brand::query()->create([
            'name' => $request->input('name'),
            'image' => $image,
        ]);
        return to_route('brands.index')->with('message', 'برند جدید با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $title = 'ویرایش برند';
        return view('admin.brand.edit', compact('title', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $image = saveImage($request->file, 'brands');
        $brand->update([
            'name' => $request->input('name'),
            'image' => ($request->file ? $image : $brand->image),
        ]);
        return to_route('brands.index')->with('message', 'برند با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
