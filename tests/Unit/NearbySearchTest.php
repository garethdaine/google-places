<?php

namespace GarethDaine\GooglePlaces\Tests\Unit;

use GooglePlaces;
use GarethDaine\GooglePlaces\Tests\TestCase;

class NearbySearchTest extends TestCase {
	public function test_a_nearby_search_request_returns_an_array(): void
	{
		// Location cordinates array for Liverpool, New South Wales, Australia.
        $location = [
            'longitude' => '150.92588',
            'latitude' => '-33.91938',
        ];

        dd(env('APP_ENV'));

        // Returned places from nearby search, using location coordinates
        // radius and keyword.
		$places = GooglePlaces::nearbySearch($location, 100, 'web design');

		$this->assertIsArray($places);
	}

	public function test_a_nearby_search_request_and_returns_an_array_with_the_key_place_id()
	{
		// Location cordinates array for Liverpool, New South Wales, Australia.
        $location = [
            'longitude' => '150.92588',
            'latitude' => '-33.91938',
        ];

        // Returned places from nearby search, using location coordinates
        // radius and keyword.
		$places = GooglePlaces::nearbySearch($location, 100, 'web design');

		dd($places);

		$this->assertArrayHasKey('place_id', $places);
	}
}