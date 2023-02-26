<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Product class
 */
class Product extends Model
{
    /**
     * Default products' ids of different types (used for seeding)
     */
    const ID_DEFAULT_CAR = 1;
    const ID_DEFAULT_HOUSE = 2;
    const ID_DEFAULT_CLOTHES = 3;

    /**
     * Disable timestamps
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'name',
        'order_id',
        'price',
        'currency_name'
    ];

    /**
     * Categories of the product
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Order of the product
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Currency of the product
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class)->withDefault(function () {
            return Currency::getDefault();
        });
    }
}
