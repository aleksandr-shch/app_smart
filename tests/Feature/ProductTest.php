<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class ProductTest extends TestCase
{
    /**
     * @return void
     */
    public function testSearchView()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testAjaxCreateProduct()
    {
        $response = $this->withHeaders([
            'X-Requested-With' => 'XMLHttpRequest',
            'Content-type', 'application/x-www-form-urlencoded'
        ])->json('POST', '/add_product', [
                    config('constants.productApiOptions.id')=> rand(100000000000, 10000000000000),
                    config('constants.productApiOptions.name') => Str::random(rand(0,30)),
                    config('constants.productApiOptions.imageUrl') => Str::random(rand(0,30)),
                    config('constants.productApiOptions.category') => Str::random(rand(0,30))
                ]);

        $response
            ->assertStatus(200)
            ->assertExactJson(['success' => true, 'message' => config('constants.productJsonOptions.inserted')]);
    }
}
