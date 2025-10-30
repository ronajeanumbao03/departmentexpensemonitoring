<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Vite Configuration
    |--------------------------------------------------------------------------
    |
    | This file configures how Laravel interacts with your Vite build.
    | By default, it expects your compiled assets and manifest.json to
    | be located in the "public/build" directory.
    |
    | If your hosting root is already "public_html", set build_path to "build/"
    | instead of "public/build".
    |
    */

    'manifest_path' => public_path('build/manifest.json'),

    'build_path' => 'build/',

    'hot_file' => public_path('hot'),

    'check_manifest' => true,

];
