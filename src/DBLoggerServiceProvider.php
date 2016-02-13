<?php
namespace Gazatem\DBLogger;

use Illuminate\Support\ServiceProvider;

class DBLoggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            realpath(__DIR__.'/migrations') => $this->app->databasePath().'/migrations',
            realpath(__DIR__.'/config/dblogger.php') => config_path('dblogger.php'),
        ], 'dblogger');

        $this->loadViewsFrom(__DIR__ . '/views', 'dblogger');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/config/dblogger.php', 'dblogger');
        $this->app['dblogger'] = $this->app->share(function($app) {
            return new DBLogger;
        });
    }
}
