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
        $router->post('/saveDzoEMO', ['uses' => 'masters\SpmsMasterController@saveDzoEMO']);
        $router->get('/getDzoEMO', ['uses' => 'masters\SpmsMasterController@getDzoEMO']);
        $router->post('/saveSchoolDEO', ['uses' => 'masters\SpmsMasterController@saveSchoolDEO']);
        $router->get('/getSchoolDEO', ['uses' => 'masters\SpmsMasterController@getSchoolDEO']);


    });
    // Transaction Route
    $router->group(['prefix' => 'spms'], function () use ($router) {
        $router->get('/getDeoDashboardData/{dzon_id}/{staff_id}', ['uses' => 'spms\SpmsController@getDeoDashboardData']);
        $router->get('/getSchoolDoeDetails/{dzon_id}/{staff_id}/{spm_domain_subcat_id}[/{status}]', ['uses' => 'spms\SpmsController@getSchoolDoeDetails']);
        $router->get('/getEvaluation/{org_id}/{spm_domain_subcat_id}', ['uses' => 'spms\SpmsController@getEvaluation']);
        $router->post('/saveEvaluation', ['uses' => 'spms\SpmsController@saveEvaluation']);
        $router->get('/getSchoolDashboardData/{org_id}', ['uses' => 'spms\SpmsController@getSchoolDashboardData']);

    });
});
