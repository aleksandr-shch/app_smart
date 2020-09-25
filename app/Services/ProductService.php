<?php


namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use function GuzzleHttp\json_decode as json_decodeAlias;

class ProductService
{
    /**
     * @param $page
     * @param $query
     * @return mixed
     */
    public function getProduct($page, $query)
    {
        $searchParams = [
            'action' => config('constants.productApiOptions.action'),
            'sort_by' => config('constants.productApiOptions.sortBy'),
            'page_size' => config('constants.productApiOptions.pageSize'),
            'search_terms' => urlencode($query),
            'json' => config('constants.productApiOptions.json'),
            'page' => $page
        ];
        $productsSearch = Http::get(config('constants.productApiOptions.url'), $searchParams);
        $count = json_decode($productsSearch->body(), true)['count'];
        $products = json_decode($productsSearch->body(), true)['products'];

        $productCollection = collect($products)->map(function($product)
        {
            if(!array_key_exists(config('constants.productApiOptions.id'), $product))
            {
                    return null;
            }

            return [
                config('constants.productApiOptions.id') => $product[config('constants.productApiOptions.id')],
                config('constants.productApiOptions.name') => $product[config('constants.productApiOptions.name')] ?? '-',
                config('constants.productApiOptions.imageUrl') => $product[config('constants.productApiOptions.imageUrl')] ?? '-',
                config('constants.productApiOptions.category') => $product[config('constants.productApiOptions.category')] ?? '-'
            ];
        });

        $productCollection['count'] = $count;
        $productCollection['q'] = $query;
        $productCollection['page'] = $page;
        $productCollection['pages'] = $count/config('constants.productApiOptions.pageSize');

        return $productCollection;
    }

    /**
     * @param $id
     * @param $name
     * @param $image
     * @param $category
     * @return Product|Model
     */
    public function addProduct($id, $name, $image, $category)
    {
        $product = Product::firstOrCreate(
            [config('constants.productApiOptions.id') => $id],
            [
                config('constants.productApiOptions.name') => $name,
                config('constants.productApiOptions.imageUrl') => $image,
                'categories_id' => $category
            ]
        );

        if($product->save())
        {
            return $product;
        }
    }
}
