<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لیست دسته بندی ها';
        return view('admin.category.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد دسته بندی';
        $categories = Category::query()->pluck('title', 'id');
        return view('admin.category.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $image = Category::saveImage($request->file);
        Category::query()->create([
            'title' => $request->input('title'),
            'parent_id' => $request->input('parent_id') ?? 0,
            'image' => $image,
        ]);
        return to_route('category.index')->with('message', 'دسته بندی جدید با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::query()->pluck('title', 'id')->except($category->id);
        return view('admin.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $image = Category::saveImage($request->file);
        $category->update([
            'title' => $request->input('title'),
            'parent_id' => $request->input('parent_id') ?? 0,
            'image' => $image,
        ]);
        return to_route('category.index')->with('message', 'دسته بندی جدید با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
