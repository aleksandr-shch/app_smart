<?php

namespace App\Providers;

use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\ProductService', function()
        {
            return new ProductService();
        });
    }

    /**
     * @return string[]
     */
    public function boot()
    {
        return [ProductService::class];
    }
}
