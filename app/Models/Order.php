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
     * Order statuses
     */
    const STATUS_OPEN = 1;
    const STATUS_CLOSED = 2;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'user_id',
        'status'
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

    /**
     * Check if order is open
     */
    public function isOpen(): bool
    {
        return $this->status === self::STATUS_OPEN;
    }

    /**
     * Check if order is closed
     */
    public function isClosed(): bool
    {
        return $this->status === self::STATUS_CLOSED;
    }

    /**
     * Clean up related products before deleting an order
     */
    public static function boot() {
        parent::boot();
        
        self::deleting(fn ($order) => $order->products()->each(
            fn ($product) => $product->delete())
        );
    }
}
