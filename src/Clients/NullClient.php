<?php

namespace GarethDaine\GooglePlaces\Clients;

class NullClient extends Client
{
    /**
     * Perform a GET request to the Google Places details endpoint and return the result.
     * 
     * @param  string $placeId A Google Place ID.
     * @return array           The result array for a single place.
     */
    public function details(string $placeId): array
    {
        return [];
    }

    /**
     * Perform a GET request to the Google Places 'nearbysearch' endpoint and return a JSON response.
     * 
     * @param  array  $location The location latitude and longitude coordinates.
     * @param  int    $radius   The radius in meters.
     * @param  string $keyword  The keyword to use for the query.
     * @return array            The results array listing all places for the specific location/radius/keyword.
     */
    public function nearbySearch(array $location, int $radius, string $keyword): array
    {
        return [];
    }
}
