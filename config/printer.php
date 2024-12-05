<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Printer Configuration
    |--------------------------------------------------------------------------
    |
    */

    'middleware' => env('PRINTER_MIDDLEWARE', 'C:\Program Files\NAPS2\naps2.console.exe'),
    'device' => env('PRINTER_DEVICE', 'default-device'),
    'driver' => env('PRINTER_DRIVER', 'wia'),
];
