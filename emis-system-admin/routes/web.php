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
        $router->post('/saveGlobalMasters', ['uses' => 'AdministrationController@saveGlobalMasters']);
        $router->get('/loadGlobalMasters/{param}','AdministrationController@loadGlobalMasters');
        $router->get('/load_dropdown/{model}/{parent_id}','AdministrationController@load_dropdown');
        $router->get('/load_gewog_dzongkhag_id/{dzoId}','AdministrationController@load_gewog_dzongkhag_id');
        $router->get('/load_dzo_geo_village_by_village_id/{model}/{parent_id}','AdministrationController@load_dropdown');
        $router->get('/load_gewog_details_by_village_id/{id}','AdministrationController@load_gewog_details_by_village_id');
        $router->get('/load_dzongkhag_details_by_id/{id}','AdministrationController@load_dzongkhag_details_by_id');
        $router->get('/load_gewog_details_by_id/{id}','AdministrationController@load_gewog_details_by_id');
        $router->get('/load_country_details_by_id/{id}','AdministrationController@load_country_details_by_id');
        $router->get('/load_Gender_details_by_id/{id}','AdministrationController@load_Gender_details_by_id');
        $router->get('/load_village_details_by_village_id/{id}','AdministrationController@load_village_details_by_village_id');
        $router->get('/load_gewog_details_by_id/{id}','AdministrationController@load_gewog_details_by_id');
        $router->get('/loadDzoGeoVilByVilId/{id}','AdministrationController@loadDzoGeoVilByVilId');
        $router->get('/load_village_details_by_gewog_id/{gewog_id}','AdministrationController@load_village_details_by_gewog_id');
    });

    $router->group(['prefix' => 'workflow'], function () use ($router){
        $router->post('/insertWorkflow', ['uses' => 'WorkflowController@insertWorkflow']);
        $router->post('/updateTaskDetails', ['uses' => 'WorkflowController@updateTaskDetails']);
        $router->post('/insertNotification', ['uses' => 'WorkflowController@insertNotification']);
        $router->post('/visitedNotification', ['uses' => 'WorkflowController@visitedNotification']);
        $router->post('/updateNextNotification', ['uses' => 'WorkflowController@updateNextNotification']);
    });
    $router->group(['prefix' => 'common'], function () use ($router){
        $router->get('/getApplicationDetials/{applicationId}', ['uses' => 'CommonController@getApplicationDetials']);
        $router->get('/getTaskDetials/{applicationId}', ['uses' => 'CommonController@getTaskDetials']);
        $router->post('/getTaskList', ['uses' => 'CommonController@getTaskList']);
        $router->get('/releaseApplication/{application_number}', ['uses' => 'CommonController@releaseApplication']);
        $router->get('/getDzoNameById/{id}', ['uses' => 'CommonController@getDzoNameById']);
        $router->get('/getGewogNameById/{id}', ['uses' => 'CommonController@getGewogNameById']);
        $router->get('/checkPendingApplication/{type}/{user_id}', ['uses' => 'CommonController@checkPendingApplication']);
        $router->post('/getNotification/{role_ids}/{user_id}', ['uses' => 'CommonController@getNotification']);
        $router->get('/getNotificationDetials/{id}', ['uses' => 'CommonController@getNotificationDetials']);
    });

    $router->group(['prefix' => 'questionAnswerController'], function () use ($router){
        $router->post('/saveQuestionaries', ['uses' => 'QuestionAnswerController@saveQuestionaries']);
        $router->get('/loadQuestionaries/{type}', ['uses' => 'QuestionAnswerController@loadQuestionaries']);
        $router->post('/saveAnswers', ['uses' => 'QuestionAnswerController@saveAnswers']);
        $router->delete('/deleteAns/{id}/{user_id}', ['uses' => 'QuestionAnswerController@deleteAns']);
    });
});

