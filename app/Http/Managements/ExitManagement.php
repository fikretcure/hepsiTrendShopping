<?php

namespace App\Http\Managements;

use Illuminate\Http\JsonResponse;

/**
 *
 */
class ExitManagement
{
    /**
     * @param $data
     * @return JsonResponse
     */
    public static function ok($data = null): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => true
        ]);
    }


    /**
     * @param $data
     * @param int $status
     * @return JsonResponse
     */
    public static function error($data = null, int $status = 422): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => false
        ]);
    }
}
