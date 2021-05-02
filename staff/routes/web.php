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
        $router->get('/loadStaff/{type}/{param}', ['uses' => 'staff\StaffController@loadStaff']);
        
        $router->get('/getEmisUsers/{empId}', ['uses' => 'staff\StaffController@getEmisUsers']);

        $router->post('/saveTransferWindow', ['uses' => 'staff\StaffController@saveTransferWindow']);
        $router->get('/loadTransferWindow', ['uses' => 'staff\StaffController@loadTransferWindow']);
        $router->get('/load_staff_details_by_id/{id}', ['uses' => 'staff\StaffController@load_staff_details_by_id']);
        
        $router->group(['prefix' => 'hrdevelopment'], function () use ($router) {
            $router->post('/saveprogramDetails', ['uses' => 'staff\HrDevelopmentController@saveprogramDetails']);
            $router->get('/loadDraftDetails/{user_id}', ['uses' => 'staff\HrDevelopmentController@loadDraftDetails']);
            $router->get('/loadDocuments/{id}', ['uses' => 'staff\HrDevelopmentController@loadDocuments']);
            $router->delete('/deleteFile/{id}', ['uses' => 'staff\HrDevelopmentController@deleteFile']);
            $router->post('/saveprogramFinalDetails', ['uses' => 'staff\HrDevelopmentController@saveprogramFinalDetails']);
            $router->get('/loadprogramDetails/{param}', ['uses' => 'staff\HrDevelopmentController@loadprogramDetails']);
            $router->get('/loadDetails/{id}', ['uses' => 'staff\HrDevelopmentController@loadDetails']);
            $router->get('/loadProgramDetailsForNomination/{param}', ['uses' => 'staff\HrDevelopmentController@loadProgramDetailsForNomination']);
            $router->post('/saveParticipant', ['uses' => 'staff\HrDevelopmentController@saveParticipant']);
            $router->get('/getParticipantDetails/{param}', ['uses' => 'staff\HrDevelopmentController@getParticipantDetails']);
            $router->get('/getParticipantDetailsById/{id}', ['uses' => 'staff\HrDevelopmentController@getParticipantDetailsById']);
            $router->get('/deleteParticipant/{id}', ['uses' => 'staff\HrDevelopmentController@deleteParticipant']);
            $router->post('/submitParticipants', ['uses' => 'staff\HrDevelopmentController@submitParticipants']);
            $router->post('/updateapplication', ['uses' => 'staff\HrDevelopmentController@updateapplication']);
            $router->post('/updateParticipant', ['uses' => 'staff\HrDevelopmentController@updateParticipant']);
        });  
        $router->group(['prefix' => 'transfer'], function () use ($router) {
            $router->get('/getcurrentTransferWindowDetails/{id}', ['uses' => 'staff\TransferController@getcurrentTransferWindowDetails']); 
            $router->post('/submitapplicantDetails', ['uses' => 'staff\TransferController@submitapplicantDetails']);
            $router->get('/getDraftDetails/{user_id}', ['uses' => 'staff\TransferController@getDraftDetails']); 
            $router->post('/submitFinalapplicantDetails', ['uses' => 'staff\TransferController@submitFinalapplicantDetails']);
            $router->get('/loadtrainsferDetails/{appNo}', ['uses' => 'staff\TransferController@loadtrainsferDetails']); 
            $router->post('/updateTransferApplication', ['uses' => 'staff\TransferController@updateTransferApplication']);
        }); 
    });
});