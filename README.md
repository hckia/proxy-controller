# proxy-controller
for offloading requests from archived directories via php 

The intention of this script is to provide Pantheon users a method of offloading directories and files via PHP. I've designed it so that you can modify / add CORS, to control where requests are coming through. Alternatively, you can set none, and let the client cache the request.

## CONSTANT required (defined in wp-config.php)
`NEW_ORIGIN` - the new origin for the proxied paths. if this is not defined a message will be logged to error logs
`PROXY_PATHS` - the directories or files you wish to proxy.  if this is not defined a message will be logged to error logs

```php
// example...
define('PROXY_PATHS', array(
    '/path/to/exception1/',
    '/path/to/exception2/',
    '/path/to/exception3/'
));
```
### recommended, but not required
You can define custom headers within `wp-config.php` like so...

```php
define('API_HEADERS', [
    'Content-Type: application/json',
    'Authorization: Bearer your_token'
    // ... more headers here
]);
```

## CONSTANTS available for configuration (defined in wp-config.php)

`NEW_ORIGIN_CORS` - constant accepts true or false if set to to true, it will assume CORS have been configured at the new origin.
## methods for implementing this

### not recommended: wp-config.php
You could paste all components into wp-config.php, but I'd suggest one of two methods. Make it essential, or keep it clean.

### make it essential
Recommended method is to install this under mu-plugins as is.

### Keeping it clean

#### Step 1: update wp-config 
After the following line within wp-config.php...

```php
if (file_exists( __DIR__ . '/wp-config-pantheon.php') && isset($_ENV['PANTHEON_ENVIRONMENT'])) {
	require_once( __DIR__ . '/wp-config-pantheon.php');
```

add the following...

```php
/** 
 * Include Proxy Dir Requests file
 */
require_once(__DIR__ . '/includes/custom-headers.php');
require_once(__DIR__ . '/includes/proxy-paths.php');
require_once(__DIR__ . '/includes/proxy-requests.php');
```

#### Step 2 create includes directory and add files

1. within the same directory as wp-config, create an includes directory
2. copy the `custom-headers.php` `proxy-paths.php` and `proxy-request.php`


git commit -m "modified proxy-requests.php to properly utilize constants, and to allow for custom headers to be passed to an array"