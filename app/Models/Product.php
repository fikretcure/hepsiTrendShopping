<?php

namespace App\Models;

use App\Http\Managements\RedisManagement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class Product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'daily_stock',
        'desc',
        'avatar',
        'user_id',
    ];


    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * @var string[]
     */
    protected $appends = [
        'expert_user'
    ];


    /**
     * @return mixed
     */
    public function getExpertUserAttribute(): mixed
    {
        return (new RedisManagement())->getUserById($this->user_id);
    }
}
