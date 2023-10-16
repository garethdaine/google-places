<?php

namespace GarethDaine\GooglePlaces\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use GarethDaine\GooglePlaces\GooglePlacesServiceProvider;
use GarethDaine\GooglePlaces\Facades\GooglePlacesFacade;

class TestCase extends OrchestraTestCase
{
	/**
	 * Get package providers.
	 *
	 * @param  \Illuminate\Foundation\Application $app
	 *
	 * @return array
	 */
	protected function getPackageProviders($app): array
	{
		return [
			GooglePlacesServiceProvider::class,
		];
	}

	/**
	 * Override application aliases.
	 *
	 * @param  \Illuminate\Foundation\Application $app
	 *
	 * @return array
	 */
	protected function getPackageAliases($app)
	{
	    return [
	        'GooglePlaces' => GooglePlacesFacade::class,
	    ];
	}
}