<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    Log::debug('User:' . serialize($request->user()));
    return $request->user();
});


Route::namespace('App\\Http\\Controllers\\API\V1')->group(function () {
    Route::apiResources([
        'user' => 'UserController',
    ]);

});
//Routing for student portal
// Route::prefix('enrolled_student')->group(function () {
//     Route::get('profile', 'ProfileController@profile');
//     Route::put('profile', 'ProfileController@updateProfile');
//     Route::post('change-password', 'ProfileController@changePassword');
//     Route::post('Profile/upload', 'ProductController@upload');
//     Route::post('Userprofile', 'UserProfileController@upload');
//     Route::get('getdzongkhags', 'EnrolledStudentController@getDzongkhag');
//     Route::get('getschools', 'EnrolledStudentController@getSchool');
//     Route::get('getclass', 'EnrolledStudentController@getClass');
//     Route::get('getpersonbycid/{cid}', 'AdminController@getpersonbycid');
//     //
// });
