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
            __DIR__.'/path/to/config/file.php' => config_path('markofly/config.php'),
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
        //
    }
}