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
    $router->group(['prefix' => 'masters'], function () use ($router) {
        $router->post('/saveSpmMasters', ['uses' => 'masters\SpmsMasterController@saveSpmMasters']);
        $router->get('/loadSpmMasters/{param}', ['uses' => 'masters\SpmsMasterController@loadSpmMasters']);
        $router->post('/saveDzoEMO', ['uses' => 'masters\SpmsMasterController@saveDzoEMO']);
        $router->get('/getDzoEMO', ['uses' => 'masters\SpmsMasterController@getDzoEMO']);
        $router->post('/saveSchoolDEO', ['uses' => 'masters\SpmsMasterController@saveSchoolDEO']);
        $router->get('/getSchoolDEO', ['uses' => 'masters\SpmsMasterController@getSchoolDEO']);
    });
    $router->group(['prefix' => 'spms'], function () use ($router) {
        $router->get('/schoolPerformaceDashboard', ['uses' => 'spms\SpmsController@schoolPerformaceDashboard']);
        $router->get('/getSchoolPerformaceList/{year}/{dzon_id}/{status}', ['uses' => 'spms\SpmsController@getSchoolPerformaceList']);
        $router->get('/getEvaluation/{org_id}/{year}', ['uses' => 'spms\SpmsController@getEvaluation']);
        $router->post('/saveEvaluation', ['uses' => 'spms\SpmsController@saveEvaluation']);
        $router->get('/getSchoolDashboardData/{org_id}', ['uses' => 'spms\SpmsController@getSchoolDashboardData']);
        $router->post('/saveSchoolPlan', ['uses' => 'spms\SpmsController@saveSchoolPlan']);
        $router->get('/getSchoolPlan/{school_id}', ['uses' => 'spms\SpmsController@getSchoolPlan']);
        $router->post('/saveImplementtationStatus', ['uses' => 'spms\SpmsController@saveImplementtationStatus']);
        $router->get('/getSchoolPlanDetails/{spm_school_plan_id}', ['uses' => 'spms\SpmsController@getSchoolPlanDetails']);
        $router->get('/getSchoolPlanHistory/{spm_school_plan_id}', ['uses' => 'spms\SpmsController@getSchoolPlanHistory']);
        $router->get('/getDzoEMO/{emo_id}', ['uses' => 'spms\SpmsController@getDzoEMO']);
        $router->get('/getSchoolPlans', ['uses' => 'spms\SpmsController@getSchoolPlans']);
        $router->post('/saveAgencyInputForm', ['uses' => 'spms\SpmsController@saveAgencyInputForm']);
        $router->get('/getAgencyInputForm/{orgId}', ['uses' => 'spms\SpmsController@getAgencyInputForm']);
        $router->get('/getAgencyInputFormDetail/{agencyInputFormId}/{orgId}', ['uses' => 'spms\SpmsController@getAgencyInputFormDetail']);
        $router->post('/saveObservationAgencyInputForm', ['uses' => 'spms\SpmsController@saveObservationAgencyInputForm']);
        $router->post('/saveActionAgencyInputForm', ['uses' => 'spms\SpmsController@saveActionAgencyInputForm']);
        $router->post('/saveAcknowlegeAgencyInputForm', ['uses' => 'spms\SpmsController@saveAcknowlegeAgencyInputForm']);
    });
});
