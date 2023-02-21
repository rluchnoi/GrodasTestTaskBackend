<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Category class
 */
class Category extends Model
{
    /**
     * Categories' IDs
     */
    const ID_EXPENSIVE = 1;
    const ID_MEDUIM = 2;
    const ID_CHEAP = 3;

    const ID_CARS = 4;
    const ID_HOUSES = 5;
    const ID_CLOTHES = 6;

    /**
     * Categories' names
     */
    const EXPENSIVE_NAME = 'Expensive';
    const MEDIUM_NAME = 'Medium';
    const CHEAP_NAME = 'Cheap';

    const CARS_NAME = 'Cars';
    const HOUSES_NAME = 'Houses';
    const CLOTHES_NAME = 'Clothes';

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
    ];

    /**
     * Products of the category
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
