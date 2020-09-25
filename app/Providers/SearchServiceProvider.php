<?php

namespace App\Providers;

use App\Services\CategoryService;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\CategoryService', function()
        {
            return new CategoryService();
        });
    }

    /**
     * @return string[]
     */
    public function boot()
    {
        return [CategoryService::class];
    }
}
