<?php

namespace App\Http\Services;


/**
 *
 */
class GatewayService extends Service
{

    /**
     *
     */
    public function __construct()
    {
        $this->baseUrl = env('GATEWAY_BASE_URL');
    }
}
