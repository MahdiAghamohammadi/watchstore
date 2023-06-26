@extends('admin.layouts.master')
@section('content')
    <main class="main-content">
        <div class="card">
            <div class="card-body">
                <livewire:admin.order-details :order_id="$order->id"/>
            </div>
        </div>
    </main>
@endsection
