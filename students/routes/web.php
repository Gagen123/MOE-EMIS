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
        //get Scouts Section Level By Scouts Section Id
        $router->get('/getScoutSectionLevel/{scoutSectionId}','Masters\StudentMasterController@getScoutSectionLevel');
        $router->get('/getScoutBadge/{scoutSectionId}','Masters\StudentMasterController@getScoutBadge');

        $router->post('/saveValidationcondition', ['uses' => 'Masters\StudentMasterController@saveValidationcondition']);
        $router->get('/loadValidationcondition','Masters\StudentMasterController@loadValidationcondition');
        //Get Scouts Section
        $router->get('/getScoutSection','Masters\StudentMasterController@getScoutSection');
        $router->post('/saveCounsellingType', ['uses' => 'Masters\StudentMasterController@saveCounsellingType']);
        $router->get('/loadActiveCounsellingMaster/{param}','Masters\StudentMasterController@loadActiveCounsellingMaster');
        $router->get('/getCounsellingTypeDropdown', ['uses' => 'Masters\StudentMasterController@getCounsellingTypeDropdown']);

    });

    $router->group(['prefix' => 'students'], function () use ($router) {
        $router->group(['prefix' => 'admission'], function () use ($router) {
            $router->post('/saveStudentDetails', ['uses' => 'Students\StudentAdmissionController@saveStudentDetails']);
            $router->post('/saveStudentDetailsFromPortal', ['uses' => 'Students\StudentAdmissionController@saveStudentDetailsFromPortal']);
            $router->post('/saveStudentGardianDetails', ['uses' => 'Students\StudentAdmissionController@saveStudentGardianDetails']);
            //This route is used in emis portal
            $router->post('/savedetailsNotEnrolledStd', ['uses' => 'Students\StudentAdmissionController@savedetailsNotEnrolledStd']);
            $router->post('/savedetailsEnrolledStd', ['uses' => 'Students\StudentAdmissionController@savedetailsEnrolledStd']);
            $router->post('/saveStudentClassDetails', ['uses' => 'Students\StudentAdmissionController@saveStudentClassDetails']);
            $router->post('/studentAdmissionupdate', ['uses' => 'students\StudentAdmissionController@studentAdmissionupdate']);
            $router->get('/loadStudentList/{param}',['uses' => 'Students\StudentAdmissionController@loadStudentList']);

            $router->get('/loadBasicStudentList/{param}',['uses' => 'Students\StudentAdmissionController@loadBasicStudentList']);
            $router->get('/loadStudentAdmissionList/{org_id}',['uses' => 'Students\StudentAdmissionController@loadStudentAdmissionList']);
            $router->get('/getStudentDetails/{std_id}',['uses' => 'Students\StudentAdmissionController@getStudentDetails']);
            //getting student details by cid number
            $router->get('/getstudentdetailsbyCid/{cid}',['uses' => 'Students\StudentAdmissionController@getstudentdetailsbyCid']);

            $router->post('/savedrequestadmission',['uses' => 'Students\StudentAdmissionController@savedrequestadmission']);

            $router->get('/applicationListsbyCid/{cid}',['uses' => 'Students\StudentAdmissionController@applicationListsbyCid']);
            $router->post('/acceptApplication',['uses' => 'Students\StudentAdmissionController@acceptApplication']);

            $router->get('/getAllStudentCid',['uses' => 'Students\StudentAdmissionController@getAllStudentCid']);
            $router->get('/getstudentGuardainClassDetails/{std_id}/{type}',['uses' => 'Students\StudentAdmissionController@getstudentGuardainClassDetails']);

            $router->get('/getEnrolledStudents/{std_id}',['uses' => 'Students\ClassXiAdmissionController@getEnrolledStudents']);
            //to get the application details
            $router->get('/getApplicationDetails/{id}',['uses' => 'Students\StudentAdmissionController@getApplicationDetails']);
        });
        //Student Updates
        $router->post('/saveStudentUpdates',['uses' => 'Students\StudentUpdateController@saveStudentUpdates']);
        $router->get('/loadStudentUpdatesList/{param}/{org_id}',['uses' => 'Students\StudentUpdateController@loadStudentUpdatesList']);

        //SEN Controller
        $router->group(['prefix' => 'sen'], function () use ($router) {
            $router->get('/getquestionnaire/{StudentId}', ['uses' => 'Sen\QuestionnaireController@getQuestionnaire']);
            $router->get('/getSenStudentList',['uses' => 'Sen\SenStudentController@getSenStudentList']);
            $router->post('/savestudentquestionnaire', ['uses' => 'Sen\SenStudentController@saveStudentQuestionnaire']);
        });

        //Validate student data
        $router->post('/validateStudentData',['uses' => 'General\StudentValidationController@validateStudentData']);

        //Get Student List by orgId, Orgclassstreamid
        $router->get('/getStudentList/{orgId}/{orgClassStreamId}',['uses' => 'General\GeneralStudentController@getStudentList']);
        $router->get('/loadStudentList/{param}',['uses' => 'General\GeneralStudentController@loadStudentList']);

        //this route is for assigning roll number to student
        $router->post('/saveStudentRollNumber',['uses' => 'General\GeneralStudentController@saveStudentRollNumber']);
        $router->get('/loadBasicStudentList/{param}',['uses' => 'General\GeneralStudentController@loadBasicStudentList']);
        
        $router->get('/loadStudentBySectionForRollNumber/{param1}', ['uses' => 'General\GeneralStudentController@loadStudentBySectionForRollNumber']);
        $router->get('/loadStudentBySection/{param1}', ['uses' => 'General\GeneralStudentController@loadStudentBySection']);
        $router->get('/loadStudentByClass/{class}', ['uses' => 'General\GeneralStudentController@loadStudentByClass']);
        $router->get('/studentListByGender/{data}', ['uses' => 'General\GeneralStudentController@studentListByGender']);
        //for profile
        $router->get('/getStudentDetails/{id}', ['uses' => 'General\GeneralStudentController@getStudentDetails']);
        $router->get('/getStudentParentsDetails/{id}', ['uses' => 'General\GeneralStudentController@getStudentParentsDetails']);
        $router->get('/getStudentRoleDetails/{id}', ['uses' => 'General\GeneralStudentController@getStudentRoleDetails']);
        $router->get('/getStudentProgrammeDetails/{id}', ['uses' => 'General\GeneralStudentController@getStudentProgrammeDetails']);

		//route by chimi to get temporary
        $router->get('/getStudents/{org_id}', ['uses' => 'General\GeneralStudentController@getStudents']);


        $router->post('/reportStudents',['uses' => 'Students\StudentAdmissionRelatedController@reportStudents']);
        $router->get('/loadUnreportedStudents/{org_id}', ['uses' => 'Students\StudentAdmissionRelatedController@loadUnreportedStudents']);
        $router->post('/saveStudentTransfer',['uses' => 'Students\StudentAdmissionRelatedController@saveStudentTransfer']);
        $router->get('/loadStudentTransfers/{param}', ['uses' => 'Students\StudentAdmissionRelatedController@loadStudentTransfers']);
        $router->post('/saveStudentWhereabouts',['uses' => 'Students\StudentAdmissionRelatedController@saveStudentWhereabouts']);
        $router->get('/loadStudentWhereabouts/{param1}', ['uses' => 'Students\StudentAdmissionRelatedController@loadStudentWhereabouts']);

        $router->post('/saveStudentClassAllocation',['uses' => 'Students\StudentClassController@saveStudentClassAllocation']);
        $router->get('/loadStudentClassAllocations/{param}',['uses' => 'Students\StudentClassController@loadStudentClassAllocations']);

        $router->post('/saveStudentAward',['uses' => 'Students\StudentAwardController@saveStudentAward']);
        $router->get('/loadStudentAwards/{param}',['uses' => 'Students\StudentAwardController@loadStudentAwards']);

        $router->post('/saveStudentResponsibility',['uses' => 'Students\StudentResponsibilityController@saveStudentResponsibility']);
        $router->get('/loadStudentResponsibilities/{param}',['uses' => 'Students\StudentResponsibilityController@loadStudentResponsibilities']);
        $router->get('//{param}',['usegetAssignedTeacherRoless' => 'Students\StudentResponsibilityController@getAssignedTeacherRoles']);

        $router->post('/addStudentRecord',['uses' => 'Students\StudentDisciplinaryRecordController@addStudentRecord']);
        $router->get('/loadStudentRecords/{param}',['uses' => 'Students\StudentDisciplinaryRecordController@loadStudentRecords']);

        $router->post('/addDewormingRecords', ['uses' => 'Students\StudentHealthController@addDewormingRecords']);
        $router->get('/loadDewormingRecords/{param}', ['uses' => 'Students\StudentHealthController@loadDewormingRecords']);
        $router->get('/loadViewDewormingDetails/{param}', ['uses' => 'Students\StudentHealthController@loadViewDewormingDetails']);
        $router->get('/getDewormingDetails/{id}', ['uses' => 'Students\StudentHealthController@getDewormingDetails']);

        $router->post('/addSupplementationRecords', ['uses' => 'Students\StudentHealthController@addSupplementationRecords']);
        $router->get('/loadSupplementationRecords/{param}', ['uses' => 'Students\StudentHealthController@loadSupplementationRecords']);
        $router->get('/loadViewSupplementationDetails/{param}', ['uses' => 'Students\StudentHealthController@loadViewSupplementationDetails']);
        $router->get('/getSupplementationDetails/{id}', ['uses' => 'Students\StudentHealthController@getSupplementationDetails']);

        $router->post('/addHealthScreeningRecords', ['uses' => 'Students\StudentHealthController@addHealthScreeningRecords']);
        $router->get('/loadHealthScreeningRecords/{param}', ['uses' => 'Students\StudentHealthController@loadHealthScreeningRecords']);
        $router->get('/listScreeningSummary/{param}', ['uses' => 'Students\StudentHealthController@listScreeningSummary']);
        $router->get('/getHealthScreeningSummary/{param}', ['uses' => 'Students\StudentHealthController@getHealthScreeningSummary']);
        $router->get('/getHealthScreeningDetails/{param}', ['uses' => 'Students\StudentHealthController@getHealthScreeningDetails']);
        $router->get('/getStudentScreenedDetails/{param}', ['uses' => 'Students\StudentHealthController@getStudentScreenedDetails']);
        $router->get('/getStudentReferredDetails/{param}', ['uses' => 'Students\StudentHealthController@getStudentReferredDetails']);
        $router->get('/loadViewScreeningDetails/{param}', ['uses' => 'Students\StudentHealthController@loadViewScreeningDetails']);
        $router->get('/getScreeningDetails/{id}', ['uses' => 'Students\StudentHealthController@getScreeningDetails']);

        $router->post('/addVaccinationRecords', ['uses' => 'Students\StudentHealthController@addVaccinationRecords']);
        $router->get('/updateVaccinationRecords/{param}', ['uses' => 'Students\StudentHealthController@updateVaccinationRecords']);
        $router->get('/loadVaccinationRecords/{param}', ['uses' => 'Students\StudentHealthController@loadVaccinationRecords']);

        $router->post('/addBmiRecords', ['uses' => 'Students\StudentHealthController@addBmiRecords']);
        $router->get('/loadBmiSummary/{param}', ['uses' => 'Students\StudentHealthController@loadBmiSummary']);

        $router->post('/saveStudentProject', ['uses' => 'Students\StudentProjectController@saveStudentProject']);
        $router->get('/loadStudentProjects/{param}', ['uses' => 'Students\StudentProjectController@loadStudentProjects']);
        $router->get('/listStudentProjects/{param}', ['uses' => 'Students\StudentProjectController@listStudentProjects']);
        $router->post('/saveProjectMembers', ['uses' => 'Students\StudentProjectController@saveProjectMembers']);
        $router->get('/listProjectMembers/{param}', ['uses' => 'Students\StudentProjectController@listProjectMembers']);

        $router->post('/saveStudentTraining',['uses' => 'Students\StudentTrainingController@saveStudentTraining']);
        $router->get('/loadStudentTrainings/{param}/{orgId}', ['uses' => 'Students\StudentTrainingController@loadStudentTrainings']);
        $router->get('/listStudentTrainings/{param}/{orgId}', ['uses' => 'Students\StudentTrainingController@listStudentTrainings']);
        $router->post('/saveTrainingParticipants', ['uses' => 'Students\StudentTrainingController@saveTrainingParticipants']);
        $router->get('/listTrainingParticipants/{param}/{orgId}', ['uses' => 'Students\StudentTrainingController@listTrainingParticipants']);

        $router->post('/saveStudentScouts', ['uses' => 'Students\StudentScoutController@saveStudentScouts']);
        $router->get('/loadStudentScouts/{param}', ['uses' => 'Students\StudentScoutController@loadStudentScouts']);
        $router->get('/listStudentScouts/{param}', ['uses' => 'Students\StudentScoutController@listStudentScouts']);
        //SAVE SCOUT PARTICIPANTS
        $router->post('/saveScoutParticipants', ['uses' => 'Students\StudentScoutController@saveScoutParticipants']);
        $router->get('/loadScoutMembers/{orgId}/{user_id}', ['uses' => 'Students\StudentScoutController@loadScoutMembers']);
        $router->get('/listScoutMembers/{orgId}/{user_id}', ['uses' => 'Students\StudentScoutController@listScoutMembers']);

        $router->post('/saveStudentProgram', ['uses' => 'Students\StudentProgramController@saveStudentProgram']);
        $router->get('/loadStudentPrograms/{param}', ['uses' => 'Students\StudentProgramController@loadStudentPrograms']);
        $router->get('/listStudentPrograms/{param}', ['uses' => 'Students\StudentProgramController@listStudentPrograms']);
        $router->get('/getProgramDetails/{param}', ['uses' => 'Students\StudentProgramController@getProgramDetails']);
        $router->post('/saveProgramMembers', ['uses' => 'Students\StudentProgramController@saveProgramMembers']);
        $router->get('/listProgramMembers/{param}', ['uses' => 'Students\StudentProgramController@listProgramMembers']);

        //Club Routes
        $router->post('/saveStudentClub', ['uses' => 'Students\StudentProgramClubController@saveStudentClub']);
        $router->get('/loadStudentClubs/{param}', ['uses' => 'Students\StudentProgramController@loadStudentClubs']);
        $router->get('/listStudentClubs/{param}', ['uses' => 'Students\StudentProgramController@listStudentClubs']);
        $router->post('/saveClubMembers', ['uses' => 'Students\StudentProgramController@saveClubMembers']);
        $router->get('/listClubMembers/{param}', ['uses' => 'Students\StudentProgramController@listClubMembers']);


        $router->post('/saveProgramActionPlan', ['uses' => 'Students\StudentProgramController@saveProgramActionPlan']);
        $router->get('/loadProgramActionPlan/{param}', ['uses' => 'Students\StudentProgramController@loadProgramActionPlan']);
        $router->post('/saveProgramInventory', ['uses' => 'Students\StudentProgramController@saveProgramInventory']);
        $router->get('/loadProgramInventory/{param}', ['uses' => 'Students\StudentProgramController@loadProgramInventory']);
        $router->get('/loadInventoryDetials/{param}', ['uses' => 'Students\StudentProgramController@loadInventoryDetials']);
        $router->get('/loadAboardList/{orgId}', ['uses' => 'Students\StudentAdmissionRelatedController@loadAboardList']);

        $router->post('/saveStudentAboard', ['uses' => 'Students\StudentAdmissionRelatedController@saveStudentAboard']);
        $router->get('/loadAboardList/{orgId}', ['uses' => 'Students\StudentAdmissionRelatedController@loadAboardList']);

        //Counselling Routes
        $router->post('/saveCounsellingInformation', ['uses' => 'Students\StudentCounsellingController@saveCounsellingInformation']);
        $router->get('/loadCounsellingInformation/{orgId}', ['uses' => 'Students\StudentCounsellingController@loadCounsellingInformation']);
        $router->post('/saveCounsellingProgram', ['uses' => 'Students\StudentCounsellingController@saveCounsellingProgram']);
        $router->get('/loadCounsellingProgram/{orgId}', ['uses' => 'Students\StudentCounsellingController@loadCounsellingProgram']);
        $router->get('/getCounsellingDetails/{couId}', ['uses' => 'Students\StudentCounsellingController@getCounsellingDetails']);

    });

});
