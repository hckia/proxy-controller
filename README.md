# proxy-controller
For offloading requests from archived directories via PHP.

The intention of this plugin is to provide Pantheon users a method of offloading directories and files via PHP. I've designed it so that you can modify / add CORS, to control where requests are coming through. Alternatively, you can set none, and let the client cache the request.

## Installation
Recommended method is to install this under mu-plugins.

### CONSTANT required (defined in wp-config.php)

If either is not defined a message will be logged to the PHP error logs

`PROXY_PATHS` - The directories or files you wish to proxy. Any requests that begin with this directory will be served from the NEW_ORIGIN defined URL.

`NEW_ORIGIN` - The new origin for the proxied paths.

```php
// example...
define( 'PROXY_PATHS', array(
    '/path/to/exception1/',
    '/path/to/exception2/',
    '/path/to/exception3/'
) );
define ( 'NEW_ORIGIN', 'https://example-cdn.com/bucket' );
```

## CONSTANTS available

`CUSTOM_HEADERS` - You can define custom headers within `wp-config.php` like so...

```php
// examples
define( 'CUSTOM_HEADERS', [
    'Content-Type: application/json',
    'Authorization: Bearer your_token'
    // ... more headers here
] );
```

`NEW_ORIGIN_CORS` - Boolean, if set to to `true` it will assume CORS have been configured at the new origin.
