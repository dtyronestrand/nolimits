<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'resources/js/*', '@vite/*'],

    'allowed_methods' => ['*'],

    // Add your frontend origin. Adjust http://nlmaf.dvl.to if your frontend uses https or a specific port.
    'allowed_origins' => ['http://127.0.0.1:8000', 'http://nlmaf.dvl.to', 'https://devs-mac-mini-1.tail6ebed.ts.net', 'http://127.0.0.1:5173'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],
    'exposed_headers' => ['*'],

    'max_age' => 0,

    'supports_credentials' => true,

];
