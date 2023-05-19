<?php


function proxy_request( $url, $headers = array(), $curl_headers = array() ) {
	// Set the Origin header to the default origin if not already set
	if ( ! isset( $headers['Origin'] ) ) {
		$headers['Origin'] = get_option( 'siteurl' );
	}

	// Create a new cURL handle
	$ch = curl_init( $url );

	// Set the cURL options
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $GLOBALS['curl_headers'] );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );

	// Execute the cURL request
	$response = curl_exec( $ch );

	// Close the cURL handle
	curl_close( $ch );

	// Return the response
	return $response;
}

// Check if the requested asset matches any of the exceptions
if ( defined('NEW_ORIGIN') && defined('PROXY_PATHS') ) {
	foreach (PROXY_PATHS as $path_to_proxy) {
		if ( strpos( $_SERVER['REQUEST_URI'], $path_to_proxy ) !== false ) {
			$new_url = NEW_ORIGIN . $_SERVER['REQUEST_URI'];

			if ( ! defined('NEW_ORIGIN_CORS') ) {
				define('NEW_ORIGIN_CORS', false);
			}

			if ( NEW_ORIGIN_CORS ) {
				$response = proxy_request( $new_url );
			} else {
				$response = file_get_contents( $new_url );
			}
			header( 'Content-Type: ' . get_headers( $new_url, 1 )['Content-Type']);
			echo $response;
			exit;
		}
	}
} else {
	error_log( 'NEW_ORIGIN and/or PROXY_PATHS are not defined. Please read README.md, or remove this plugin', false );
}

