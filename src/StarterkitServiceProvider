<?php

namespace Novagraphix\Starterkit;

use Laravel\Ui\UiCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Novagraphix\Starterkit\StarterkitPreset;

class StarterkitServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        UiCommand::macro('starterkit', function ($command) {
            StarterkitPreset::install();
            $command->info('Novagraphix starter kit installed successfully.');
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('starterkit', function () {
            return new Starterkit;
        });
    }
}
