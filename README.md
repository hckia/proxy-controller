# proxy-controller
For offloading requests from archived directories via php 

The intention of this plugin is to provide Pantheon users a method of offloading directories and files via PHP. I've designed it so that you can modify / add CORS, to control where requests are coming through. Alternatively, you can set none, and let the client cache the request.
## Installation 
Recommended method is to install this under mu-plugins.

### CONSTANT required (defined in wp-config.php)
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

## CONSTANTS available

`CUSTOM_HEADERS` - You can define custom headers within `wp-config.php` like so...

```php
// examples
define('CUSTOM_HEADERS', [ 
    'Content-Type: application/json',
    'Authorization: Bearer your_token'
    // ... more headers here
]);
```

`NEW_ORIGIN_CORS` - constant accepts true or false if set to to true, it will assume CORS have been configured at the new origin.
