<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelWhoisLookupProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Yk\LaravelWhoisLookup');

        $this->app->router->group(['namespace' => 'Yk\LaravelWhoisLookup\App\Http\Controllers', 'middleware' => ['web']],
            function(){
                require __DIR__.'/routes/web.php';
            }
        );
    }
}
