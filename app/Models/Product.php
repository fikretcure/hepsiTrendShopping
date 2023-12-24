<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

/**
 *
 */
class Product extends Model
{
    use HasFactory , SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'stock',
        'payment_type',
        'desc',
        'avatar',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * @param $value
     * @return string|null
     */
    public function getAvatarAttribute($value): ?string
    {
        return $value ? Request::root() . '/storage/avatar/' . $value : null;
    }
}
