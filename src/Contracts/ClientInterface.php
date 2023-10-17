<?php

namespace GarethDaine\GooglePlaces\Contracts;

interface ClientInterface
{
    /**
     * Perform a GET request to the Google Places details endpoint and return the result.
     *
     * @param  string $placeId A Google Place ID.
     * @return array           The result array for a single place.
     */
    public function details(string $placeId): array;

    /**
     * Perform a GET request to the Google Places 'nearbysearch' endpoint and return a JSON response.
     *
     * @param  array  $location The location latitude and longitude coordinates.
     * @param  string|null $keyword  The keyword parameter.
     * @param  string|null $type     The type to use for the query.
     * @param  int    $radius   The radius in meters.
     * @param  string $rankBy   The rankby parameter.
     * @return array            The results array listing all places for the specific location/radius/type.
     */
    public function nearbySearch(array $location, string $keyword, string $type, int $radius = 0, string $rankBy = 'distance'): array;
}
