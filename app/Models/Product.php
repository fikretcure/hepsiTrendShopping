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
        'stock',
        'is_daily',
        'desc',
        'avatar',
    ];

   protected $casts = [
       'is_daily' => 'bool'
   ];


    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
