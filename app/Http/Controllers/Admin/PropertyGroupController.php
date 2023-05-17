<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyGroup;
use Illuminate\Http\Request;

class PropertyGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لیست گروه ویژگی ها';
        return view('admin.property-group.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد گروه ویژگی ها';
        return view('admin.property-group.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PropertyGroup::query()->create([
            'title' => $request->input('title'),
        ]);
        return redirect()->route('property-groups.index')->with('message', 'ویژگی جدید با موفقیت اضافه شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyGroup $propertyGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyGroup $propertyGroup)
    {
        $title = 'ویرایش گروه ویژگی ها';
        return view('admin.property-group.edit', compact('title', 'propertyGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyGroup $propertyGroup)
    {
        $propertyGroup->update([
            'title' => $request->input('title'),
        ]);
        return redirect()->route('property-groups.index')->with('message', 'ویژگی با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyGroup $propertyGroup)
    {
        //
    }
}
