<?php

namespace GarethDaine\GooglePlaces;

use Exception;
use Illuminate\Support\Manager;
use GuzzleHttp\Client as Guzzle;
use GarethDaine\GooglePlaces\Clients\NullClient;
use GarethDaine\GooglePlaces\Clients\GuzzleClient;

class GooglePlacesManager extends Manager
{
    /**
     * Get a driver instance.
     *
     * @param  string|null                                    $name The driver name.
     * @return GarethDaine\GooglePlaces\Clients\GuzzleClient|
     *         GarethDaine\GooglePlaces\Clients\NullClient|
     *         string
     */
    public function with($name = null): GuzzleClient|NullClient|string
    {
        return $this->driver($name);
    }

    /**
     * Create a GuzzleClient instance.
     *
     * @return \GarethDaine\GooglePlaces\Clients\GuzzleClient
     */
    public function createGuzzleDriver(): GuzzleClient
    {
        $this->ensureGuzzleIsInstalled();

        $apiKey = config('google-places.api_key');

        return new GuzzleClient($apiKey, new Guzzle);
    }

    /**
     * Ensure Guzzle is installed.
     *
     * @return void
     *
     * @throws \Exception
     */
    protected function ensureGuzzleIsInstalled(): void
    {
        if (class_exists(Guzzle::class)) {
            return;
        }

        throw new Exception('Please install Guzzle: guzzlehttp/guzzle.');
    }

    /**
     * Create a NullClient instance.
     *
     * @return \GarethDaine\GooglePlaces\Clients\NullClient
     */
    public function createNullDriver(): NullClient
    {
        return new NullClient;
    }

    /**
     * Get the default GooglePlaces driver name.
     *
     * @return string
     */
    public function getDefaultDriver(): string
    {
        // Check if the driver set in the config is null, or not.
        if (is_null($this->container['config']['google-places.driver'])) {
            return 'null';
        }

        // Return the set driver.
        return $this->container['config']['google-places.driver'];
    }
}
