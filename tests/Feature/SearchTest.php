<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;


class SearchTest extends TestCase
{
    public function testSearchProductsView()
    {
        $q = Str::random(rand(0,30));

        $view = $this->view('products',
            ['products' =>
                ['q' => $q, 'page' => rand(0,10), 'pages' => rand(0,100),
                    config('constants.productApiOptions.id') => rand(100000000000, 10000000000000),
                    config('constants.productApiOptions.name') => Str::random(rand(0,30)),
                    config('constants.productApiOptions.imageUrl') => Str::random(rand(0,30)),
                    config('constants.productApiOptions.category') => Str::random(rand(0,30))
                ]
            ]
        );
        $view->assertSee($q);
    }

    public function testSearchRequest()
    {
        $q = Str::random(rand(0,30));

        Http::fake();
        Http::post(config('constants.productApiOptions.url'),
            [
                'action' => config('constants.productApiOptions.action'),
                'sort_by' => config('constants.productApiOptions.sortBy'),
                'page_size' => config('constants.productApiOptions.pageSize'),
                'search_terms' => $q,
                'json' => config('constants.productApiOptions.json'),
                'page' => 1
            ]
        );
        Http::assertSent(function ($request) use($q)
        {
            return $request->url() == config('constants.productApiOptions.url') &&
                $request['action'] == config('constants.productApiOptions.action') &&
                $request['sort_by'] == config('constants.productApiOptions.sortBy') &&
                $request['page_size'] == config('constants.productApiOptions.pageSize') &&
                $request['search_terms'] == $q &&
                $request['json'] == config('constants.productApiOptions.json') &&
                $request['page'] == 1;
        });
    }
}
