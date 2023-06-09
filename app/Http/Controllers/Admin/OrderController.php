<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders()
    {
        return view('admin.orders.index');
    }

    public function orderDetails(Order $order)
    {
        return view('admin.orders.order-details', compact('order'));
    }
}
