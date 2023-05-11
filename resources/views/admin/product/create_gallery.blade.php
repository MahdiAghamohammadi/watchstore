@extends('admin.layouts.master')
@section('head-tag')
    <link rel="stylesheet" href="{{ asset('panel/plugins/dropzone/css/dropzone.css') }}">
@endsection
@section('content')
    <main class="main-content">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">گالری محصول {{ $product->name }}</h6>
                    <form method="POST" class="dropzone border border-primary border-radius-1" action="{{ route('store-product-gallery', $product->id) }}">
                        @csrf
                        <div class="form-group row">
                            <div class="fallback">
                                <input type="file" name="file" id="file" multiple>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script src="{{ asset('panel/plugins/dropzone/js/dropzone.js') }}"></script>i
@endsection
