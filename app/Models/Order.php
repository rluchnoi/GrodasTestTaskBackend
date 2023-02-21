<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Order class
 */
class Order extends Model
{
    /**
     * Default order id (used for seeding)
     */
    const ID_DEFAULT = 1;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'user_id',
    ];

    /**
     * Products of the order
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * User of the order
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
