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
        $router->post('/saveStaffMasters', ['uses' => 'masters\StaffMastersController@saveStaffMasters']);
        $router->get('/loadStaffMasters/{param}','masters\StaffMastersController@loadStaffMasters');
        $router->get('/load_staff_masters_by_id/{param}/{id}','masters\StaffMastersController@load_staff_masters_by_id');
        
        $router->post('/saveHrDevelopmentMasters', ['uses' => 'masters\HrDevelopmentMastersController@saveHrDevelopmentMasters']);
        $router->get('/loadHrDevelopmentMastersData/{type}','masters\HrDevelopmentMastersController@loadHrDevelopmentMastersData');
        $router->get('/loadHrDevelopmentDepedentMastersData/{model}/{parent_id}','masters\HrDevelopmentMastersController@loadHrDevelopmentDepedentMastersData');
    });
    $router->group(['prefix' => 'staff'], function () use ($router) {
        $router->post('/savePersonalDetails', ['uses' => 'staff\StaffController@savePersonalDetails']);
        $router->get('/loaddraftpersonalDetails/{type}/{user_id}', ['uses' => 'staff\StaffController@loaddraftpersonalDetails']);
        $router->get('/loadpersonalDetails/{status}/{id}', ['uses' => 'staff\StaffController@loadpersonalDetails']);
        
        $router->post('/savequalificationDetails', ['uses' => 'staff\StaffController@savequalificationDetails']);
        $router->get('/loadQualification/{staff_id}/{user_id}', ['uses' => 'staff\StaffController@loadQualification']);
        $router->get('/loadStaffQualification/{staff_id}', ['uses' => 'staff\StaffController@loadStaffQualification']);
        
        $router->post('/savenominationDetails', ['uses' => 'staff\StaffController@savenominationDetails']);
        $router->get('/loadNominations/{staff_id}/{user_id}', ['uses' => 'staff\StaffController@loadNominations']);
        $router->get('/loadStaffNomination/{staff_id}', ['uses' => 'staff\StaffController@loadStaffNomination']);
        
        
        $router->post('/updatefinalstaffDetails', ['uses' => 'staff\StaffController@updatefinalstaffDetails']);
        $router->post('/updatefinalPrivatestaffDetails', ['uses' => 'staff\StaffController@updatefinalPrivatestaffDetails']);
        
        $router->get('/loadAllStaff/{type}', ['uses' => 'staff\StaffController@loadAllStaff']);
        $router->get('/loadStaff', ['uses' => 'staff\StaffController@loadStaff']);
        
        $router->get('/getEmisUsers/{empId}', ['uses' => 'staff\StaffController@getEmisUsers']);

        $router->post('/saveTransferWindow', ['uses' => 'staff\StaffController@saveTransferWindow']);
        $router->get('/loadTransferWindow', ['uses' => 'staff\StaffController@loadTransferWindow']);

        $router->post('/saveprogramDetails', ['uses' => 'staff\HrDevelopmentController@saveprogramDetails']);
        $router->get('/loadDraftDetails/{user_id}', ['uses' => 'staff\HrDevelopmentController@loadDraftDetails']);
        $router->get('/loadDocuments/{id}', ['uses' => 'staff\HrDevelopmentController@loadDocuments']);
        $router->delete('/deleteFile/{id}', ['uses' => 'staff\HrDevelopmentController@deleteFile']);
        $router->post('/saveprogramFinalDetails', ['uses' => 'staff\HrDevelopmentController@saveprogramFinalDetails']);
        
    });
});