<?php

return [

	'google' => [
		'maps' => [
			'public_api_key' => env('SERVICES_GOOGLE_MAPS_PUBLIC_API_KEY', 'PublicApiKey!!!'),
		],
		'recaptcha' => [
			'public_api_key' => env('SERVICES_GOOGLE_RECAPTCHA_PUBLIC_API_KEY', 'PublicApiKey!!!'),
		],
	],

];
