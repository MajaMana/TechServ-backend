<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/stations', function (Request $request){
    $results = DB::select('select * from station');
    return response()->json($results);
});

route::get('/routes', function(Request $request) {
    $results = DB::select('select * from route as r join station as s on s.id = r.station_id');
    return response()->json($results);
});