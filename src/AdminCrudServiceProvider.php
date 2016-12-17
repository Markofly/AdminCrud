<?php
namespace Markofly\AdminCrud;

use Illuminate\Support\ServiceProvider;

class AdminCrudServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'AdminCrud');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/admincrud.php' => config_path('markofly/admincrud.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../forms' => config_path('markofly/forms/'),
            ], 'forms');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/AdminCrud/'),
            ], 'views');

        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/admincrud.php', 'markofly.admincrud'
        );

    }
}
