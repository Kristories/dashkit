<?php

namespace Kristories\Dashkit;

use Illuminate\Support\Facades\Route;
use Kristories\Dashkit\Console\InstallCommand;
use Kristories\Dashkit\Console\MakeTileCommand;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->configure();
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
        }
    }
}
