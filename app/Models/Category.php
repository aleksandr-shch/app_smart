<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Category
 *
 * @property string $categories
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCategories($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereImageUrl($value)
 * @method static Builder|Category whereProductName($value)
 */
class Category extends Eloquent
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['categories'];

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}