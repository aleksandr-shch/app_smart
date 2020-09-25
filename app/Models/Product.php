<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Product
 *
 * @property string $id
 * @property string $product_name
 * @property string $image_url
 * @property string $categories_id
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereCategories($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereImageUrl($value)
 * @method static Builder|Product whereProductName($value)
 */
class Product extends Eloquent
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'products';

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['id', 'product_name', 'image_url', 'categories_id'];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category');
    }
}