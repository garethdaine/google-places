<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Google Places Driver
    |--------------------------------------------------------------------------
    |
    | This is the preferred Google Places HTTP client you'd like to use. The default is
    | Guzzle.
    |
    */
	
	'driver' => env('GOOGLE_PLACES_DRIVER', 'guzzle'),

    /*
    |--------------------------------------------------------------------------
    | Google Places Authentication Details
    |--------------------------------------------------------------------------
    |
    | Your Google Places credentials.
    |
    */
    'api_key' => env('GOOGLE_PLACES_API_KEY'),
];