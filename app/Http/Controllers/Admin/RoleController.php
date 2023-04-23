<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لیست نقش ها';
        return view('admin.role.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد کاربر';
        return view('admin.role.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Role::query()->create([
            'name' => $request->input('name'),
        ]);
        return to_route('roles.index')->with('message', 'نقش جدید با موفقیت ثبت شد.');
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
    public function edit(Role $role)
    {
        $title = 'ویرایش نقش';
        return view('admin.role.edit', compact('role', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->update([
            'name' => $request->input('name'),
        ]);
        return to_route('roles.index')->with('message', 'نقش با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
