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
                    <h6 class="card-title">ویرایش ویژگی ها</h6>
                    <form method="POST" action="{{ route('properties.update', $property->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="title">عنوان</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" id="title" name="title"
                                       value="{{ old('title', $property->title) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="property_group_id">گروه ویژگی ها</label>
                            <div class="col-sm-10">
                                <select name="property_group_id" id="property_group_id"
                                        class="form-select"
                                        style="width: 100%;"
                                        data-select2-id="1"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    @foreach($propertyGroups as $key => $value)
                                        <option
                                            value="{{ $key }}"
                                            @if (old('property_group_id', $property->property_group_id) == $key)
                                                selected
                                            @endif>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
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
