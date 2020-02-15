<?php

namespace App\Providers;

use App\Http\Repositories\Absr\IUrlRepository;
use App\Http\Repositories\Concrete\UrlRepository;
use App\Http\Services\Abstr\IUrlService;
use App\Http\Services\Concrete\UrlService;
use Illuminate\Support\ServiceProvider;

class UrlServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUrlService::class, UrlService::class);
        $this->app->bind(IUrlRepository::class, UrlRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
