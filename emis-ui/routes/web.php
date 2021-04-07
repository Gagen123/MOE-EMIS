<?php
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
Route::get('/select_system', [App\Http\Controllers\HomeController::class, 'select_system'])->name('select_system');
Route::get('/get_screens_on_submodules/{type}/{id}', [App\Http\Controllers\HomeController::class, 'get_screens_on_submodules'])->name('get_screens_on_submodules');


Route::prefix('masters')->group(function () {
    Route::post('/save_global_masters', [App\Http\Controllers\AdministrationController::class, 'save_global_masters'])->name('save_global_masters');
    Route::get('/load_global_masters/{param}', [App\Http\Controllers\AdministrationController::class, 'load_global_masters'])->name('load_global_masters');
    Route::get('/all_active_dropdowns/{model}/{parent_id}', [App\Http\Controllers\AdministrationController::class, 'all_active_dropdowns'])->name('all_active_dropdowns');
    
    Route::post('/save_sfatt_masters', [App\Http\Controllers\AdministrationController::class, 'save_sfatt_masters'])->name('save_sfatt_masters');
    Route::get('/load_staff_masters/{param}', [App\Http\Controllers\AdministrationController::class, 'load_staff_masters'])->name('load_staff_masters');
    

    Route::post('/saveDzongkhag', [App\Http\Controllers\AdministrationController::class, 'saveDzongkhag'])->name('savedzongkhag');
    Route::get('/loadalldzongkhag', [App\Http\Controllers\AdministrationController::class, 'loadalldzongkhag'])->name('loadalldzongkhag');

    Route::post('/saveLocation', [App\Http\Controllers\AdministrationController::class, 'saveLocation'])->name('saveLocation');
    Route::get('/loadLocation', [App\Http\Controllers\AdministrationController::class, 'loadLocation'])->name('loadLocation');

    Route::post('/saveDisaster', [App\Http\Controllers\AdministrationController::class, 'saveDisaster'])->name('saveDisaster');
    Route::get('/loadDisaster', [App\Http\Controllers\AdministrationController::class, 'loadDisaster'])->name('loadDisaster');

    Route::post('/saveStructureCategory', [App\Http\Controllers\AdministrationController::class, 'saveStructureCategory'])->name('saveStructureCategory');
    Route::get('/loadStructureCategory', [App\Http\Controllers\AdministrationController::class, 'loadStructureCategory'])->name('loadStructureCategory');

    Route::post('/saveLevel', [App\Http\Controllers\AdministrationController::class, 'saveLevel'])->name('saveLevel');
    Route::get('/loadLevel', [App\Http\Controllers\AdministrationController::class, 'loadLevel'])->name('loadLevel');
    
    Route::post('/saveStructureFacility', [App\Http\Controllers\AdministrationController::class, 'saveStructureFacility'])->name('saveStructureFacility');
    Route::get('/loadStructureFacility', [App\Http\Controllers\AdministrationController::class, 'loadStructureFacility'])->name('loadStructureFacility');

    Route::post('/saveEquipmentType', [App\Http\Controllers\AdministrationController::class, 'saveEquipmentType'])->name('saveEquipmentType');
    Route::get('/loadEquipmentType', [App\Http\Controllers\AdministrationController::class, 'loadEquipmentType'])->name('loadEquipmentType');

    Route::post('/saveEquipmentUsage', [App\Http\Controllers\AdministrationController::class, 'saveEquipmentUsage'])->name('saveEquipmentUsage');
    Route::get('/loadEquipmentUsage', [App\Http\Controllers\AdministrationController::class, 'loadEquipmentUsage'])->name('loadEquipmentUsage');

    Route::post('/saveSportFacility', [App\Http\Controllers\AdministrationController::class, 'saveSportFacility'])->name('saveSportFacility');
    Route::get('/loadSportFacility', [App\Http\Controllers\AdministrationController::class, 'loadSportFacility'])->name('loadSportFacility');

    Route::post('/saveSportSupporter', [App\Http\Controllers\AdministrationController::class, 'saveSportSupporter'])->name('saveSportSupporter');
    Route::get('/loadSportSupporter', [App\Http\Controllers\AdministrationController::class, 'loadSportSupporter'])->name('loadSportSupporter');
    
    Route::post('/saveStrSubCategory', [App\Http\Controllers\AdministrationController::class, 'saveStrSubCategory'])->name('saveStrSubCategory');
    Route::get('/getStrCategoryDropdown', [App\Http\Controllers\AdministrationController::class, 'getStrCategoryDropdown'])->name('getStrCategoryDropdown');
    Route::get('/loadStrSubCategory', [App\Http\Controllers\AdministrationController::class, 'loadStrSubCategory'])->name('loadStrSubCategory');

    Route::post('/saveEquipmentItem', [App\Http\Controllers\AdministrationController::class, 'saveEquipmentItem'])->name('saveEquipmentItem');
    Route::get('/getEquipmentTypeDropdown', [App\Http\Controllers\AdministrationController::class, 'getEquipmentTypeDropdown'])->name('getEquipmentTypeDropdown');
    Route::get('/loadEquipmentItem', [App\Http\Controllers\AdministrationController::class, 'loadEquipmentItem'])->name('loadEquipmentItem');

    Route::post('/saveClass', [App\Http\Controllers\AdministrationController::class, 'saveClass'])->name('saveClass');
    Route::get('/loadClass', [App\Http\Controllers\AdministrationController::class, 'loadClass'])->name('loadClass');

    Route::post('/saveStream', [App\Http\Controllers\AdministrationController::class, 'saveStream'])->name('saveStream');
    Route::get('/getClassInDropdown', [App\Http\Controllers\AdministrationController::class, 'getClassInDropdown'])->name('getClassInDropdown');
    Route::get('/loadStream', [App\Http\Controllers\AdministrationController::class, 'loadStream'])->name('loadStream');

    //Student Masters
    Route::post('/saveStudentMasters', [App\Http\Controllers\student\StudentMasterController::class, 'saveStudentMasters'])->name('saveStudentMasters');
    Route::get('/loadStudentMasters/{param}', [App\Http\Controllers\student\StudentMasterController::class, 'loadStudentMasters'])->name('loadStudentMasters');
    Route::get('/allActiveStudentDropdowns/{model}/{parent_id}', [App\Http\Controllers\student\StudentMasterController::class, 'allActiveStudentDropdowns'])->name('allActiveStudentDropdowns');
    
}); 

