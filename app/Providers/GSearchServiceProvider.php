<?php

namespace App\Providers;

use App\Services\GoogleSearchParser;
use Illuminate\Support\ServiceProvider;

class GSearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\GoogleSearchParser', function (){
            return new GoogleSearchParser();
        });
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
