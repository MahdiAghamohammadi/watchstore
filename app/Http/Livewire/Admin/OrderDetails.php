<?php

namespace App\Http\Livewire\Admin;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderDetail;
use Livewire\Component;
use Livewire\WithPagination;

class OrderDetails extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $order_id;
    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public function changeStatus($orderDetailId)
    {
        $orderDetail = OrderDetail::query()->find($orderDetailId);
        if ($orderDetail->status === OrderStatus::Received->value) {
            $orderDetail->update([
                'status' => OrderStatus::Rejected->value
            ]);
        } else if ($orderDetail->status === OrderStatus::Processing->value) {
            $orderDetail->update([
                'status' => OrderStatus::Send->value
            ]);
        } else if ($orderDetail->status === OrderStatus::Send->value) {
            $orderDetail->update([
                'status' => OrderStatus::Received->value
            ]);
        } else {
            $orderDetail->update([
                'status' => OrderStatus::Processing->value
            ]);
        }
    }

    public function render()
    {
        $orderDetails = OrderDetail::query()
            ->where('order_id', $this->order_id)
            ->paginate(15);
        $totalPrice = Order::query()->find($this->order_id)->total_price;
        return view('livewire.admin.order-details', compact('orderDetails', 'totalPrice'));
    }
}
