<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyGroup;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لیست ویژگی ها';
        return view('admin.property.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد ویژگی ها';
        $propertyGroups = PropertyGroup::query()->pluck('title', 'id');
        return view('admin.property.create', compact('title', 'propertyGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Property::query()->create([
            'title' => $request->input('title'),
            'property_group_id' => $request->input('property_group_id'),
        ]);
        return redirect()->route('properties.index')->with('message', 'ویژگی جدید با موفقیت اضافه شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $title = 'ویرایش ویژگی ها';
        $propertyGroups = PropertyGroup::query()->pluck('title', 'id');
        return view('admin.property.edit', compact('title', 'property', 'propertyGroups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $property->update([
            'title' => $request->input('title'),
            'property_group_id' => $request->input('property_group_id'),
        ]);
        return redirect()->route('properties.index')->with('message', 'ویژگی با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
