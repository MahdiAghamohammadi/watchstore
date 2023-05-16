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
                    <form method="POST" class="dropzone border border-primary border-radius-1"
                          action="{{ route('store-product-gallery', $product->id) }}">
                        @csrf
                        <div class="form-group row">
                            <div class="fallback">
                                <input type="file" name="file" id="file" multiple>
                            </div>
                        </div>
                    </form>
                    <livewire:admin.galleries :product_id="$product->id"/>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script src="{{ asset('panel/plugins/dropzone/js/dropzone.js') }}"></script>
    <script src="{{ asset('panel/plugins/sweet_alert/sweetalert2.all.min.js') }}"></script>
    <script>
        window.addEventListener('deleteGallery', event => {
            Swal.fire({
                title: 'آیا از حذف مطمئن هستید؟',
                text: "شما این عکس را نمیتوانید برگردانید!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله، حذف شود!',
                cancelButtonText: 'نه، منصرف شدم!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('destroyGallery', event.detail.product_id, event.detail.id);
                    Swal.fire(
                        'حذف شد.',
                        'عکس مورد نظر حذف شد.',
                        'success'
                    )
                }
            })
        });
    </script>
@endsection
