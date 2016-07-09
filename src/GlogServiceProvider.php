<?php
namespace Gazatem\Glog;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;


class GlogServiceProvider extends ServiceProvider
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
            realpath(__DIR__.'/config/glog.php') => config_path('glog.php'),
        ], 'glog');

        $this->publishes([
            __DIR__.'/public' => public_path('vendor/gazatem/glog'),
        ], 'public');

        $this->setupRoutes($this->app->router);
        $this->loadViewsFrom(__DIR__ . '/views', 'glog');
        $this->bladeDirectives();
    }

    private function bladeDirectives()
    {
        \Blade::directive('logMessage', function($log_text) {
            return "<?php \\Gazatem\Glog\OutputGenerator::get_message({$log_text}); ?>";
        });
     }

    public function setupRoutes(Router $router)
    {
        $router->group(
            ['namespace' => 'Gazatem\Glog\Http\Controllers'],
            function ($router) {
                include __DIR__.'/Http/routes.php';
            }
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/config/glog.php', 'glog');
        $this->app['glog'] = $this->app->share(function($app) {
            return new Glog;
        });
    }
}
