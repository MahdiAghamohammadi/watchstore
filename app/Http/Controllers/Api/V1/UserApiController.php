<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    /**
     * @OA\Post(
     ** path="/api/v1/register",
     *  tags={"User Api"},
     *  security={{"sanctum":{}}},
     *  description="use to signin user with recieved code",
     * @OA\RequestBody(
     *    required=true,
     *         @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               @OA\Property(
     *                  property="image",
     *                  description="user image",
     *                  type="array",
     *                  @OA\Items(
     *                       type="string",
     *                       format="binary",
     *                  ),
     *               ),
     *           @OA\Property(
     *                  property="phone",
     *                  description="user phone number",
     *                  type="string",
     *               ),
     *          @OA\Property(
     *                  property="name",
     *                  description="user name",
     *                  type="string",
     *               ),
     *          @OA\Property(
     *                  property="address",
     *                  description="user address",
     *                  type="string",
     *               ),
     *          @OA\Property(
     *                  property="postal_code",
     *                  description="user postal code",
     *                  type="string",
     *               ),
     *          @OA\Property(
     *                  property="lat",
     *                  description="user location latitude",
     *                  type="double",
     *               ),
     *          @OA\Property(
     *                  property="lang",
     *                  description="user location longitude",
     *                  type="double",
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

    public function register(Request $request)
    {
        $user = auth()->user();
        $image = saveImage($request->image, 'users');
        if ($user) {
            $user->update([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'photo' => $image,
            ]);
            $user->addresses()->create([
                'address' => $request->input('address'),
                'postal_code' => $request->input('postal_code'),
                'lat' => $request->input('lat'),
                'lang' => $request->input('lang'),
            ]);
            return response()->json([
                'result' => true,
                'message' => 'user info is stored.',
                'data' => [
                    'user' => new UserResource($user)
                ]
            ], 201);
        } else {
            return response()->json([
                'result' => true,
                'message' => 'user not login',
                'data' => []
            ], 403);
        }
    }
}
