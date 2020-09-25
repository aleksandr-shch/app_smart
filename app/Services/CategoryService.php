<?php


namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryService
{
    /**
     * @param $categories
     * @return Category|Model
     */
    public function addCategory($categories)
    {
        return Category::firstOrCreate([config('constants.productApiOptions.category') => $categories]);
    }
}
