<?php

namespace Kristories\Dashkit;

use Illuminate\Support\Facades\Route;
use Kristories\Dashkit\Console\InstallCommand;
use Kristories\Dashkit\Console\MakeTileCommand;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
    }

    /**
     * Register the Dashkit routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group([
            'prefix' => config('dashkit.path'),
            'middleware' => config('dashkit.middleware', 'web'),
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->configure();
        $this->offerPublishing();
        $this->registerCommands();
    }

    /**
     * Setup the configuration for Dashkit.
     *
     * @return void
     */
    protected function configure()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/dashkit.php', 'dashkit'
        );
    }

    /**
     * Setup the resource publishing groups for Dashkit.
     *
     * @return void
     */
    protected function offerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/dashkit.php' => config_path('dashkit.php'),
            ], 'dashkit-config');

            $this->publishes([
                __DIR__ . '/../resources/views/dashkit.blade.php' => resource_path('views/' . config('dashkit.view') . '.blade.php'),
            ], 'dashkit-view');
        }
    }

    /**
     * Register the Dashkit Artisan commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                MakeTileCommand::class,
            ]);
        }
    }
}
