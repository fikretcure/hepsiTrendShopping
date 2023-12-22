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
    public static function ok($data = null)
    {
        return response()->json([
            'data' => $data
        ]);
    }


    /**
     * @param $data
     * @param $status
     * @return JsonResponse
     */
    public static function error($data = null, $status = 422)
    {
        return response()->json($data, $status);
    }
}
