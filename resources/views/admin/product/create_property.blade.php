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
                    <h6 class="card-title">اضافه کردن ویژگی محصول </h6>
                    <form role="form" method="POST" action="{{ route('store-product-properties', $product->id) }}">
                        @csrf
                        <div class="card-body">
                            @foreach($propertyGroups as $key => $propertyGroup)
                                <div class="mt-2 row">
                                    <div class="col-sm-4">
                                        <label for="title">{{ $propertyGroup->title }}:</label>
                                    </div>
                                    <div class="col-sm-8 padding-0-18">
                                        <select class="form-select" name="properties[]" style="width: 100%;"
                                                data-select2-id="{{ $key }}" tabindex="-1" aria-hidden="true">
                                            @foreach($propertyGroup->properties()->pluck('title', 'id') as $key => $properties)
                                                <option
                                                    value="{{ $key }}"
                                                    @if (in_array($key, $product->properties()->pluck('id')->toArray()))
                                                        selected
                                                    @endif>
                                                    {{ $properties }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">ثبت</button>
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
