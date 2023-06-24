<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductRepository;
use App\Http\Resources\ProductResource;
use App\Http\Services\Keys;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/v1/most_sold_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function mostSoldProducts()
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

    /**
     * @OA\Get(
     ** path="/api/v1/most_viewed_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function mostViewedProducts()
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

    /**
     * @OA\Get(
     ** path="/api/v1/newest_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function newestProducts()
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

    /**
     * @OA\Get(
     ** path="/api/v1/cheapest_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function cheapestProducts()
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

    /**
     * @OA\Get(
     ** path="/api/v1/most_expensive_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function mostExpensiveProducts()
    {
        return response()->json([
            'result' => true,
            'message' => 'Application products Page',
            'data' => [
                Keys::brands => Brand::getAllBrands(),
                Keys::most_expensive_products => ProductRepository::getMostExpensiveProducts()
                    ->response()
                    ->getData(true),
            ],
        ]);
    }

    /**
     * @OA\Get(
     ** path="/api/v1/products_by_category/{id}",
     *  tags={"Products Page"},
     *  description="get products data by category id",
     * *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function productsByCategory(Category $category)
    {
        return response()->json([
            'result' => true,
            'message' => 'Application products Page',
            'data' => [
                Keys::brands => Brand::getAllBrands(),
                Keys::products_by_category => ProductRepository::getProductsByCategory($category->id)
                    ->response()
                    ->getData(true),
            ],
        ]);
    }


    /**
     * @OA\Get(
     ** path="/api/v1/products_by_brand/{id}",
     *  tags={"Products Page"},
     *  description="get products data by brand id",
     * *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function productsByBrand(Brand $brand)
    {
        return response()->json([
            'result' => true,
            'message' => 'Application products Page',
            'data' => [
                Keys::brands => Brand::getAllBrands(),
                Keys::products_by_brand => ProductRepository::getProductsByBrand($brand->id)
                    ->response()
                    ->getData(true),
            ],
        ]);
    }

    /**
     * @OA\Get(
     ** path="/api/v1/product_details/{id}",
     *  tags={"Product Details"},
     *  description="get product details data by product id",
     * *     @OA\Parameter(
     *         description="product id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function productDetail(Product $product)
    {
        $product->increment('review');
        return response()->json([
            'result' => true,
            'message' => 'Application products Page',
            'data' => [
                new ProductResource($product),
            ],
        ]);
    }

    /**
     * @OA\Post(
     ** path="/api/v1/save_product_comment/{id}",
     *  tags={"Product Details"},
     *   security={{"sanctum":{}}},
     *  description="save user comment for product",
     *       @OA\Parameter(
     *         description="product id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     * @OA\RequestBody(
     *    required=true,
     *         @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *             @OA\Property(
     *                  property="parent_id",
     *                  description="product id",
     *                  type="integer",
     *               ),
     *             @OA\Property(
     *                  property="body",
     *                  description="user comment text",
     *                  type="string",
     *               ),
     *           ),
     *       )
     * ),
     *   @OA\Response(
     *      response=200,
     *      description="Data saved",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function saveComment(Request $request, Product $product)
    {
        $user = auth()->user();
        $comment = Comment::query()->create([
            'body' => $request->input('body'),
            'parent_id' => $request->input('parent_id', null),
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
        return response()->json([
            'result' => true,
            'message' => 'Application products Page',
            'data' => [
                new ProductResource($product),
            ],
        ]);
    }

    /**
     * @OA\Post(
     ** path="/api/v1/search_product",
     *  tags={"Products Page"},
     *  description="search product",
     *    @OA\RequestBody(
     *    required=true,
     *          @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *           @OA\Property(
     *                  property="search",
     *                  type="string",
     *               ),
     *     )
     *   )
     * ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function searchProduct(Request $request)
    {
        return response()->json([
            'result' => true,
            'message' => 'application products page',
            'data' => [
                Keys::brands => Brand::getAllBrands(),
                Keys::searched_products => ProductRepository::searchedProduct($request->input('search'))
                    ->response()
                    ->getData(true),
            ]

        ], 200);
    }
}
