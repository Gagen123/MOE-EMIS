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
        $router->post('/saveStudentAward', 'Masters\StudentMasterController@saveStudentAward');
        $router->get('/loadStudentAwards', 'Masters\StudentMasterController@loadStudentAwards');
        $router->post('/saveStudentMasters', ['uses' => 'Masters\StudentMasterController@saveStudentMasters']);
        $router->get('/loadStudentMasters/{param}','Masters\StudentMasterController@loadStudentMasters');
        $router->get('/allActiveStudentDropdowns/{param}/{id}','Masters\StudentMasterController@allActiveStudentDropdowns');
        
    });

    /*
    $router->group(['prefix' => 'masters/student'], function () use ($router) {
        // term  route
        $router->post('/saveStudentAward', 'Masters\StudentMasterController@saveStudentAward');
        $router->get('/loadStudentAwards', 'Masters\StudentMasterController@loadStudentAwards');
        
    });
    */

});