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
$router->group(['prefix' => 'staff_api/v1'], function () use ($router) {
    $router->group(['prefix' => 'masters'], function () use ($router) {
        $router->post('/save_sfatt_masters', ['uses' => 'masters\StaffMastersController@save_sfatt_masters']);
        $router->get('/load_staff_masters/{param}','masters\StaffMastersController@load_staff_masters');
    });
    $router->group(['prefix' => 'staff'], function () use ($router) {
        $router->post('/savePersonalDetails', ['uses' => 'staff\StaffController@savePersonalDetails']);
    });
});