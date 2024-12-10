<?php

return [
    'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
    'store' => env('APP_MAINTENANCE_STORE', null),
    'paths' => [],
    'secret' => env('APP_MAINTENANCE_SECRET'),
    'allowed' => [],
];
