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
        //master updating into this controller
        $router->group(['prefix' => 'staffMasterController'], function () use ($router) {
            $router->post('/saveStaffMasters', ['uses' => 'masters\StaffMasterController@saveStaffMasters']);
            $router->get('/loadStaffMasters/{type}/{model}', ['uses' => 'masters\StaffMasterController@loadStaffMasters']);
            $router->get('/loadStaffMastersbyId/{model}/{id}', ['uses' => 'masters\StaffMasterController@loadStaffMastersbyId']);
            $router->get('/getTeacherPositionTitle', ['uses' => 'masters\StaffMasterController@getTeacherPositionTitle']);
            $router->post('/saveConfigMasters', ['uses' => 'masters\StaffMasterController@saveConfigMasters']);
            $router->get('/loadConfigMasters/{type}/{model}', ['uses' => 'masters\StaffMasterController@loadConfigMasters']);
            $router->get('/loadStaffsTransferMasters/{param}', 'masters\StaffMasterController@loadStaffsTransferMasters');
            $router->post('/saveTransferConfigMasters', ['uses' => 'masters\StaffMasterController@saveTransferConfigMasters']);
            $router->get('/loadAllTransferConfigMasters', ['uses' => 'masters\StaffMasterController@loadAllTransferConfigMasters']);
            $router->get('/loadTransferConfigDetails/{id}','masters\StaffMasterController@loadTransferConfigDetails');
            $router->get('/loadStaffTransferMasters/{param}',['uses' => 'masters\StaffMasterController@loadStaffTransferMasters']);
            $router->get('/loadStaffDropdownMasters/{model}/{parent_id}','masters\StaffMasterController@loadStaffDropdownMasters');
        });

        // $router->post('/saveStaffMasters', ['uses' => 'masters\StaffMastersController@saveStaffMasters']);
        // $router->get('/loadStaffMasters/{param}','masters\StaffMasterController@loadStaffMasters');
        // $router->get(ifica'/load_staff_masters_by_id/{param}/{id}','masters\StaffMasterController@load_staff_masters_by_id');
        // $router->get('/loadStaffDropdownMasters/{model}/{parent_id}','masters\StaffMasterController@loadStaffDropdownMasters');

        $router->post('/saveHrDevelopmentMasters', ['uses' => 'masters\HrDevelopmentMastersController@saveHrDevelopmentMasters']);
        $router->get('/loadHrDevelopmentMastersData/{type}', 'masters\HrDevelopmentMastersController@loadHrDevelopmentMastersData');
        $router->get('/loadHrDevelopmentDepedentMastersData/{model}/{parent_id}', 'masters\HrDevelopmentMastersController@loadHrDevelopmentDepedentMastersData');

        // $router->post('/saveTransferConfigMasters', ['uses' => 'masters\StaffMasterController@saveTransferConfigMasters']);
        $router->get('/loadLeaveConfigMasters/{type}/{submitter}', 'masters\StaffMasterController@loadLeaveConfigMasters');
        // $router->get('/loadAllTransferConfigMasters','masters\StaffMasterController@loadAllTransferConfigMasters');
        $router->get('/loadLeaveConfigDetails/{id}', 'masters\StaffMasterController@loadLeaveConfigDetails');
        // $router->get('/loadTransferConfigDetails/{id}','masters\StaffMasterController@loadTransferConfigDetails');
    });
    $router->group(['prefix' => 'staff'], function () use ($router) {
        $router->post('/savePersonalDetails', ['uses' => 'staff\StaffController@savePersonalDetails']);
        $router->get('/loaddraftpersonalDetails/{type}/{user_id}', ['uses' => 'staff\StaffController@loaddraftpersonalDetails']);
        $router->get('/checkThisCid/{cid}', ['uses' => 'staff\StaffController@checkThisCid']);

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
        $router->post('/updateStaffDetails', ['uses' => 'staff\StaffController@updateStaffDetails']);
        //route by Chimi thinley
        $router->get('/getLoginUser/{orgId}', ['uses' => 'staff\StaffController@getLoginUser']);
        // $router->get('/loadAllStaff/{type}', ['uses' => 'staff\StaffController@loadAllStaff']);
        // $router->get('/loadStaff/{type}/{param}', ['uses' => 'staff\StaffController@loadStaff']);

        $router->get('/getEmisUsers/{empId}', ['uses' => 'staff\StaffController@getEmisUsers']);

        $router->get('/load_staff_details_by_id/{id}', ['uses' => 'staff\StaffController@load_staff_details_by_id']);
        $router->get('/viewStaffProfile/{id}', ['uses' => 'staff\StaffController@viewStaffProfile']);
        $router->get('/getStaffName/{Id}', ['uses' => 'staff\StaffController@getStaffName']);
        //route by Chimi thinley
        $router->get('/getPrincipal/{orgId}', ['uses' => 'staff\StaffController@getPrincipal']);


        $router->get('/getStaffsName', ['uses' => 'staff\StaffController@getStaffsName']);

        //load list of staff
        $router->get('/loadStaffList/{org_id}', ['uses' => 'staff\StaffController@loadStaffList']);

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
            $router->post('/saveprogramOpenDetail', ['uses' => 'staff\HrDevelopmentController@saveprogramOpenDetail']);
            $router->get('/getprogramOpenDetail', ['uses' => 'staff\HrDevelopmentController@getprogramOpenDetail']);
            $router->get('/checkProgramAccess/{user_id}', ['uses' => 'staff\HrDevelopmentController@checkProgramAccess']);
        });
        $router->group(['prefix' => 'transfer'], function () use ($router) {
            $router->post('/saveTransferWindow', ['uses' => 'staff\TransferController@saveTransferWindow']);
            $router->get('/loadTransferWindow', ['uses' => 'staff\TransferController@loadTransferWindow']);
            $router->get('/getcurrentTransferWindowDetails/{id}', ['uses' => 'staff\TransferController@getcurrentTransferWindowDetails']);
            $router->post('/submitIntialapplicantDetails', ['uses' => 'staff\TransferController@submitIntialapplicantDetails']);
            $router->get('/getDraftDetails/{user_id}', ['uses' => 'staff\TransferController@getDraftDetails']);
            $router->post('/submitFinalapplicantDetails', ['uses' => 'staff\TransferController@submitFinalapplicantDetails']);
            $router->get('/getIntialAppointmentDate/{cid}', ['uses' => 'staff\TransferController@getIntialAppointmentDate']);
            $router->post('/UpdatedApplicantDetails', ['uses' => 'staff\TransferController@UpdatedApplicantDetails']);
            $router->get('/loadtrainsferDetails/{appNo}', ['uses' => 'staff\TransferController@loadtrainsferDetails']);

            $router->get('/loadTransferAppealDetail/{appNo}', ['uses' => 'staff\TransferController@loadTransferAppealDetail']);
            $router->get('/loadAppealattachementDetails/{appNo}', ['uses' => 'staff\TransferController@loadAppealattachementDetails']);
            $router->get('/loadPreference/{id}', ['uses' => 'staff\TransferController@loadPreference']);
            $router->post('/updateTransferApplication', ['uses' => 'staff\TransferController@updateTransferApplication']);
            $router->post('/SaveTransferAppeal', ['uses' => 'staff\TransferController@SaveTransferAppeal']);
            $router->post('/UpdateTransferAppeal', ['uses' => 'staff\TransferController@UpdateTransferAppeal']);
            $router->get('/loadtransferDetails/{type}/{userId}/{dzoId}', ['uses' => 'staff\TransferController@loadtransferDetails']);
            $router->get('/reportingTransfer/{type}/{dzoId}', ['uses' => 'staff\TransferController@reportingTransfer']);
            $router->get('/loadApplicationDetails/{id}', ['uses' => 'staff\TransferController@loadApplicationDetails']);
            $router->get('/LoadTransferAppealDetails/{user_id}', ['uses' => 'staff\TransferController@LoadTransferAppealDetails']);
            $router->get('/getapplicatName/{id}', ['uses' => 'staff\TransferController@getapplicatName']);
            $router->get('/LoadApplicationDetailsByUserId/{param}/{user_id}', ['uses' => 'staff\TransferController@LoadApplicationDetailsByUserId']);
            $router->get('/getTransferConfigDetails/{role_ids}', ['uses' => 'staff\TransferController@getTransferConfigDetails']);
            $router->get('/getAppVeriTransferConfigDetails/{transfer_type_id}/{app_role_id}/{role_id}', ['uses' => 'staff\TransferController@getAppVeriTransferConfigDetails']);

            $router->get('/getSubmitterId/{type_id}/{role_id}', ['uses' => 'staff\TransferController@getSubmitterId']);
            $router->get('/checkEligibilityForTransfer/{type_id}/{role_id}', ['uses' => 'staff\TransferController@checkEligibilityForTransfer']);
            $router->get('/getTransferTypeName/{type_id}', ['uses' => 'staff\TransferController@getTransferTypeName']);
            $router->get('/getNextApprovalRoleIdForTransfer/{type_id}/{submitterRoleId}/{currentRoleId}', ['uses' => 'staff\TransferController@getNextApprovalRoleIdForTransfer']);
        });

        //principal recuritment Approval controller by gagen
        $router->group(['prefix' => 'staffRecruitmentController'], function () use ($router) {
            $router->post('/savePrincipalApproval', ['uses' => 'staff\StaffRecruitmentController@savePrincipalApproval']);
            $router->post('/updatePrincipalApproval', ['uses' => 'staff\StaffRecruitmentController@updatePrincipalApproval']);
            $router->get('/loadPrincipalRecuritmentApplication/{appNo}', ['uses' => 'staff\StaffRecruitmentController@loadPrincipalRecuritmentApplication']);
            $router->get('/loadPrincipalApprovalApplication/{id}/{type}', ['uses' => 'staff\StaffRecruitmentController@loadApprovalApplication']);
            $router->get('/loadPrincipalApplicationDetials/{appNo}', ['uses' => 'staff\StaffRecruitmentController@loadPrincipalApplicationDetials']);
            $router->get('/loadPrincipalAttachmentDetials/{id}', ['uses' => 'staff\StaffRecruitmentController@loadPrincipalAttachmentDetials']);
        });

        //Expatriate recuritment Approval controller by gagen
        $router->group(['prefix' => 'staffRecruitmentController'], function () use ($router) {
            $router->post('/saveExpatriateRecuritment', ['uses' => 'staff\StaffRecruitmentController@saveExpatriateRecuritment']);
            $router->post('/UpdateExpatriateRecuritment', ['uses' => 'staff\StaffRecruitmentController@UpdateExpatriateRecuritment']);
            $router->get('/loadPrincipalRecuritmentApplication/{appNo}', ['uses' => 'staff\StaffRecruitmentController@loadPrincipalRecuritmentApplication']);
            $router->get('/loadExpatriateApprovalApplication/{id}/{type}', ['uses' => 'staff\StaffRecruitmentController@loadApprovalApplication']);
        });

        $router->group(['prefix' => 'managementBody'], function () use ($router) {
            $router->post('/saveManagementBody', ['uses' => 'staff\ManagementBodyController@saveManagementBody']);
            $router->post('/saveManagementBodyComposition', ['uses' => 'staff\ManagementBodyController@saveManagementBodyComposition']);
            $router->get('/loadManagementBodyComposition/{id}', ['uses' => 'staff\ManagementBodyController@loadManagementBodyComposition']);
            $router->get('/deleteManagementBodyComposition/{id}/{itemId}', ['uses' => 'staff\ManagementBodyController@deleteManagementBodyComposition']);
            $router->post('/updateManagementBody', ['uses' => 'staff\ManagementBodyController@updateManagementBody']);
            $router->get('/loadcreatedManagementBodyComposition/{param}', ['uses' => 'staff\ManagementBodyController@loadcreatedManagementBodyComposition']);
            $router->get('/loadcurrentbaord/{id}', ['uses' => 'staff\ManagementBodyController@loadcurrentbaord']);
            $router->post('/saveManagementMeeting', ['uses' => 'staff\ManagementBodyController@saveManagementMeeting']);
            $router->get('/loadCurrentMeeting/{userid}', ['uses' => 'staff\ManagementBodyController@loadCurrentMeeting']);
            $router->post('/saveResolutions', ['uses' => 'staff\ManagementBodyController@saveResolutions']);
        });

        $router->group(['prefix' => 'staffServices'], function () use ($router) {
            $router->post('/saveStaffAward', ['uses' => 'staff\StaffServicesController@saveStaffAward']);
            $router->get('/loadStaffAward/{user_id}', ['uses' => 'staff\StaffServicesController@loadStaffAward']);
            $router->get('/loadStaffAwardforView/{id}', ['uses' => 'staff\StaffServicesController@loadStaffAwardforView']);
            $router->get('/deleteStaffServices/{type}/{id}', ['uses' => 'staff\StaffServicesController@deleteStaffServices']);

            $router->post('/saveStaffResponsibility', ['uses' => 'staff\StaffServicesController@saveStaffResponsibility']);
            $router->get('/loadStaffResponsibility/{user_id}', ['uses' => 'staff\StaffServicesController@loadStaffResponsibility']);

            $router->post('/saveStaffDisaplinary', ['uses' => 'staff\StaffServicesController@saveStaffDisaplinary']);
            $router->get('/loadStaffdisaplinary/{user_id}', ['uses' => 'staff\StaffServicesController@loadStaffdisaplinary']);
            $router->get('/loadStaffdisaplinaryByIsd/{id}', ['uses' => 'staff\StaffServicesController@loadStaffdisaplinaryByIsd']);


            $router->post('/saveStaffAttendance', ['uses' => 'staff\StaffServicesController@saveStaffAttendance']);
            $router->get('/loadStaffattendance/{param}', ['uses' => 'staff\StaffServicesController@loadStaffattendance']);
            $router->get('/loadattendanceDetails/{id}', ['uses' => 'staff\StaffServicesController@loadattendanceDetails']);
            $router->get('/checkAttendanceDetailsByDate/{year}/{month}/{org_id}', ['uses' => 'staff\StaffServicesController@checkAttendanceDetailsByDate']);

            $router->get('/checkEligibility/{type_id}/{role_ids}', ['uses' => 'staff\StaffServicesController@checkEligibility']);
            $router->get('/getLeaveConfigDetails/{role_ids}', ['uses' => 'staff\StaffServicesController@getLeaveConfigDetails']);

            $router->post('/submitLeaveApplication', ['uses' => 'staff\StaffServicesController@submitLeaveApplication']);
            $router->get('/loadLeaveDetails/{appNo}', ['uses' => 'staff\StaffServicesController@loadLeaveDetails']);
            $router->get('/loadLeaveDetailsForEdit/{id}', ['uses' => 'staff\StaffServicesController@loadLeaveDetailsForEdit']);
            $router->post('/verifyApproveRejectLeaveApplication', ['uses' => 'staff\StaffServicesController@verifyApproveRejectLeaveApplication']);
            $router->get('/getApprovedLeaveCount/{staff_id}/{leave_type_id}', ['uses' => 'staff\StaffServicesController@getApprovedLeaveCount']);
            $router->get('/getOnGoingLeave/{staff_id}', ['uses' => 'staff\StaffServicesController@getOnGoingLeave']);
            $router->get('/getallLeaves/{staff_id}', ['uses' => 'staff\StaffServicesController@getallLeaves']);
            $router->get('/getAppVeriLeaveConfigDetails/{leave_type_id}/{app_role_id}/{role_id}', ['uses' => 'staff\StaffServicesController@getAppVeriLeaveConfigDetails']);
            $router->get('/getLeaveBalance/{staff_id}/{year}', ['uses' => 'staff\StaffServicesController@getLeaveBalance']);
        });
        $router->group(['prefix' => 'staffLeadershipSerivcesController'], function () use ($router) {
            $router->post('/createPost', ['uses' => 'staff\StaffLeadershipSerivcesController@createPost']);
            $router->get('/loadAllPosts/{user_id}', ['uses' => 'staff\StaffLeadershipSerivcesController@loadAllPosts']);
            $router->get('/loadDetials/{id}', ['uses' => 'staff\StaffLeadershipSerivcesController@loadDetials']);
            $router->get('/loadAllPostList/{role_ids}', ['uses' => 'staff\StaffLeadershipSerivcesController@loadAllPostList']);
            $router->get('/checkApplication/{id}', ['uses' => 'staff\StaffLeadershipSerivcesController@checkApplication']);
            $router->get('/loadPostDetials/{id}', ['uses' => 'staff\StaffLeadershipSerivcesController@loadPostDetials']);
            $router->post('/submitApplication', ['uses' => 'staff\StaffLeadershipSerivcesController@submitApplication']);
            $router->get('/loadAllApplication/{user_id}', ['uses' => 'staff\StaffLeadershipSerivcesController@loadAllApplication']);
            $router->get('/loadApprovedApplication', ['uses' => 'staff\StaffLeadershipSerivcesController@loadApprovedApplication']);
            $router->get('/loadapplicaitontDetials/{id}', ['uses' => 'staff\StaffLeadershipSerivcesController@loadapplicaitontDetials']);
            $router->post('/createLeadershipSelection', ['uses' => 'staff\StaffLeadershipSerivcesController@createLeadershipSelection']);
            $router->get('/loadLeadershipSelection/{type}/{id}', ['uses' => 'staff\StaffLeadershipSerivcesController@loadLeadershipSelection']);
            $router->post('/createNominationForLeadershipSelection', ['uses' => 'staff\StaffLeadershipSerivcesController@createNominationForLeadershipSelection']);
            $router->get('/loadNominationForLeadershipSelection/{id}', ['uses' => 'staff\StaffLeadershipSerivcesController@loadNominationForLeadershipSelection']);
            $router->post('/publishleadership', ['uses' => 'staff\StaffLeadershipSerivcesController@publishleadership']);
            $router->get('/loadAllLeadershipSelection', ['uses' => 'staff\StaffLeadershipSerivcesController@loadAllLeadershipSelection']);
            $router->get('/checkforfeedbackLink/{id}', ['uses' => 'staff\StaffLeadershipSerivcesController@checkforfeedbackLink']);
            $router->get('/getleadershipDetailsForFeedback/{id}', ['uses' => 'staff\StaffLeadershipSerivcesController@getleadershipDetailsForFeedback']);
            $router->get('/getleadershipDetailsByPosition/{id}', ['uses' => 'staff\StaffLeadershipSerivcesController@getleadershipDetailsByPosition']);
            $router->get('/loadapplicaitontDetialsforVerification/{app_no}', ['uses' => 'staff\StaffLeadershipSerivcesController@loadapplicaitontDetialsforVerification']);
            $router->get('/loadData/{param}', ['uses' => 'staff\StaffLeadershipSerivcesController@loadData']);
            $router->post('/saveData', ['uses' => 'staff\StaffLeadershipSerivcesController@saveData']);
            $router->get('/loadexistingData/{id}', ['uses' => 'staff\StaffLeadershipSerivcesController@loadexistingData']);
            $router->post('/saveFeedbackProviderData', ['uses' => 'staff\StaffLeadershipSerivcesController@saveFeedbackProviderData']);
            $router->get('/getFeedbackProviderData/{appNo}', ['uses' => 'staff\StaffLeadershipSerivcesController@getFeedbackProviderData']);
            $router->get('/deleteNomination/{id}', ['uses' => 'staff\StaffLeadershipSerivcesController@deleteNomination']);
            $router->post('/verifyApproveNotify', ['uses' => 'staff\StaffLeadershipSerivcesController@verifyApproveNotify']);
            $router->get('/getFeedbackData/{id}', ['uses' => 'staff\StaffLeadershipSerivcesController@getFeedbackData']);
            $router->post('/saveFeedback', ['uses' => 'staff\StaffLeadershipSerivcesController@saveFeedback']);
            $router->get('/updatedVisited/{id}', ['uses' => 'staff\StaffLeadershipSerivcesController@updatedVisited']);
        });

        //Projections and Indicators
        $router->group(['prefix' => 'projections_indicators'], function () use ($router) {
            $router->post('/loadTeacherNumbers', 'staff\ProjectionIndicatorController@loadTeacherNumbers');
            $router->post('/loadTeacherNationality', 'staff\ProjectionIndicatorController@loadTeacherNationality');
        });

        $router->group(['prefix' => 'staffOfficeorderController'], function () use ($router) {
            $router->post('/submitApplication', ['uses' => 'staff\StaffOfficeorderController@submitApplication']);
            $router->get('/checkOngoingApplication/{type}', ['uses' => 'staff\StaffOfficeorderController@checkOngoingApplication']);
            $router->get('/loadCreatedApplication/{type}', ['uses' => 'staff\StaffOfficeorderController@loadCreatedApplication']);
            $router->get('/loadCreatedApplicationForVerification/{type}', ['uses' => 'staff\StaffOfficeorderController@loadCreatedApplicationForVerification']);
            $router->get('/loadDetForVerification/{id}', ['uses' => 'staff\StaffOfficeorderController@loadDetForVerification']);
            $router->post('/verifyApprove', ['uses' => 'staff\StaffOfficeorderController@verifyApprove']);
        });
    });

    $router->group(['prefix' => 'loadstaff'], function () use ($router) {
        $router->get('/loadStaffList/{type}/{parent_id}', ['uses' => 'staff\LoadStaffController@loadStaffList']);
        $router->get('/loadtaffByOrg/{type}/{parent_id}', ['uses' => 'staff\LoadStaffController@loadtaffByOrg']);
        $router->get('/loadFewDetailsStaffList/{type}/{parent_id}', ['uses' => 'staff\LoadStaffController@loadFewDetailsStaffList']);
        $router->get('/viewStaffDetails/{type}/{id}', ['uses' => 'staff\LoadStaffController@viewStaffDetails']);
        $router->get('/loadFewDetailsStaffListBySubject', ['uses' => 'staff\LoadStaffController@loadFewDetailsStaffListBySubject']);
        $router->get('/loadStaffCountDetail/{type}/{id}', ['uses' => 'staff\LoadStaffController@loadStaffCountDetail']);
    });

    //Staff Update Services
    $router->group(['prefix' => 'staffUpdateController'], function () use ($router) {
        $router->post('/saveStaffcareerStage', ['uses' => 'staff\StaffUpdateController@saveStaffcareerStage']);
        $router->post('/saveSEN', ['uses' => 'staff\StaffUpdateController@saveSEN']);
        $router->post('/saveTeachinSubject', ['uses' => 'staff\StaffUpdateController@saveTeachinSubject']);
        $router->post('/saveStaffContact', ['uses' => 'staff\StaffUpdateController@saveStaffContact']);
        $router->post('/saveStaffMaritialStatus', ['uses' => 'staff\StaffUpdateController@saveStaffMaritialStatus']);

        //pulling the register organization from bifurcation
        $router->get('/loadBifurcationList', ['uses' => 'staff\StaffUpdateController@loadBifurcationList']);
    });
    //Staff Seleration and Secondment Services
    $router->group(['prefix' => 'staffSepSecController'], function () use ($router) {
        $router->post('/saveSecondmentSeperation', ['uses' => 'staff\StaffSepSecController@saveSecondmentSeperation']);
        $router->get('/loadSecondment/{type}/{model}', ['uses' => 'staff\StaffSepSecController@loadSecondment']);
        $router->get('/loadLeaveStaffList', ['uses' => 'staff\StaffSepSecController@loadLeaveStaffList']);
    });

    $router->group(['prefix' => 'substitution'], function () use ($router) {
        $router->post('/savestaff', ['uses' => 'staff\SubstitutionController@savestaff']);
        $router->get('/loadStaff/{type}/{model}', ['uses' => 'staff\SubstitutionController@loadStaff']);
        $router->get('/loadsubstitutestaff', ['uses' => 'staff\SubstitutionController@loadsubstitutestaff']);
        $router->post('/saveStaffSubstituted', ['uses' => 'staff\SubstitutionController@saveStaffSubstituted']);
        $router->get('/loadSubstaff', ['uses' => 'staff\SubstitutionController@loadSubstaff']);
        $router->get('/getEditSubstitutedList/{subid}', ['uses' => 'staff\SubstitutionController@getEditSubstitutedList']);
    });

    $router->group(['prefix' => 'zest'], function () use ($router) {
        $router->post('/saveAppointmentDetails', ['uses' => 'staff\ZestController@saveAppointmentDetails']);
        $router->get('/loadappointment', ['uses' => 'staff\ZestController@loadappointment']);
        $router->get('/loadSeperation', ['uses' => 'staff\ZestController@loadSeperation']);
        $router->get('/loadSecondment/{param}', ['uses' => 'staff\ZestController@loadSecondment']);
        $router->get('/loadPromotion/{param}', ['uses' => 'staff\ZestController@loadPromotion']);
        $router->get('/loadPromotionDetails/{id}', ['uses' => 'staff\ZestController@loadPromotionDetails']);
        $router->get('/loadLongTermTraining/{param}', ['uses' => 'staff\ZestController@loadLongTermTraining']);
        $router->get('/loadLeaveDetails/{param}', ['uses' => 'staff\ZestController@loadLeaveDetails']);

    });
});
