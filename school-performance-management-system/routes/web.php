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
$router->group(['prefix' => 'api/v1'], function () use ($router) {

    //Masters routes
    $router->group(['prefix' => 'masters'], function () use ($router) {
        $router->post('/saveSpmMasters', ['uses' => 'masters\SpmsMasterController@saveSpmMasters']);
        $router->get('/loadSpmMasters/{param}', ['uses' => 'masters\SpmsMasterController@loadSpmMasters']);
    });

    //Transaction Route
    // $router->group(['prefix' => 'spms'], function () use ($router) {

    // });
});
