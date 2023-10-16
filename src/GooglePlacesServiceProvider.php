<?php

namespace GarethDaine\GooglePlaces;

use Illuminate\Support\ServiceProvider;

class GooglePlacesServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(GooglePlacesManager::class, function ($app) {
            return new GooglePlacesManager($app);
        });

        if ($this->app->runningInConsole()) {
            // Publish the package config.
            $this->publishes([
                __DIR__.'/../config/google-places.php' => $this->app['path.config'].DIRECTORY_SEPARATOR.'google-places.php',
            ]);
        }
    }
}
