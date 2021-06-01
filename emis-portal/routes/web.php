<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotenrolledController;

    Route::get('/', function () {
    return view('welcome');
});

    Auth::routes(['verify' => true]);   

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
    Route::get('/getOrgList/{dzoId}', [App\Http\Controllers\AdminstratorController::class, 'getOrgList'])->name('getOrgList');

    Route::get('/loadClassStreamSection/{type}/{orgId}', [App\Http\Controllers\AdminstratorController::class, 'loadClassStreamSection'])->name('loadClassStreamSection');
    Route::get('/getStreamByclassId/{classId}', [App\Http\Controllers\AdminstratorController::class, 'getStreamByclassId'])->name('getStreamByclassId');
    Route::get('/getseatdetailsbyOrgId/{orgId}', [App\Http\Controllers\AdminstratorController::class, 'getseatdetailsbyOrgId'])->name('getseatdetailsbyOrgId');
});

Route::prefix('adminstratorController')->group(function () {
    Route::get('/getchildDetailsOncid/{cid}', [App\Http\Controllers\AdminstratorController::class, 'getchildDetailsOncid'])->name('getchildDetailsOncid');
    Route::get('/getpersonbycid/{cid}', [App\Http\Controllers\AdminstratorController::class, 'getpersonbycid'])->name('getpersonbycid');
});

//Track Application Controller
Route::prefix('TrackApplicationController')->group(function () {
    Route::get('/applicationListsbyCid/{cid}', [App\Http\Controllers\TrackApplicationController::class, 'applicationListsbyCid'])->name('applicationListsbyCid');
    Route::post('/acceptApplication', [App\Http\Controllers\TrackApplicationController::class, 'acceptApplication'])->name('acceptApplication');
});

    
    
    
    Route::get('/load_dzongkhag_details_by_id/{dzo_id}', [App\Http\Controllers\AdminstratorController::class, 'load_dzongkhag_details_by_id'])->name('load_dzongkhag_details_by_id');
    Route::get('/load_gewog_details_by_id/{gewog_id}', [App\Http\Controllers\AdminstratorController::class, 'load_gewog_details_by_id'])->name('load_gewog_details_by_id');
 
    //getting organization details by OrgId
    Route::get('/loadOrganizationDetailsbyOrgId/{OrgOrganizationId}', [App\Http\Controllers\AdminstratorController::class, 'loadOrganizationDetailsbyOrgId'])->name('loadOrganizationDetailsbyOrgId');


    //Getting details by cid from std_student table
    Route::get('/getstudentdetailsbyCid/{cid}', [App\Http\Controllers\NotenrolledController::class, 'getstudentdetailsbyCid'])->name('getstudentdetailsbyCid');

    Route::post('/saveStudentDetails', [App\Http\Controllers\NotenrolledController::class, 'saveStudentDetails'])->name('saveStudentDetails');
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

