<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Currency class
 */
class Currency extends Model
{
    /**
     * Disable timestamps
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'buy_price_in_UAH',
        'sell_price_in_UAH'
    ];
}
