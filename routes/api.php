<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/stations', function (Request $request) {
    return response()->json([
        'code' => 'AMS',
        'name' => 'Amsterdam Centraal',
        'country' => 'NL',
        'facilities' => true,
        'departures' => true,
        'assistance' => true,
]);
});

route::get('/routes', function(Request $request) {
    return response()->json([
        'page' => 1,
        'routes' => [
            [
                    'station' => 'Amsterdam Centraal',
                    'arrival' => 'null',
                    'departure' => null,
            ]
        ]
    ]);
});