<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لیست اسلایدر';
        return view('admin.slider.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد اسلایدر';
        return view('admin.slider.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $image = saveImage($request->file, 'sliders');
        Slider::query()->create([
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'image' => $image,
        ]);
        return to_route('sliders.index')->with('message', 'اسلایدر جدید با موفقیت ثبت شد.');
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
    public function edit(Slider $slider)
    {
        $title = 'ویرایش اسلایدر';
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        $image = saveImage($request->file, 'sliders');
        $slider->update([
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'image' => ($request->file ? $image : $slider->image),
        ]);
        return to_route('sliders.index')->with('message', 'اسلایدر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
