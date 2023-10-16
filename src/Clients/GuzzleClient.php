<?php

namespace GarethDaine\GooglePlaces\Clients;

use GdImage;
use GuzzleHttp\Client as Guzzle;

class GuzzleClient extends Client
{
    /**
     * Base API URL
     */
    const API_URL = 'https://maps.googleapis.com/maps/api/place/';

    /**
     * The client api key
     *
     * @var string
     */
    protected string $apiKey;

    /**
     * The HTTP client.
     *
     * @var \GuzzleHttp\Client
     */
    protected Guzzle $client;

    /**
     * Create a new client instance.
     *
     * @param  \GuzzleHttp\Client $client
     * @return void
     */
    public function __construct(string $apiKey, Guzzle $client)
    {
        $this->apiKey = $apiKey;
        $this->client = $client;
    }

    /**
     * Perform a GET request to the Google Places details endpoint and return the result.
     *
     * @param  string $placeId A Google Place ID.
     * @return array           The result array for a single place.
     */
    public function details(string $placeId): array
    {
        // Add the place ID to the query string parameters.
        $options = [
            'query' => [
                'place_id' => $placeId,
            ]
        ];

        // Make the request and return the result array.
        return $this->request('GET', 'details', 'json', $options)['result'];
    }

    /**
     * Perform a GET request to the Google Places 'nearbysearch' endpoint and return a JSON response.
     *
     * @param  array  $location The location latitude and longitude coordinates.
     * @param  string $type     The type to use for the query.
     * @param  int    $radius   The radius in meters.
     * @param  string $rankBy   The rankby parameter.
     * @return array            The results array listing all places for the specific location/radius/type.
     */
    public function nearbySearch(array $location, string $type, int $radius = 0, string $rankBy = 'distance'): array
    {
        // Add the location coordinates, radius, and type to the query string parameters.
        $options = [
            'query' => [
                'location' => strval($location['latitude']).','.strval($location['longitude']),
                'type' => $type,
                'rankby' => $rankBy,
            ]
        ];

        if ($radius > 0 && $rankBy !== 'distance') {
            $options['query']['radius'] = $radius;
        }

        // Make the request and return the results array.
        return $this->request('GET', 'nearbysearch', 'json', $options);
    }

    /**
     * Get the next page of results.
     *
     * @param string $nextPageToken
     * @return array
     */
    public function nextPage(string $nextPageToken): array
    {
        // Add the next page token to the query string parameters.
        $options = [
            'query' => [
                'pagetoken' => $nextPageToken,
            ]
        ];

        // Make the request and return the results array.
        return $this->request('GET', 'nearbysearch', 'json', $options);
    }

    /**
     * Perform a GET request to the Google Places 'photo' endpoint and return a GD image resource.
     *
     * @param  string $photoReference The photo reference string.
     * @param  int    $maxWidth       The maximum width of the image.
     * @param  int    $maxHeight      The maximum height of the image.
     * @return \GdImage              The GD image resource.
     */
    public function getPhoto(string $photoReference, int $maxWidth = 400, int $maxHeight = 400): GdImage
    {
        // Add the photo reference, max width, and max height to the query string parameters.
        $options = [
            'query' => [
                'photoreference' => $photoReference,
                'maxwidth' => $maxWidth,
                'maxheight' => $maxHeight,
            ]
        ];

        // Make the request and return the results array.
        return imagecreatefromstring($this->request('GET', 'photo', null, $options)['result']);
    }

    /**
     * Make a HTTP request.
     *
     * @param  string $type     The HTTP method string.
     * @param  string $endpoint The endpoint to use.
     * @param  string|null $output   The response ouput, JSON or array.
     * @param  array  $options  The request options array.
     * @return array            The return response array.
     */
    private function request(string $type, string $endpoint, ?string $output, array $options = []): array
    {
        // Set the API key and add to the query string.
        $options['query']['key'] = $this->apiKey;

        // Perform a Guzzle request.
        if ($output === null) {
            $response = $this->client->request($type, self::API_URL.$endpoint, $options);

            return [
                'result' => $response->getBody()->getContents(),
            ];
        } else {
            $response = $this->client->request($type, self::API_URL.$endpoint.DIRECTORY_SEPARATOR.$output, $options);
        }

        // Decode the JSON response and return an array.
        return json_decode($response->getBody()->getContents(), true);
    }
}