Route::prefix('organization')->group(function () {
    /** general information route  */
    Route::post('/saveSection', [App\Http\Controllers\organization\GeneralInfoController::class, 'saveSection'])->name('saveSection');
    
    //connectivity
    Route::post('/saveConnectivity', [App\Http\Controllers\organization\GeneralInfoController::class, 'saveConnectivity'])->name('saveConnectivity');
    //location
    Route::post('/saveLocation', [App\Http\Controllers\organization\GeneralInfoController::class, 'saveLocation'])->name('saveLocation');

    // equipment route
    Route::post('/saveEquipment', [App\Http\Controllers\organization\GeneralInfoController::class, 'saveEquipment'])->name('saveEquipment');
    Route::get('/loadEquipment', [App\Http\Controllers\organization\GeneralInfoController::class, 'loadEquipment'])->name('loadEquipment');
    Route::get('/getType', [App\Http\Controllers\organization\GeneralInfoController::class, 'getType'])->name('getType');
    Route::get('/getItem/{typeId}', [App\Http\Controllers\organization\GeneralInfoController::class, 'getItem'])->name('getItem');
    Route::get('/getLocationUse', [App\Http\Controllers\organization\GeneralInfoController::class, 'getLocationUse'])->name('getLocationUse');
    
    /** structural facility route */
    Route::post('/saveSport', [App\Http\Controllers\organization\StructuralController::class, 'saveSport'])->name('saveSport');
    Route::get('/loadSport', [App\Http\Controllers\organization\StructuralController::class, 'loadSport'])->name('loadSport');
    Route::get('/getFacilityInDropdown', [App\Http\Controllers\organization\StructuralController::class, 'getFacilityInDropdown'])->name('getFacilityInDropdown');
    Route::get('/getSupportInDropdown', [App\Http\Controllers\organization\StructuralController::class, 'getSupportInDropdown'])->name('getSupportInDropdown');
    
    // infrastructure route
    Route::post('/saveInfrastructure', [App\Http\Controllers\organization\StructuralController::class, 'saveInfrastructure'])->name('saveInfrastructure');
    Route::get('/getCategoryInDropdown', [App\Http\Controllers\organization\StructuralController::class, 'getCategoryInDropdown'])->name('getCategoryInDropdown');
    Route::get('/getSubCategoryDropdown/{categoryId}', [App\Http\Controllers\organization\StructuralController::class, 'getSubCategoryDropdown'])->name('getSubCategoryDropdown');
    Route::get('/getStructureFacilityInDropdown', [App\Http\Controllers\organization\StructuralController::class, 'getStructureFacilityInDropdown'])->name('getStructureFacilityInDropdown');

    // establishment route
    Route::get('/getLevelInDropdown', [App\Http\Controllers\organization\EstablishmentController::class, 'getLevelInDropdown'])->name('getLeveInDropdown');
    Route::get('/getLocationInDropdown', [App\Http\Controllers\organization\EstablishmentController::class, 'getLocationInDropdown'])->name('getLocationInDropdown');
    Route::post('/saveEstablishment', [App\Http\Controllers\organization\EstablishmentController::class, 'saveEstablishment'])->name('saveEstablishment');
    Route::post('/saveClassStream', [App\Http\Controllers\organization\EstablishmentController::class, 'saveClassStream'])->name('saveClassStream');
    Route::get('/getClass', [App\Http\Controllers\organization\EstablishmentController::class, 'getClass'])->name('getClass');
    Route::get('/getStream', [App\Http\Controllers\organization\EstablishmentController::class, 'getStream'])->name('getStream');

});

