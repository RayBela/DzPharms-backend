<?php

namespace App\Providers\v1;

use Illuminate\Support\ServiceProvider;
use App\Services\v1\PharmacyService;

class PharmacyServiceProvider extends ServiceProvider
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
        //

        $this->app->bind(PharmacyService::class, function($app){

            return new PharmacyService();
        });
    }
}
