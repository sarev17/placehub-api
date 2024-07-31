<?php

namespace App\Http\Services\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class ApiResponseService
{
    /**
     * Succes response API
     * @param string $message - Message for response
     * @param array $data - data for response
     * @param int $code - Status code
     * @return JsonResponse
     */
    public static function success($message,$data,$code=200)
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Succes response API
     * @param string $message Message for response
     * @param mixed $data data for response
     * @param int $code Status code
     * @return JsonResponse
     */
    public static function error($message,$data,$code=400)
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

}
