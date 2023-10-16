<?php

namespace GarethDaine\GooglePlaces\Tests\Unit;

use GooglePlaces;
use GarethDaine\GooglePlaces\Tests\TestCase;

class DetailsTest extends TestCase {
	public function test_it_makes_a_request_to_the_details_endpoint_and_returns_an_array(): void
	{
		// Place ID for Vibrant Web Solutions.
        $placeId = 'ChIJ40EOxriVEmsRLGo3t3oNEEM';

        // Return the details for a specific Google Place ID.
		$details = GooglePlaces::details($placeId);

		$this->assertIsArray($details);
	}
}