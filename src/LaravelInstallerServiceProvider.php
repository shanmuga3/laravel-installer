<?php

/**
 * This file is part of Laravel Installer,
 * Web Installer for Laravel Application.
 *
 * @license     MIT
 * @package     Shanmuga\LaravelInstaller
 * @category    Provider
 * @author      Shanmugarajan
 */

namespace Shanmuga\LaravelInstaller\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Shanmuga\LaravelInstaller\Middleware\canInstall;
use Shanmuga\LaravelInstaller\Middleware\canUpdate;

class LaravelInstallerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * The middlewares to be registered.
     *
     * @var array
     */
    protected $middlewares = [
        'install' => \Shanmuga\LaravelInstaller\Middleware\canInstall::class,
        'checkInstalled' => \Shanmuga\LaravelInstaller\Middleware\checkInstalled::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/installer.php' => config_path('installer.php'),
        ],'LaravelInstaller');

        $this->publishes([
            __DIR__.'/resources/assets' => public_path('installer'),
        ], 'LaravelInstaller');

        $this->publishes([
            __DIR__.'/resources/views' => base_path('resources/views/vendor/installer'),
        ], 'LaravelInstaller');


        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        // $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'LaravelInstaller');
        $this->publishes([
            __DIR__.'/resources/lang' => base_path('resources/lang'),
        ], 'LaravelInstaller');

        $this->registerMiddlewares();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/installer.php', 'installer'
        );
    }

    /**
     * Register the middlewares automatically.
     *
     * @return void
     */
    protected function registerMiddlewares()
    {
        /*if (!$this->app['config']->get('installer.middleware.register')) {
            return;
        }*/

        $router = $this->app['router'];

        if (method_exists($router, 'middleware')) {
            $registerMethod = 'middleware';
        }
        else if (method_exists($router, 'aliasMiddleware')) {
            $registerMethod = 'aliasMiddleware';
        }
        else {
            return;
        }

        foreach ($this->middlewares as $key => $class) {
            $router->$registerMethod($key, $class);
        }
    }
}
