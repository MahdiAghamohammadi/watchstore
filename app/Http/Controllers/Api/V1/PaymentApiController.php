<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentApiController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/v1/payment",
     *  tags={"Payment"},
     *  description="send products id in basket to payment",
     *  security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *        required = true,
     *        description = "Data packet for Test",
     *        @OA\JsonContent(
     *             type="object",
     *              @OA\Property(
     *                 property="address_id",
     *                 type="integer",
     *                 example="4"
     *                ),
     *             @OA\Property(
     *                property="items",
     *                type="array",
     *                example={{
     *                  "product_id": 2,
     *                  "count": 2,
     *                }, {
     *                  "product_id": 3,
     *                  "count": 2,
     *                }
     *     },
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="product_id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="count",
     *                         type="integer",
     *                         example="2"
     *                      ),
     *                ),
     *             ),
     *        ),
     *     ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     * )
     */
    public function payment(Request $request)
    {
        $user = auth()->user();
        $totalPrice = 0;
        foreach ($request->items as $item) {
            $product = Product::query()->find($item["product_id"]);
            if ($product->discount === 0) {
                $totalPrice += ($product->price * $item["count"]);
            } else {
                $totalPrice += ($product->price - (($product->price * $product->discount) / 100)) * $item["count"];
            }
        }

        $order = Order::query()->create([
            'total_price' => $totalPrice,
            'code' => rand(1111, 9999),
            'address_id' => $request->address_id,
            'user_id' => $user->id,
        ]);

        foreach ($request->items as $item) {
            $product = Product::query()->find($item["product_id"]);
            if ($product->discount === 0) {
                $priceWithDiscount = ($product->price * $item["count"]);
            } else {
                $priceWithDiscount = ($product->price - (($product->price * $product->discount) / 100)) * $item["count"];
            }

            $orderDetail = OrderDetail::query()->create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'count' => $item['count'],
                'price' => $product->price,
                'discount' => $product->discount,
                'discount_price' => $priceWithDiscount,
            ]);
        }

        $res = Payment::purchase(
            (new Invoice)->amount($totalPrice),
            function ($driver, $transactionId) use ($order) {
                $order->update([
                    'transaction_id' => $transactionId
                ]);
            }
        )->pay()->toJson();
        return json_decode($res);
    }

    public function callback(Request $request)
    {
        $authority = $_GET['Authority'];
        $order = Order::query()->firstWhere('transaction_id', $authority);
        $code = $order->code;
        $orderDetails = OrderDetail::query()->where('order_id', $order->id)->get();

        if ($_GET['Status'] == 'OK') {
            $order->update([
                'status' => PaymentStatus::Success->value
            ]);
            foreach ($orderDetails as $orderDetail) {
                $product = Product::query()->find($orderDetail->product_id);
                $product->increment('sold', $orderDetail->count);
                $product->decrement('count', $orderDetail->count);

                $orderDetail->update([
                    'status' => OrderStatus::Send->value
                ]);
            }
            return view('admin.pay.accept', compact('code'));
        } else {
            $order->update([
                'status' => PaymentStatus::Failed->value
            ]);
            foreach ($orderDetails as $orderDetail) {
                $orderDetail->update([
                    'status' => OrderStatus::Rejected->value
                ]);
            }
            return view('admin.pay.reject');
        }
    }
}
