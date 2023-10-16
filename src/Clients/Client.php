<?php

namespace GarethDaine\GooglePlaces\Clients;

use GarethDaine\GooglePlaces\Contracts\ClientInterface;

abstract class Client implements ClientInterface
{
    /**
     * Perform a GET request to the Google Places details endpoint and return the result.
     *
     * @param  string $placeId A Google Place ID.
     * @return array           The result array for a single place.
     */
    abstract public function details(string $placeId): array;

    /**
     * Perform a GET request to the Google Places 'nearbysearch' endpoint and return a JSON response.
     *
     * @param  array  $location The location latitude and longitude coordinates.
     * @param  string $type     The type to use for the query.
     * @param  int    $radius   The radius in meters.
     * @param  string $rankBy   The rankby parameter.
     * @return array            The results array listing all places for the specific location/radius/type.
     */
    abstract public function nearbySearch(array $location, string $type, int $radius = 0, string $rankBy = 'distance'): array;
}
