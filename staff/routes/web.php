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
        $router->get('/load_staff_masters_by_id/{param}/{id}','masters\StaffMastersController@load_staff_masters_by_id');
        
    });
    $router->group(['prefix' => 'staff'], function () use ($router) {
        $router->post('/savePersonalDetails', ['uses' => 'staff\StaffController@savePersonalDetails']);
        $router->get('/loaddraftpersonalDetails/{user_id}', ['uses' => 'staff\StaffController@loaddraftpersonalDetails']);

        $router->post('/savequalificationDetails', ['uses' => 'staff\StaffController@savequalificationDetails']);
        $router->get('/load_qualification/{staff_id}/{user_id}', ['uses' => 'staff\StaffController@load_qualification']);
        $router->post('/savenominationDetails', ['uses' => 'staff\StaffController@savenominationDetails']);
        $router->get('/load_nominations/{staff_id}/{user_id}', ['uses' => 'staff\StaffController@load_nominations']);
        $router->post('/updatefinalstaffDetails', ['uses' => 'staff\StaffController@updatefinalstaffDetails']);
        $router->get('/loadAllStaff/{type}', ['uses' => 'staff\StaffController@loadAllStaff']);
        
    });
});