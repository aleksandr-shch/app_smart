<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @param CategoryService $categoryService
     * @param ProductService $productService
     * @return string
     */
    public function addProduct(Request $request, CategoryService $categoryService, ProductService $productService)
    {
        $validator = Validator::make($request->all(), [
            config('constants.productApiOptions.id') => 'required',
            config('constants.productApiOptions.name') => 'required',
            config('constants.productApiOptions.imageUrl') => 'required',
            config('constants.productApiOptions.category') => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['success' => false, 'message' => $validator->errors()->all()]);
        }

        $id = $request->post(config('constants.productApiOptions.id'));
        $productName = $request->post(config('constants.productApiOptions.name'));
        $imageURL = $request->post(config('constants.productApiOptions.imageUrl'));
        $categories = $request->post(config('constants.productApiOptions.category'));

        try
        {
            $category = $categoryService->addCategory($categories);
            $product = $productService->addProduct($id, $productName, $imageURL, $category->getAttribute('id'));
        }
        catch(Exception $exception)
        {
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }
        $message = Lang::get('products.productJsonOptions.exist');

        if($product->wasRecentlyCreated)
        {
            $message = Lang::get('products.productJsonOptions.inserted');
        }

        return response()->json(['success' => true, 'message' => $message]);
    }
}
