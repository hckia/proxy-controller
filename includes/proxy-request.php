<?php

// @TODO: What is the purpose of this function? Is it necessary?
function proxy_request( $url, $headers = array(), $curl_headers = array() ) {
	// Set the Origin header to the default origin if not already set
	if ( ! isset( $headers['Origin'] ) ) {
		// @TODO: This doesn't seem to be used
		$headers['Origin'] = get_option( 'siteurl' );
	}

	// Create a new cURL handle
	$ch = curl_init( $url );

	// Set the cURL options
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $GLOBALS['curl_headers'] );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );

	// Execute the cURL request
	// @TODO: I suggest looking into streaming this to avoid memory issues
	// https://stackoverflow.com/questions/16462088/php-curl-and-stream-forwarding
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

			if ( ! defined( 'NEW_ORIGIN_CORS' ) ) {
				define( 'NEW_ORIGIN_CORS', false );
			}
			// @TODO: get_headers uses the system's http stream wrapper's default timeout
			// might want to instead rely on curl with a sensible timeout
			// https://gist.github.com/jms-pantheon/160a70c7850e3d62aa3046dfd6b27bc8
			header( 'Content-Type: ' . get_headers( $new_url, 1 )['Content-Type']);

			if ( NEW_ORIGIN_CORS ) {
				$response = proxy_request( $new_url );
				echo $response;
			} else {
				// Using readfile to avoid memory issues, streams straight to output
				readfile( $new_url );
			}
			exit;
		}
	}
} else {
	error_log( 'NEW_ORIGIN and/or PROXY_PATHS are not defined. Please read README.md, or remove this plugin', false );
}

