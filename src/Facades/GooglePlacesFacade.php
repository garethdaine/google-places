<?php

namespace GarethDaine\GooglePlaces\Facades;

use Illuminate\Support\Facades\Facade;
use GarethDaine\GooglePlaces\GooglePlacesManager;

/**
 * @method static \GarethDaine\GooglePlaces\Contracts\ClientInterface driver(string $driver = null)
 * @see \GarethDaine\GooglePlaces\GooglePlacesManager
 */
class GooglePlacesFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return GooglePlacesManager::class;
    }
}
