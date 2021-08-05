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

        Route::get('/getOrgList/{dzoId}/{orgType}', [App\Http\Controllers\AdminstratorController::class, 'getOrgList'])->name('getOrgList');

        Route::get('/loadClassStreamSection/{type}/{orgId}', [App\Http\Controllers\AdminstratorController::class, 'loadClassStreamSection'])->name('loadClassStreamSection');
        Route::get('/getStreamByclassId/{classId}', [App\Http\Controllers\AdminstratorController::class, 'getStreamByclassId'])->name('getStreamByclassId');

        Route::get('/loadValidationcondition', [App\Http\Controllers\AdminstratorController::class, 'loadValidationcondition'])->name('loadValidationcondition');
        Route::get('/active_marital_list', [App\Http\Controllers\AdminstratorController::class, 'active_marital_list'])->name('active_marital_list');
    });
    Route::get('/getstudentdetailsbyCid/{cid}', [App\Http\Controllers\NotenrolledController::class, 'getstudentdetailsbyCid'])->name('getstudentdetailsbyCid');
    Route::get('/loadSchoolList/{dzoId}/{type}', [App\Http\Controllers\NotenrolledController::class, 'loadSchoolList'])->name('loadSchoolList');
    Route::get('/loadProjection/{classId}', [App\Http\Controllers\NotenrolledController::class, 'loadProjection'])->name('loadProjection');
    Route::post('/saveorgclassDetails', [App\Http\Controllers\NotenrolledController::class, 'saveorgclassDetails'])->name('saveorgclassDetails');
    Route::get('/getorgclassDetails/{id}', [App\Http\Controllers\NotenrolledController::class, 'getorgclassDetails'])->name('getorgclassDetails');
    Route::get('/deleteclassDetails/{id}', [App\Http\Controllers\NotenrolledController::class, 'deleteclassDetails'])->name('deleteclassDetails');
    Route::post('/savefilanorgclassDetails', [App\Http\Controllers\NotenrolledController::class, 'savefilanorgclassDetails'])->name('savefilanorgclassDetails');


    Route::prefix('adminstratorController')->group(function () {
        Route::get('/getchildDetailsOncid/{cid}', [App\Http\Controllers\AdminstratorController::class, 'getchildDetailsOncid'])->name('getchildDetailsOncid');
        Route::get('/getpersonbycid/{cid}', [App\Http\Controllers\AdminstratorController::class, 'getpersonbycid'])->name('getpersonbycid');
    });

    //Track Application Controller
    Route::prefix('TrackApplicationController')->group(function () {
        Route::get('/applicationListsbyCid/{cid}', [App\Http\Controllers\TrackApplicationController::class, 'applicationListsbyCid'])->name('applicationListsbyCid');
        Route::post('/acceptApplication', [App\Http\Controllers\TrackApplicationController::class, 'acceptApplication'])->name('acceptApplication');
    });

    //Admission request controller
    Route::prefix('RequestadmissionController')->group(function () {
        Route::post('/savedrequestadmission', [App\Http\Controllers\RequestadmissionController::class, 'savedrequestadmission'])->name('savedrequestadmission');
    });


    Route::get('/load_dzongkhag_details_by_id/{dzo_id}', [App\Http\Controllers\AdminstratorController::class, 'load_dzongkhag_details_by_id'])->name('load_dzongkhag_details_by_id');
    Route::get('/load_gewog_details_by_id/{gewog_id}', [App\Http\Controllers\AdminstratorController::class, 'load_gewog_details_by_id'])->name('load_gewog_details_by_id');

    //getting organization details by OrgId
    Route::get('/loadOrganizationDetailsbyOrgId/{OrgOrganizationId}', [App\Http\Controllers\AdminstratorController::class, 'loadOrganizationDetailsbyOrgId'])->name('loadOrganizationDetailsbyOrgId');



    //Getting details by cid from std_student table


    Route::post('/saveStudentDetailsFromPortal', [App\Http\Controllers\NotenrolledController::class, 'saveStudentDetailsFromPortal'])->name('saveStudentDetailsFromPortal');
    Route::get('/getStudentDetailsFromPortal/{id}', [App\Http\Controllers\NotenrolledController::class, 'getStudentDetailsFromPortal'])->name('getStudentDetailsFromPortal');

    Route::post('/saveStudentGardianDetails', [App\Http\Controllers\NotenrolledController::class, 'saveStudentGardianDetails'])->name('saveStudentGardianDetails');
    Route::get('/getstudentdetails', [App\Http\Controllers\NotenrolledController::class, 'getstudentdetails'])->name('getstudentdetails');

    //pulling all cid of students
    Route::get('/getAllStudentCid', [App\Http\Controllers\NotenrolledController::class, 'getAllStudentCid'])->name('getAllStudentCid');

    Route::post('/savedetailsEnrolledStd', [App\Http\Controllers\ClassXIController::class, 'savedetailsEnrolledStd'])->name('savedetailsEnrolledStd');
    Route::post('/savedetailsNotEnrolledStd', [App\Http\Controllers\EnrolledStudentController::class, 'savedetailsEnrolledStd'])->name('savedetailsEnrolledStd');


    Route::prefix('enrolled_student')->group(function () {
        Route::get('profile', 'ProfileController@profile');
        Route::put('profile', 'ProfileController@updateProfile');
        Route::post('change-password', 'ProfileController@changePassword');
        Route::post('Profile/upload', 'ProductController@upload');
        Route::post('Userprofile', 'UserProfileController@upload');

    });

    //New Routes created by Phuntsho
    Route::prefix('track_application')->group(function (){
        Route::get('/getApplicationDetails/{id}', [App\Http\Controllers\TrackApplicationController::class, 'getApplicationDetails'])->name('getApplicationDetails');
    });

    Route::prefix('xi_admission')->group(function (){
        Route::get('/getStudentDetails/{std_id}', [App\Http\Controllers\StudentAdmissionController::class, 'getStudentDetails'])->name('getStudentDetails');
    });

