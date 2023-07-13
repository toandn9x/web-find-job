<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
/**
 * 
 */
trait ResponseTrait
{
    public static function responseSuccess($data = [], $message = "success", $code = 0, $httpStatusCode = 200) {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $httpStatusCode);
    }

    public static function responseError($data = [], $message = "error", $code = 500, $httpStatusCode = 500) {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $httpStatusCode);
    }
}