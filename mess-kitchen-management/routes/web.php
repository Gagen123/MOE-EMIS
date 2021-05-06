<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'mess_manage/'], function () use ($router) {
        
        $router->group(['prefix' => 'foodrelease'], function () use ($router) {
            $router->get('/loadFoodReleaseList', 'mess_manage\FoodReleaseController@loadFoodReleaseList');
            $router->post('/saveFoodRelease', 'mess_manage\FoodReleaseController@saveFoodRelease');

        });
        $router->group(['prefix' => 'stockreceived'], function () use ($router) {
            $router->get('/loadStockReceivedList', 'mess_manage\StockReceivedController@loadStockReceivedList');
            $router->post('/saveStockReceived', 'student\StockReceivedController@saveStockReceived');

        });
    });
});
    
   