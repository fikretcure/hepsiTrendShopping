<?php

namespace App\Http\Managements;

use Illuminate\Support\Facades\Redis;

/**
 *
 */
class RedisManagement
{
    /**
     * @param int $user_id
     * @return mixed
     */
    public function getUserById(int $user_id): mixed
    {
       return  collect(json_decode(Redis::get('users')))->where('id',$user_id)->values()->first();
    }
}
