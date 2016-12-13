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
            ], 'AdminCrud');

            $this->publishes([
                __DIR__.'/../forms' => config_path('markofly/forms/'),
            ], 'AdminCrud');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/AdminCrud/'),
            ], 'AdminCrud');

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
