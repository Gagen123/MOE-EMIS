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
$router->group(['prefix' => 'students_api/v1'], function () use ($router) {
    
    $router->group(['prefix' => 'masters/studentHealth'], function () use ($router) {
        // studenthealth route
        $router->get('/loadStudentHealth', 'Masters\StudentHealthController@loadStudentHealth');
        $router->post('/saveStudentHealth', 'Masters\StudentHealthController@saveStudentHealth');


    });
    
    $router->group(['prefix' => 'masters/screening'], function () use ($router) {
        // heathscreening route
        $router->get('/loadScreening', 'Masters\StudentHealthController@loadScreening');
        $router->post('/saveScreening', 'Masters\StudentHealthController@saveScreening');
    
    
    });

    $router->group(['prefix' => 'masters/term'], function () use ($router) {
        // term  route
        $router->post('/saveTerm', 'Masters\StudentHealthController@saveTerm');
        $router->get('/loadTerm', 'Masters\StudentHealthController@loadTerm');
        
    });

    
    $router->group(['prefix' => 'masters/students'], function () use ($router) {
        $router->post('/saveStudentMasters', ['uses' => 'Masters\StudentMasterController@saveStudentMasters']);
        $router->get('/loadStudentMasters/{param}','Masters\StudentMasterController@loadStudentMasters');
        $router->get('/loadActiveStudentMasters/{param}','Masters\StudentMasterController@loadActiveStudentMasters');
        $router->get('/allActiveStudentDropdowns/{param}/{id}','Masters\StudentMasterController@allActiveStudentDropdowns');
        
    });

    $router->group(['prefix' => 'students'], function () use ($router) {
        $router->group(['prefix' => 'admission'], function () use ($router) {
            $router->post('/saveStudentDetails', ['uses' => 'Students\StudentAdmissionController@saveStudentDetails']);
        });  

        $router->get('/loadStudentList/{param}',['uses' => 'General\GeneralStudentController@loadStudentList']);
        $router->get('/loadStudentBySection/{param1}/{param2}/{param3}', ['uses' => 'General\GeneralStudentController@loadStudentBySection']);

        $router->post('/saveStudentAward',['uses' => 'Students\StudentAwardController@saveStudentAward']);
        $router->get('/loadStudentAwards/{param}',['uses' => 'Students\StudentAwardController@loadStudentAwards']);

        $router->post('/saveStudentResponsibility',['uses' => 'Students\StudentResponsibilityController@saveStudentResponsibility']);
        $router->get('/loadStudentResponsibilities/{param}',['uses' => 'Students\StudentResponsibilityController@loadStudentResponsibilities']);

        $router->post('/addStudentRecord',['uses' => 'Students\StudentDisciplinaryController@addStudentRecord']);
        $router->get('/loadStudentRecords/{param}',['uses' => 'Students\StudentDisciplinaryController@loadStudentRecords']);

        $router->post('/addDewormingRecords', ['uses' => 'Students\StudentHealthController@addDewormingRecords']);
        $router->get('/loadDewormingRecords/{param}', ['uses' => 'Students\StudentHealthController@loadDewormingRecords']);

        $router->post('/addSupplementationRecords', ['uses' => 'Students\StudentHealthController@addSupplementationRecords']);
        $router->get('/loadSupplementationRecords/{param}', ['uses' => 'Students\StudentHealthController@loadSupplementationRecords']);

        $router->post('/addHealthScreeningRecords', ['uses' => 'Students\StudentHealthController@addHealthScreeningRecords']);
        $router->get('/loadHealthScreeningRecords/{param}', ['uses' => 'Students\StudentHealthController@loadHealthScreeningRecords']);
        $router->get('/listScreeningSummary/{param}', ['uses' => 'Students\StudentHealthController@listScreeningSummary']);

        $router->post('/addBmiRecords', ['uses' => 'Students\StudentHealthController@addBmiRecords']);
        $router->get('/loadBmiSummary/{param}', ['uses' => 'Students\StudentHealthController@loadBmiSummary']);

        $router->post('/saveStudentProject', ['uses' => 'Students\StudentProjectController@saveStudentProject']);
        $router->get('/loadStudentProjects/{param}', ['uses' => 'Students\StudentProjectController@loadStudentProjects']);
        $router->get('/listStudentProjects/{param}', ['uses' => 'Students\StudentProjectController@listStudentProjects']);
        $router->post('/saveProjectMembers', ['uses' => 'Students\StudentProjectController@saveProjectMembers']);
        $router->get('/listProjectMembers/{param}', ['uses' => 'Students\StudentProjectController@listProjectMembers']);

        $router->post('/saveStudentTraining', ['uses' => 'Students\StudentTrainingController@saveStudentTraining']);
        $router->get('/loadStudentTrainings/{param}', ['uses' => 'Students\StudentTrainingController@loadStudentTrainings']);
        $router->get('/listStudentTrainings/{param}', ['uses' => 'Students\StudentTrainingController@listStudentTrainings']);
        $router->post('/saveTrainingParticipants', ['uses' => 'Students\StudentTrainingController@saveTrainingParticipants']);

        $router->post('/saveStudentProgram', ['uses' => 'Students\StudentProgramController@saveStudentProgram']);
        $router->get('/loadStudentPrograms/{param}', ['uses' => 'Students\StudentProgramController@loadStudentPrograms']);
        $router->get('/listStudentPrograms/{param}', ['uses' => 'Students\StudentProgramController@listStudentPrograms']);
        $router->post('/saveProgramParticipants', ['uses' => 'Students\StudentProgramController@saveProgramParticipants']);
    }); 

});