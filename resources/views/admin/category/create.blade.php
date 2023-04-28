@extends('admin.layouts.master')
@section('head-tag')
    <link rel="stylesheet" href="{{ asset('panel/vendors/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <main class="main-content">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ایجاد دسته بندی</h6>
                    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="title">نام دسته بندی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" id="title" name="title"
                                       value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="parent_id">دسته پدر</label>
                            <div class="col-sm-10">
                                <select name="parent_id" id="parent_id"
                                        class="form-select"
                                        style="width: 100%;"
                                        data-select2-id="1"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    <option selected="selected" value="0">دسته اصلی</option>
                                    @foreach($categories as $key => $category)
                                        <option selected="selected" value="{{ $key }}">{{ $category }}</option>
                                    @endforeach
                                </select>
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
@section('scripts')
    <script src="{{ asset('panel/vendors/select2/js/select2.min.js') }}"></script>
    <script>
        $('.form-select').select2()
    </script>
@endsection
