@extends('admin.layouts.master')
@section('head-tag')
    <link rel="stylesheet" href="{{ asset('panel/plugins/sweet_alert/sweetalert2.min.css') }}">
@endsection
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
                <livewire:admin.brands/>
            </div>
        </div>

    </main>
@endsection
@section('scripts')
    <script src="{{ asset('panel/plugins/sweet_alert/sweetalert2.all.min.js') }}"></script>
    <script>
        window.addEventListener('deleteBrand', event => {
            Swal.fire({
                title: 'آیا از حذف مطمئن هستید؟',
                text: "شما این برند را نمیتوانید برگردانید!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله، حذف شود!',
                cancelButtonText: 'نه، منصرف شدم!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('destroyBrand', event.detail.id);
                    Swal.fire(
                        'حذف شد.',
                        'برند مورد نظر حذف شد.',
                        'success'
                    )
                }
            })
        });
    </script>
@endsection
