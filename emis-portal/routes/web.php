<?php

use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('index');
    });
    Route::get('/new_register', [App\Http\Controllers\Admin\HomeController::class, 'user_register'])->name('user_register');
    Route::get('/login_screen', [App\Http\Controllers\Admin\HomeController::class, 'login_screen'])->name('login_screen');
    Route::get('/userlogin', [App\Http\Controllers\Admin\HomeController::class, 'userlogin'])->name('userlogin');
    Route::get('/user_logout', [App\Http\Controllers\Admin\HomeController::class, 'user_logout'])->name('user_logout');
    Route::post('/save_new_registration', [App\Http\Controllers\Admin\HomeController::class, 'save_new_registration'])->name('save_new_registration');
    Route::post('/change_password_portal', [App\Http\Controllers\Admin\HomeController::class, 'change_password_portal'])->name('change_password_portal');

    // Auth::routes(['verify' => true]);
    Route::get('/getSessionDetail', [App\Http\Controllers\Admin\HomeController::class, 'getSessionDetail'])->name('getSessionDetail');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('home', function () {
        return redirect('/dashboard');
    });
    Route::get('/{vue_capture?}', function () {
        return view('home');
    });


    //Global Controller
    Route::prefix('masters')->group(function () {
        Route::get('/loadGlobalMasters/{param}', [App\Http\Controllers\AdminstratorController::class, 'loadGlobalMasters'])->name('loadGlobalMasters');
        Route::get('/all_active_dropdowns/{model}/{parent_id}', [App\Http\Controllers\AdminstratorController::class, 'all_active_dropdowns'])->name('all_active_dropdowns');
        Route::get('/load_dzongkhag_details_by_id/{dzo_id}', [App\Http\Controllers\AdminstratorController::class, 'load_dzongkhag_details_by_id'])->name('load_dzongkhag_details_by_id');
        Route::get('/load_gewog_details_by_id/{gewog_id}', [App\Http\Controllers\AdminstratorController::class, 'load_gewog_details_by_id'])->name('load_gewog_details_by_id');

        Route::get('/getOrgList/{dzoId}/{orgType}', [App\Http\Controllers\AdminstratorController::class, 'getOrgList'])->name('getOrgList');
        Route::get('/getHssSchoolList/{dzo_id}', [App\Http\Controllers\AdminstratorController::class, 'getHssSchoolList'])->name('getHssSchoolList');
        Route::get('/loadClassAge', [App\Http\Controllers\AdminstratorController::class, 'loadClassAge'])->name('loadClassAge');
        Route::get('/loadClassStreamSection/{type}/{orgId}', [App\Http\Controllers\AdminstratorController::class, 'loadClassStreamSection'])->name('loadClassStreamSection');
        Route::get('/getStreamByclassId/{classId}', [App\Http\Controllers\AdminstratorController::class, 'getStreamByclassId'])->name('getStreamByclassId');
        Route::get('/getStreamByOrgId/{orgId}', [App\Http\Controllers\AdminstratorController::class, 'getStreamByOrgId'])->name('getStreamByOrgId');

        Route::get('/loadValidationcondition', [App\Http\Controllers\AdminstratorController::class, 'loadValidationcondition'])->name('loadValidationcondition');
        Route::get('/active_marital_list', [App\Http\Controllers\AdminstratorController::class, 'active_marital_list'])->name('active_marital_list');
        Route::get('/getStudentDetails/{std_id}', [App\Http\Controllers\AdminstratorController::class, 'getStudentDetails'])->name('getStudentDetails');
        Route::get('/getFullSchoolDetails/{id}', [App\Http\Controllers\AdminstratorController::class, 'getFullSchoolDetails'])->name('getFullSchoolDetails');
    });

    Route::prefix('adminstratorController')->group(function () {
        Route::get('/getchildDetailsOncid/{cid}', [App\Http\Controllers\AdminstratorController::class, 'getchildDetailsOncid'])->name('getchildDetailsOncid');
        Route::get('/getpersonbycid/{cid}', [App\Http\Controllers\AdminstratorController::class, 'getpersonbycid'])->name('getpersonbycid');
        Route::get('/getDOIData/{id}', [App\Http\Controllers\AdminstratorController::class, 'getDOIData'])->name('getDOIData');
        Route::get('/getstudentdetailsbyCid/{cid}', [App\Http\Controllers\AdminstratorController::class, 'getstudentdetailsbyCid'])->name('getstudentdetailsbyCid');

    });

    Route::prefix('admissions')->group(function () {
        Route::post('/saveStudentDetailsFromPortal', [App\Http\Controllers\StudentPortal\AdmissionController::class, 'saveStudentDetailsFromPortal'])->name('saveStudentDetailsFromPortal');
        Route::get('/getStudentDetailsFromPortal/{type}', [App\Http\Controllers\StudentPortal\AdmissionController::class, 'getStudentDetailsFromPortal'])->name('getStudentDetailsFromPortal');
        Route::post('/saveStudentGuardianDetails', [App\Http\Controllers\StudentPortal\AdmissionController::class, 'saveStudentGuardianDetails'])->name('saveStudentGuardianDetails');
        Route::post('/saveorgclassDetails', [App\Http\Controllers\StudentPortal\AdmissionController::class, 'saveorgclassDetails'])->name('saveorgclassDetails');
        Route::get('/getorgclassDetails/{id}', [App\Http\Controllers\StudentPortal\AdmissionController::class, 'getorgclassDetails'])->name('getorgclassDetails');
        Route::get('/deleteclassDetails/{id}', [App\Http\Controllers\StudentPortal\AdmissionController::class, 'deleteclassDetails'])->name('deleteclassDetails');
        Route::get('/loadResultPosition/{std_code}', [App\Http\Controllers\StudentPortal\AdmissionController::class, 'loadResultPosition'])->name('loadResultPosition');
        Route::get('/loadQualificationMarks', [App\Http\Controllers\StudentPortal\AdmissionController::class, 'loadQualificationMarks'])->name('loadQualificationMarks');
        Route::post('/savefilanorgclassDetails', [App\Http\Controllers\StudentPortal\AdmissionController::class, 'savefilanorgclassDetails'])->name('savefilanorgclassDetails');
        Route::post('/saveAdmissionRequest', [App\Http\Controllers\StudentPortal\AdmissionController::class, 'saveAdmissionRequest'])->name('saveAdmissionRequest');
        Route::get('/loadAdmissionRequest/{std_id}', [App\Http\Controllers\StudentPortal\AdmissionController::class, 'loadAdmissionRequest'])->name('loadAdmissionRequest');
    });

    Route::prefix('students')->group(function () {
        // Route::get('/applicationListsbyCid/{cid}', [App\Http\Controllers\StudentPortal\StudentController::class, 'applicationListsbyCid'])->name('applicationListsbyCid');
        // Route::post('/acceptApplication', [App\Http\Controllers\StudentPortal\StudentAdmissionControllerController::class, 'acceptApplication'])->name('acceptApplication');
        Route::get('/loadStudentMarks/{std_code}', [App\Http\Controllers\StudentPortal\StudentController::class, 'loadStudentMarks'])->name('loadStudentMarks');
        Route::get('/getstudentdetailsbyCid/{cid}', [App\Http\Controllers\StudentPortal\StudentController::class, 'getstudentdetailsbyCid'])->name('getstudentdetailsbyCid');
        Route::get('/getStudentClassId/{std_id}', [App\Http\Controllers\StudentPortal\StudentController::class, 'getStudentClassId'])->name('getStudentClassId');
    });

    Route::prefix('organizations')->group(function () {
        Route::get('/loadOrganizationDetailsbyOrgId/{id}', [App\Http\Controllers\Organization\OrganizationController::class, 'loadOrganizationDetailsbyOrgId'])->name('loadOrganizationDetailsbyOrgId');
        Route::get('/loadSchoolList/{dzoId}/{type}', [App\Http\Controllers\Organization\OrganizationController::class, 'loadSchoolList'])->name('loadSchoolList');
        Route::get('/loadParentSchoolList/{orgId}', [App\Http\Controllers\Organization\OrganizationController::class, 'loadParentSchoolList'])->name('loadParentSchoolList');
        Route::get('/loadProjection/{classId}', [App\Http\Controllers\Organization\OrganizationController::class, 'loadProjection'])->name('loadProjection');
        Route::get('/loadStreamList', [App\Http\Controllers\Organization\OrganizationController::class, 'loadStreamList'])->name('loadStreamList');
    });

    //Academic Routes are yet to be created

    Route::prefix('academics')->group(function () {
        Route::get('/something/{param}', [App\Http\Controllers\StudentPortal\AcademicsController::class, 'something'])->name('something');
        Route::post('/somefunction', [App\Http\Controllers\StudentPortal\AcademicsController::class, 'somefunction'])->name('somefunction');
    });

    // Result view route
    Route::prefix('results')->group(function () {
        Route::get('/loadClassStreamSection/{type}/{parent_id}', [App\Http\Controllers\ResultViewController::class, 'loadClassStreamSection'])->name('loadClassStreamSection');
        Route::get('/loadClassBySubjectTeacher', [App\Http\Controllers\ResultViewController::class, 'loadClassBySubjectTeacher'])->name('loadClassBySubjectTeacher');
        Route::get('/loadStudentAssessmentList', [App\Http\Controllers\ResultViewController::class, 'loadStudentAssessmentList'])->name('loadStudentAssessmentList');
        Route::get('/LoadFinalResultByStudentId/{std_code}', [App\Http\Controllers\ResultViewController::class, 'LoadFinalResultByStudentId'])->name('LoadFinalResultByStudentId');

        // Route::post('/somefunction', [App\Http\Controllers\StudentPortal\AcademicsController::class, 'somefunction'])->name('somefunction');
    });

    //Leadership selection and feedback routes

    Route::prefix('recruitmentFeedbackController')->group(function () {
        Route::get('/loadData/{param}', [App\Http\Controllers\recruitmentFeedbackController\RecruitmentFeedbackController::class, 'loadData'])->name('loadData');
        Route::get('/getapplicationDetailsForFeedback', [App\Http\Controllers\recruitmentFeedbackController\RecruitmentFeedbackController::class, 'getapplicationDetailsForFeedback'])->name('getapplicationDetailsForFeedback');
        Route::post('/saveFeedback', [App\Http\Controllers\recruitmentFeedbackController\RecruitmentFeedbackController::class, 'saveFeedback'])->name('saveFeedback');
        Route::get('/getEmployeeDetials/{emp_type}/{emp_id}', [App\Http\Controllers\recruitmentFeedbackController\RecruitmentFeedbackController::class, 'getEmployeeDetials'])->name('getEmployeeDetials');
        Route::get('/getleadershipDetailsByPosition/{position}', [App\Http\Controllers\recruitmentFeedbackController\RecruitmentFeedbackController::class, 'getleadershipDetailsByPosition'])->name('getleadershipDetailsByPosition');
        Route::get('/getpostDetails', [App\Http\Controllers\recruitmentFeedbackController\RecruitmentFeedbackController::class, 'getpostDetails'])->name('getpostDetails');
        Route::post('/submitApplication', [App\Http\Controllers\recruitmentFeedbackController\RecruitmentFeedbackController::class, 'submitApplication'])->name('submitApplication');
    });

    //OLD ROUTES - Delete routes below this line

    //Track Application Controller
    Route::prefix('TrackApplicationController')->group(function () {
        Route::get('/applicationListsbyCid/{cid}', [App\Http\Controllers\TrackApplicationController::class, 'applicationListsbyCid'])->name('applicationListsbyCid');
        Route::post('/acceptApplication', [App\Http\Controllers\TrackApplicationController::class, 'acceptApplication'])->name('acceptApplication');
    });

    //Admission request controller
    Route::prefix('RequestadmissionController')->group(function () {
        Route::post('/savedrequestadmission', [App\Http\Controllers\RequestadmissionController::class, 'savedrequestadmission'])->name('savedrequestadmission');
    });

    //Getting details by cid from std_student table
    // Route::post('/saveStudentDetailsFromPortal', [App\Http\Controllers\NotenrolledController::class, 'saveStudentDetailsFromPortal'])->name('saveStudentDetailsFromPortal');
    // Route::get('/getStudentDetailsFromPortal/{id}', [App\Http\Controllers\NotenrolledController::class, 'getStudentDetailsFromPortal'])->name('getStudentDetailsFromPortal');

    // Route::post('/saveStudentGardianDetails', [App\Http\Controllers\NotenrolledController::class, 'saveStudentGardianDetails'])->name('saveStudentGardianDetails');
    // Route::get('/getstudentdetails', [App\Http\Controllers\NotenrolledController::class, 'getstudentdetails'])->name('getstudentdetails');

    // Route::post('/savedetailsEnrolledStd', [App\Http\Controllers\ClassXIController::class, 'savedetailsEnrolledStd'])->name('savedetailsEnrolledStd');
    // Route::post('/savedetailsNotEnrolledStd', [App\Http\Controllers\EnrolledStudentController::class, 'savedetailsEnrolledStd'])->name('savedetailsEnrolledStd');

    // Route::prefix('enrolled_student')->group(function () {
    //     Route::get('profile', 'ProfileController@profile');
    //     Route::put('profile', 'ProfileController@updateProfile');
    //     Route::post('change-password', 'ProfileController@changePassword');
    //     Route::post('Profile/upload', 'ProductController@upload');
    //     Route::post('Userprofile', 'UserProfileController@upload');

    // });

    //New Routes created by Phuntsho
    // Route::prefix('track_application')->group(function (){
    //     Route::get('/getApplicationDetails/{type}/{id}', [App\Http\Controllers\TrackApplicationController::class, 'getApplicationDetails'])->name('getApplicationDetails');
    // });

