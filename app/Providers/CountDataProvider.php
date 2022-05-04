<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CountDataProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path().'/Mixins/CountData.php';
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
