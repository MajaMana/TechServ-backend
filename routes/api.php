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

Route::get('/seed/stations', function (Request $request){
    $string = file_get_contents("C:\Users\Marijana\Desktop\TechServ-backend\stations.json");
    $json = json_decode($string, true);
    $stations = $json['payload'];
    foreach($stations as $station){
        DB::table('station')->insert([
            'code' => $station['code'],
            'name' => $station['namen']['lang'],
            'country' => $station['land'],
            'facilities' => $station['heeftFaciliteiten'],
            'departures' => $station['heeftVertrektijden'],
            'assistance' => $station['heeftReisassistentie'],
        ]);
    }


    return response()->json('');
});

Route::get('/stations', function (Request $request){
    $results = DB::select('select * from station');
    return response()->json($results);
});

route::get('/routes', function(Request $request) {
    $offset = ((int)$_GET['page'] - 1) * 10;
    $stationId = $_GET['station_id'];
    $results = DB::select('
    SELECT *
    FROM `route`
    JOIN `stop`
    ON route.id = stop.route_id
    JOIN `station`
    ON stop.station_id = station.id
    WHERE route.station_id = ' . $stationId .
    ' LIMIT 30 OFFSET ' . $offset);

    $routes = [];
    foreach($results as $result){
        $routes[$result->route_id][] = $result;
    }
    return response()->json([
        'page' => (int)$_GET['page'],
        'routes' => array_values($routes),
    ]);
});

route::get('/route-detail', function(Request $request) {
    $routeId = $_GET['route_id'];
    $results = DB::select('
    SELECT *
    FROM `route`
    JOIN `stop`
    ON route.id = stop.route_id
    JOIN `station`
    ON stop.station_id = station.id
    WHERE route.id = ' . $routeId);
    $stations = [];
    foreach($results as $result){
        $stations[$result->station_id][] = $result;
    }
    return response()->json([
        'stations' => $stations,
    ]);
});