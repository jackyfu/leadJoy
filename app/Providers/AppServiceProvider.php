<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->register(\L5Swagger\L5swaggerServiceProvider::class);//or config/app.php in providers section add  \L5Swagger\L5SwaggerServiceProvider::class

    }
}
