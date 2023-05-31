<?php

namespace App\Http\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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

    public static function getAllMostSellerProducts()
    {
        $products = Product::query()
            ->orderBy('sold', 'DESC')
            ->paginate(12);

        return ProductResource::collection($products);
    }

    public static function getNewestProducts()
    {
        $products = Product::query()
            ->latest()
            ->take(6)
            ->get();

        return ProductResource::collection($products);
    }

    public static function getAllNewestProducts()
    {
        $products = Product::query()
            ->latest()
            ->get();

        return ProductResource::collection($products);
    }


    public static function getMostViewedProducts()
    {
        $products = Product::query()
            ->orderBy('review', 'DESC')
            ->paginate(12);

        return ProductResource::collection($products);
    }

    public static function getCheapestProducts()
    {
        $products = Product::query()
            ->orderBy('price', 'ASC')
            ->paginate(12);
        return ProductResource::collection($products);
    }

    public static function getMostExpensiveProducts()
    {
        $products = Product::query()
            ->orderBy('price', 'DESC')
            ->paginate(12);
        return ProductResource::collection($products);
    }

    public static function getProductsByCategory($id)
    {
        $products = Product::query()
            ->where('category_id', $id)
            ->paginate(12);
        return ProductResource::collection($products);
    }

    public static function getProductsByBrand($id)
    {
        $products = Product::query()
            ->where('brand_id', $id)
            ->paginate(12);
        return ProductResource::collection($products);
    }
}
