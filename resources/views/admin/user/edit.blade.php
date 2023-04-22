@extends('admin.layouts.master')
@section('content')
    <main class="main-content">
        <div class="row">
            @if(\Illuminate\Support\Facades\Session::has('message'))
                <div class="alert alert-info ml-3">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ویرایش کاربر</h6>
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div>
                            <figure class="avatar avatar">
                                <img src="{{ url('images/admin/users/big/'.$user->photo) }}" class="rounded-circle"
                                     alt="image">
                            </figure>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="name">نام و نام خانوادگی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" id="name" name="name" value="{{ old('name', $user->name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="email">ایمیل</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control text-left" dir="rtl" id="email" name="email" value="{{ old('email', $user->email) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="mobile">موبایل</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" id="mobile" dir="rtl" name="mobile" value="{{ old('mobile', $user->mobile) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="password">پسورد</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control text-left" id="password" dir="rtl"
                                       name="password" value="{{ old('password', $user->password) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="file"> آپلود عکس </label>
                            <input class="col-sm-10 form-control-file" type="file" id="file" name="file">
                        </div>
                        <div class="form-group row">
                            <button name="submit" type="submit" class="btn btn-success btn-uppercase">
                                <i class="ti-check-box m-r-5"></i> ذخیره
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
