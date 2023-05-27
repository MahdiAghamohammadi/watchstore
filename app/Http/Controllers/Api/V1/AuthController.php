<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SmsCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     ** path="/api/v1/send_sms",
     *  tags={"Auth Api"},
     *  description="use for send verification sms to user",
     * @OA\RequestBody(
     *    required=true,
     * *         @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *           @OA\Property(
     *                  property="mobile",
     *                  description="Enter mobile number",
     *                  type="string",
     *               ),
     *     )
     *   )
     * ),
     *   @OA\Response(
     *      response=201,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function sendSms(Request $request)
    {
        $mobile = $request->input('mobile');
        $checkLastSend = SmsCode::checkTwoMinute($mobile);
        if (!$checkLastSend) {
            $code = rand(111111, 999999);
            SmsCode::query()->create([
                'mobile' => $mobile,
                'code' => $code
            ]);
            return response()->json([
                'result' => true,
                'message' => 'send sms is done',
                'data' => [
                    'mobile' => $mobile,
                    'code' => $code
                ]
            ], 201);
        } else {
            return response()->json([
                'result' => false,
                'message' => 'please wait for two minutes.',
                'data' => []
            ], 403);
        }
    }

    /**
     * @OA\Post(
     ** path="/api/v1/verify_sms_code",
     *  tags={"Auth Api"},
     *  description="use to check sms code that recieved by user",
     * @OA\RequestBody(
     *    required=true,
     * *         @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *           @OA\Property(
     *                  property="mobile",
     *                  description="user mobile number",
     *                  type="string",
     *               ),
     *           @OA\Property(
     *                  property="code",
     *                  description="recieved user sms code",
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
    public function verifySmsCode(Request $request)
    {
        $mobile = $request->input('mobile');
        $code = $request->input('code');

        $checkCode = SmsCode::checkCode($mobile, $code);

        if ($checkCode) {
            $user = User::query()->where('mobile', $mobile)->first();
            if ($user) {
                return response()->json([
                    'result' => true,
                    'message' => 'user is registered before.',
                    'data' => [
                        'user_id' => $user->id,
                        'token' => $user->createToken('new Token')->plainTextToken
                    ]
                ], 200);
            } else {
                $user = User::query()->create([
                    'mobile' => $mobile,
                    'password' => Hash::make(rand(1111, 9999))
                ]);
                return response()->json([
                    'result' => true,
                    'message' => 'user created',
                    'data' => [
                        'user_id' => $user->id,
                        'token' => $user->createToken('new Token')->plainTextToken
                    ]
                ], 201);
            }
        } else {
            return response()->json([
                'result' => false,
                'message' => 'code or mobile is wrong.',
                'data' => []
            ], 403);
        }
    }
}
