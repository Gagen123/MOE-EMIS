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
        $router->post('/saveAcademicMasters', ['uses' => 'masters\AcademicMastersController@saveAcademicMasters']);
        $router->get('/loadAcademicMasters/{param}','masters\AcademicMastersController@loadAcademicMasters');
        $router->get('/loadClassSubject/{class_id}[/{stream_id}]','masters\AcademicMastersController@loadClassSubject');
        $router->post('/saveClassSubject',['uses' => 'masters\AcademicMastersController@saveClassSubject']);
        $router->post('/saveAssessmentFrequency',['uses' => 'masters\AcademicMastersController@saveAssessmentFrequency']);
        $router->get('/getClassAssessmentFrequency',['uses' => 'masters\AcademicMastersController@getClassAssessmentFrequency']);
        $router->get('/loadclassSubAssmtFrequency',['uses' => 'masters\AcademicMastersController@loadclassSubAssmtFrequency']);
        $router->get('/loadclassSubjectAssessment/{term_id}/{sub_id}/{class_id}[/{stream_id}]',['uses' => 'masters\AcademicMastersController@loadclassSubjectAssessment']);
        $router->post('/saveclassSubjectAssessment',['uses' => 'masters\AcademicMastersController@saveclassSubjectAssessment']);
        $router->get('/loadPromotionRule/{class_id}[/{stream_id}]','masters\AcademicMastersController@loadPromotionRule');
        $router->post('/savePromotionRule',['uses' => 'masters\AcademicMastersController@savePromotionRule']);


    });
    $router->group(['prefix' => 'academics'], function () use ($router) {
        $router->get('/getClassTeacher/{orgId}',['uses' => 'academic\AcademicController@getClassTeacher']);
        $router->post('/saveClassTeacher',['uses' => 'academic\AcademicController@saveClassTeacher']);
        $router->post('/saveSubjectTeacher',['uses' => 'academic\AcademicController@saveSubjectTeacher']);
        $router->get('/getSubjectTeacher/{orgId}',['uses' => 'academic\AcademicController@getSubjectTeacher']);
        $router->get('/getClassTeacherClasss/{orgId}/{staffId}',['uses' => 'academic\AcademicController@getClassTeacherClasss']);
        $router->get('/getElectiveSubjects/{classId}[/{streamId}]',['uses' => 'academic\AcademicController@getElectiveSubjects']);
        $router->post('/saveStudentElectiveSubject',['uses' => 'academic\AcademicController@saveStudentElectiveSubject']);
        $router->get('/getStudentElectiveSubjects',['uses' => 'academic\AcademicController@getStudentElectiveSubjects']);
        $router->get('/getClassWithElectiveSubject',['uses' => 'academic\AcademicController@getClassWithElectiveSubject']);
        $router->post('/saveStudentAttendance',['uses' => 'academic\AcademicController@saveStudentAttendance']);
        $router->get('/loadStudentAttendance/{orgId}/{staffId}',['uses' => 'academic\AcademicController@loadStudentAttendance']);
        $router->get('/getAttendanceData/{orgId}',['uses' => 'academic\AcademicController@getAttendanceData']);
        $router->post('/saveInstrunctionalDays',['uses' => 'academic\AcademicController@saveInstrunctionalDays']);
        $router->get('/getInstrunctionalDays',['uses' => 'academic\AcademicController@getInstrunctionalDays']);
        $router->get('/loadStudentAttendanceDetail/{orgId}',['uses' => 'academic\AcademicController@loadStudentAttendanceDetail']);
        $router->get('/getTermsByClass/{classId}[/{streamId}]',['uses' => 'academic\AcademicController@getTermsByClass']);
        $router->get('/loadStudentAssessmentList/{staffId}/{orgId}',['uses' => 'academic\AcademicController@loadStudentAssessmentList']);
        $router->get('/loadAssessmentAreas/{term_id}/{sub_id}/{class_id}[/{stream_id}]',['uses' => 'academic\AcademicController@loadAssessmentAreas']);
        $router->get('/loadStudentAssessments/{org_id}',['uses' => 'academic\AcademicController@loadStudentAssessments']);
        $router->post('/saveStudentAssessment/{userId}',['uses' => 'academic\AcademicController@saveStudentAssessment']);
        $router->post('/unlockForEdit/{Id}',['uses' => 'academic\AcademicController@unlockForEdit']);
        $router->get('/loadConsolidatedResultList/{staffId}/{orgId}',['uses' => 'academic\AcademicController@loadConsolidatedResultList']);
        $router->get('/loadAssessmentAreasForConsolidated',['uses' => 'academic\AcademicController@loadAssessmentAreasForConsolidated']);
        $router->get('/loadConsolidatedResult/{orgId}',['uses' => 'academic\AcademicController@loadConsolidatedResult']); 
        $router->post('/saveConsolidatedResut',['uses' => 'academic\AcademicController@saveConsolidatedResut']);
        $router->get('/loadClassBySubjectTeacher/{orgId}/{staffId}',['uses' => 'academic\AcademicController@loadClassBySubjectTeacher']);
        $router->get('/getTermsByFrequency/{frequencyId}',['uses' => 'academic\AcademicController@getTermsByFrequency']);
        $router->post('/unlockForEditForConsolidated/{Id}',['uses' => 'academic\AcademicController@unlockForEditForConsolidated']);


    });
});