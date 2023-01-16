<?php

/**
 * This configuration file helps the application determine
 * how it should be storing files.
 *
 * There are currently two main options, using the standard
 * laravel filesystem, or using the database to store content.
 *
 * Default: database
 * Options: database, laravel
 */

return [
    'storage' => env('STORAGE_METHOD', 'database'),
];
