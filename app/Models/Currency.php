<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Currency class
 */
class Currency extends Model
{
    /**
     * Default currency name
     */
    const DEFAULT_CURRENCY_NAME = 'USD';

    /**
     * Primary key
     */
    protected $primaryKey = 'name';

    /**
     * Cast name as string 
     */
    protected $casts = ['name' => 'string'];

    /**
     * Disable timestamps
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'rate',
        'full_name',
        'exchange_date'
    ];

    /**
     * Products with that currency
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get default currency
     */
    static public function getDefault(): self
    {
        return self::find(self::DEFAULT_CURRENCY_NAME);
    }
}
