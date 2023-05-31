<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductRepository;
use App\Http\Services\Keys;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function most_sold_products()
    {
        return response()->json([
            'result' => true,
            'message' => 'Application products Page',
            'data' => [
                Keys::brands => Brand::getAllBrands(),
                Keys::most_seller_products => ProductRepository::getAllMostSellerProducts()
                    ->response()
                    ->getData(true),
            ],
        ]);
    }

    public function most_viewed_products()
    {
        return response()->json([
            'result' => true,
            'message' => 'Application products Page',
            'data' => [
                Keys::brands => Brand::getAllBrands(),
                Keys::most_viewed_products => ProductRepository::getMostViewedProducts()
                    ->response()
                    ->getData(true),
            ],
        ]);
    }

    public function newest_products()
    {
        return response()->json([
            'result' => true,
            'message' => 'Application products Page',
            'data' => [
                Keys::brands => Brand::getAllBrands(),
                Keys::newest_products => ProductRepository::getAllNewestProducts()
                    ->response()
                    ->getData(true),
            ],
        ]);
    }

    public function cheapest_products()
    {
        return response()->json([
            'result' => true,
            'message' => 'Application products Page',
            'data' => [
                Keys::brands => Brand::getAllBrands(),
                Keys::cheapest_products => ProductRepository::getCheapestProducts()
                    ->response()
                    ->getData(true),
            ],
        ]);
    }

    public function most_expensive_products()
    {
        return response()->json([
            'result' => true,
            'message' => 'Application products Page',
            'data' => [
                Keys::categories => Category::getAllCategories(),
                Keys::most_expensive_products => ProductRepository::getMostExpensiveProducts()
                    ->response()
                    ->getData(true),
            ],
        ]);
    }
}
