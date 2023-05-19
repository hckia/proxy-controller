<?php
// Always included to to ensure requests come from here
header( 'Access-Control-Allow-Origin: ' . get_option('siteurl') );

// Set caching headers
header( 'Cache-Control: max-age=3600, public' );
header( 'Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT' );

$curl_headers = [];

// custom headers defined in wp-config.php
if ( defined( 'CUSTOM_HEADERS' ) && is_array( CUSTOM_HEADERS ) ) {
	$headers = array_merge( CUSTOM_HEADERS, $headers );
	foreach ( $headers as $key => $value ) {
		$curl_headers[] = "$key: $value";
	}
}

// Export curl_headers for other scripts
$GLOBALS['curl_headers'] = $curl_headers;
