<?php
// Always included to to ensure requests come from here
header('Access-Control-Allow-Origin: ' . get_option('siteurl'));

// Set caching headers
header('Cache-Control: max-age=3600, public');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');