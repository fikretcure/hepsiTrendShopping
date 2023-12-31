<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class OrderItem extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
        'is_successful'
    ];


    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }
}
