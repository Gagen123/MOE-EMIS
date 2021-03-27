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
use App\Http\Controllers\Administration;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->group(['prefix' => 'masters'], function () use ($router) {
        $router->post('/save_global_masters', ['uses' => 'AdministrationController@save_global_masters']);
        $router->get('/load_global_masters/{param}','AdministrationController@load_global_masters');
        $router->get('/load_dropdown/{model}/{parent_id}','AdministrationController@load_dropdown');

        $router->get('/load_gewog_details_by_village_id/{id}','AdministrationController@load_gewog_details_by_village_id');
        $router->get('/load_dzongkhag_details_by_id/{id}','AdministrationController@load_dzongkhag_details_by_id');
        $router->get('/load_country_details_by_id/{id}','AdministrationController@load_country_details_by_id');
        $router->get('/load_Gender_details_by_id/{id}','AdministrationController@load_Gender_details_by_id');
        
        
    });
});