Route::prefix('staff')->group(function () {
    Route::post('/savePersonalDetails', [App\Http\Controllers\staff\StaffController::class, 'savePersonalDetails'])->name('savePersonalDetails');
    Route::get('/loaddraftpersonalDetails', [App\Http\Controllers\staff\StaffController::class, 'loaddraftpersonalDetails'])->name('loaddraftpersonalDetails');
    Route::get('/loadpersonalDetails/{id}', [App\Http\Controllers\staff\StaffController::class, 'loadpersonalDetails'])->name('loadpersonalDetails');
    
    Route::post('/savequalificationDetails', [App\Http\Controllers\staff\StaffController::class, 'savequalificationDetails'])->name('savequalificationDetails');
    Route::get('/load_qualification/{staff_id}', [App\Http\Controllers\staff\StaffController::class, 'load_qualification'])->name('load_qualification');
    Route::get('/load_staff_qualification/{staff_id}', [App\Http\Controllers\staff\StaffController::class, 'load_staff_qualification'])->name('load_staff_qualification');
    
    Route::post('/savenominationDetails', [App\Http\Controllers\staff\StaffController::class, 'savenominationDetails'])->name('savenominationDetails');
    Route::get('/load_nominations/{staff_id}', [App\Http\Controllers\staff\StaffController::class, 'load_nominations'])->name('load_nominations');
    Route::get('/load_staff_nomination/{staff_id}', [App\Http\Controllers\staff\StaffController::class, 'load_staff_nomination'])->name('load_staff_nomination');

    Route::post('/updatefinalstaffDetails', [App\Http\Controllers\staff\StaffController::class, 'updatefinalstaffDetails'])->name('updatefinalstaffDetails');
    
    Route::get('/loadAllStaff/{type}', [App\Http\Controllers\staff\StaffController::class, 'loadAllStaff'])->name('loadAllStaff');

    
    
});

Route::prefix('students')->group(function () {
    Route::post('/saveStdResponsibility', [App\Http\Controllers\student\GeneralInfoController::class, 'saveStdResponsibility'])->name('saveStdResponsibility');
    Route::get('/loadStdResponsibility', [App\Http\Controllers\student\GeneralInfoController::class, 'loadStdResponsibility'])->name('loadStdResponsibility');
    
    
}); 
 
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/getpersonbycid/{cid}', [App\Http\Controllers\AdministrationController::class, 'getpersonbycid'])->name('getpersonbycid');






