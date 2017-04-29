<?php

namespace App\Providers\v1;

use App\Services\v1\FavoritesService;
use Illuminate\Support\ServiceProvider;

class FavoriteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(FavoritesService::class, function($app){
            return new FavoritesService();
        });
        //
    }
}
