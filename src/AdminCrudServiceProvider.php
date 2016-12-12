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
        $this->publishes([
            __DIR__.'/config/admincrud.php' => config_path('markofly/admincrud.php'),
        ]);

        $this->publishes([
            __DIR__.'/forms' => config_path('markofly/forms/'),
        ]);

        $this->loadViewsFrom(__DIR__.'/views', 'AdminCrud');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/admincrud.php', 'markofly.admincrud'
        );

    }
}