@extends('admin.layouts.master')
@section('head-tag')
    <link rel="stylesheet" href="{{ asset('panel/vendors/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/plugins/datepicker/kamadatepicker.min.css') }}">
@endsection
@section('content')
    <main class="main-content">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ایجاد محصول</h6>
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="name">نام فارسی محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" id="name" name="name"
                                       value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="name_en">نام انگلسی محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" id="name_en" name="name_en"
                                       value="{{ old('name_en') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="price">قیمت محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" id="price" name="price"
                                       value="{{ old('price') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="count">تعداد محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" id="count" name="count"
                                       value="{{ old('count') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="guaranty">گارانتی محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" id="guaranty"
                                       name="guaranty"
                                       value="{{ old('guaranty') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="discount">تخفیف محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" id="discount"
                                       name="discount"
                                       value="{{ old('discount') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="description">توضیحات محصول</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description" class="form-control text-left" cols="30"
                                          rows="10">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input"
                                           id="customCheck"
                                           name="is_special"
                                           value="{{ old('is_special') }}">
                                    <label class="custom-control-label" for="customCheck">فروش ویژه</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="col-form-label" for="special_expire">تاریخ اعتبار فروش
                                    ویژه</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control text-left" dir="rtl" id="special_expire"
                                       name="special_expire"
                                       value="{{ old('special_expire') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="category_id">دسته بندی</label>
                            <div class="col-sm-10">
                                <select name="category_id" id="category_id"
                                        class="form-select"
                                        style="width: 100%;"
                                        data-select2-id="1"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    @foreach($categories as $key => $value)
                                        <option
                                            value="{{ $key }}"
                                            @if (old('category_id') == $key)
                                                selected
                                            @endif>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="brand_id">برند</label>
                            <div class="col-sm-10">
                                <select name="brand_id" id="brand_id"
                                        class="form-select"
                                        style="width: 100%;"
                                        data-select2-id="2"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    @foreach($brands as $key => $value)
                                        <option
                                            value="{{ $key }}"
                                            @if (old('brand_id') == $key)
                                                selected
                                            @endif>
                                            {{ $value }}
                                        </option>
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
    <script src="{{ asset('panel/plugins/datepicker/kamadatepicker.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        $('.form-select').select2()

        var customOptions = {
            placeholder: "روز / ماه / سال"
            , twodigit: false
            , closeAfterSelect: true
            , nextButtonIcon: "fa fa-arrow-circle-right"
            , previousButtonIcon: "fa fa-arrow-circle-left"
            , buttonsColor: "#5867dd"
            , markToday: true
            , markHolidays: true
            , highlightSelectedDay: true
            , sync: true
            , gotoToday: true
        }
        kamaDatepicker('special_expire', customOptions);

        if ($('#description').length) {
            CKEDITOR.replace('description');
        }
    </script>
@endsection
