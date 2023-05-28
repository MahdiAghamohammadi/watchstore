<?php

namespace App\Http\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductRepository
{
    public static function getAmazingProducts()
    {
        $products = Product::query()
            ->where('is_special', true)
            ->orderBy('discount', 'DESC')
            ->take(6)
            ->get();

        return ProductResource::collection($products);
    }

    public static function getMostSellerProducts()
    {
        $products = Product::query()
            ->orderBy('sold', 'DESC')
            ->take(6)
            ->get();

        return ProductResource::collection($products);
    }

    public static function getNewestProducts()
    {
        $products = Product::query()
            ->orderBy('created_at', 'DESC')
            ->take(6)
            ->get();

        return ProductResource::collection($products);
    }
}
