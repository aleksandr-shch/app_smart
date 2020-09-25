<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * SearchController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @return Application|Factory|View
     */
    public function search()
    {
        return view('search');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    protected function getProducts(Request $request)
    {
        $query = $request->request->get('q');

        if(empty($query))
        {
            flash('Запрос не должен быть пустым!')->error();

            return view('search');
        }
        $page = 1;

        if($request->has('page') && $request->request->get('page') > 1)
        {
            $page = $request->request->get('page');
        }
        $productsArray = $this->productService->getProduct($page, $query);

        return view('products', ['products' => $productsArray]);
    }
}
