<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لیست کاربران';
        return view('admin.user.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد کاربر';
        return view('admin.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $image = saveImage($request->file, 'users');
        User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'password' => Hash::make($request->input('password')),
            'photo' => $image,
        ]);
        return to_route('users.index')->with('message', 'کاربر جدید با موفقیت ثبت شد.');
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
    public function edit(User $user)
    {
        $title = 'ویرایش کاربر';
        return view('admin.user.edit', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $image = saveImage($request->file, 'users');
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'password' => ($request->input('password') ? Hash::make($request->input('password')) : $user->password),
            'photo' => ($request->file ? $image : $user->photo),
        ]);
        return to_route('users.index')->with('message', 'کاربر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function createUserRoles(User $user)
    {
        $roles = Role::query()->get();
        return view('admin.user.create-user-roles', compact('user', 'roles'));
    }

    public function storeUserRoles(Request $request, User $user)
    {
        $user->syncRoles([$request->roles]);
        return to_route('users.index')->with('message', 'نقش های کاربر با موفقیت ویرایش شد.');
    }

}
