<?php

namespace App\Rules;

use App\Http\Managements\RedisManagement;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 *
 */
class UserCheckRule implements ValidationRule
{

    /**
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!(new RedisManagement())->getUserById($value)) {
            $fail('Gecersiz kullanici');
        }
    }
}
