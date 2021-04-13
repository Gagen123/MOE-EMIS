<?php
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
Route::get('/select_system', [App\Http\Controllers\HomeController::class, 'select_system'])->name('select_system');
Route::get('/get_screens_on_submodules/{type}/{id}', [App\Http\Controllers\HomeController::class, 'get_screens_on_submodules'])->name('get_screens_on_submodules');


Route::prefix('masters')->group(function () {
    Route::post('/saveGlobalMasters', [App\Http\Controllers\AdministrationController::class, 'saveGlobalMasters'])->name('saveGlobalMasters');
    Route::get('/loadGlobalMasters/{param}', [App\Http\Controllers\AdministrationController::class, 'loadGlobalMasters'])->name('loadGlobalMasters');
    Route::get('/all_active_dropdowns/{model}/{parent_id}', [App\Http\Controllers\AdministrationController::class, 'all_active_dropdowns'])->name('all_active_dropdowns');
    
    Route::post('/saveStaffMasters', [App\Http\Controllers\AdministrationController::class, 'saveStaffMasters'])->name('saveStaffMasters');
    Route::get('/loadStaffMasters/{param}', [App\Http\Controllers\AdministrationController::class, 'loadStaffMasters'])->name('loadStaffMasters');

    Route::post('/saveHrDevelopmentMasters', [App\Http\Controllers\staff\HrDevelopmentMastersController::class, 'saveHrDevelopmentMasters'])->name('saveHrDevelopmentMasters');
    Route::get('/loadHrDevelopmentMastersData/{type}', [App\Http\Controllers\staff\HrDevelopmentMastersController::class, 'loadHrDevelopmentMastersData'])->name('loadHrDevelopmentMastersData');
    Route::get('/loadHrDevelopmentDepedentMastersData/{model}/{parent_id}', [App\Http\Controllers\staff\HrDevelopmentMastersController::class, 'loadHrDevelopmentDepedentMastersData'])->name('loadHrDevelopmentDepedentMastersData');

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

    Route::post('/saveElectricitySource', [App\Http\Controllers\AdministrationController::class, 'saveElectricitySource'])->name('saveElectricitySource');
    Route::get('/loadElectricitySource', [App\Http\Controllers\AdministrationController::class, 'loadElectricitySource'])->name('loadElectricitySource');

    Route::post('/saveElectricitySupply', [App\Http\Controllers\AdministrationController::class, 'saveElectricitySupply'])->name('saveElectricitySupply');
    Route::get('/loadElectricitySupply', [App\Http\Controllers\AdministrationController::class, 'loadElectricitySupply'])->name('loadElectricitySupply');
    
    Route::post('/saveRoadType', [App\Http\Controllers\AdministrationController::class, 'saveRoadType'])->name('saveRoadType');
    Route::get('/loadRoadType', [App\Http\Controllers\AdministrationController::class, 'loadRoadType'])->name('loadRoadType');
    
    Route::post('/saveServiceProvider', [App\Http\Controllers\AdministrationController::class, 'saveServiceProvider'])->name('saveServiceProvider');
    Route::get('/loadServiceProvider', [App\Http\Controllers\AdministrationController::class, 'loadServiceProvider'])->name('loadServiceProvider');
    
    Route::post('/saveStructureDesigner', [App\Http\Controllers\AdministrationController::class, 'saveStructureDesigner'])->name('saveStructureDesigner');
    Route::get('/loadStructureDesigner', [App\Http\Controllers\AdministrationController::class, 'loadStructureDesigner'])->name('loadStructureDesigner');

    Route::post('/saveContactType', [App\Http\Controllers\AdministrationController::class, 'saveContactType'])->name('saveContactType');
    Route::get('/loadContactType', [App\Http\Controllers\AdministrationController::class, 'loadContactType'])->name('loadContactType');

    //Student Masters
    Route::post('/saveStudentMasters', [App\Http\Controllers\student\StudentMasterController::class, 'saveStudentMasters'])->name('saveStudentMasters');
    Route::get('/loadStudentMasters/{param}', [App\Http\Controllers\student\StudentMasterController::class, 'loadStudentMasters'])->name('loadStudentMasters');
    Route::get('/allActiveStudentDropdowns/{model}/{parent_id}', [App\Http\Controllers\student\StudentMasterController::class, 'allActiveStudentDropdowns'])->name('allActiveStudentDropdowns');
    
}); 

Route::prefix('organization')->group(function () {
    /** general information route  */
    Route::post('/saveSection', [App\Http\Controllers\organization\GeneralInfoController::class, 'saveSection'])->name('saveSection');
    Route::get('/getClassByOrganizationId/{orgId}', [App\Http\Controllers\organization\GeneralInfoController::class, 'getClassByOrganizationId'])->name('getClassByOrganizationId');

    Route::post('/saveClassMapping', [App\Http\Controllers\organization\GeneralInfoController::class, 'saveClassMapping'])->name('saveClassMapping');

    //connectivity
    Route::post('/saveConnectivity', [App\Http\Controllers\organization\GeneralInfoController::class, 'saveConnectivity'])->name('saveConnectivity');
    Route::get('/getRoadTypeDropdown', [App\Http\Controllers\organization\GeneralInfoController::class, 'getRoadTypeDropdown'])->name('getRoadTypeDropdown');
    Route::get('/getElectricitySourceDropdown', [App\Http\Controllers\organization\GeneralInfoController::class, 'getElectricitySourceDropdown'])->name('getElectricitySourceDropdown');
    Route::get('/getElectricitySupplyDropdown', [App\Http\Controllers\organization\GeneralInfoController::class, 'getElectricitySupplyDropdown'])->name('getElectricitySupplyDropdown');
    Route::get('/getServiceProviderDropdown', [App\Http\Controllers\organization\GeneralInfoController::class, 'getServiceProviderDropdown'])->name('getServiceProviderDropdown');
    Route::get('/getServiceProviderDropdown1', [App\Http\Controllers\organization\GeneralInfoController::class, 'getServiceProviderDropdown1'])->name('getServiceProviderDropdown1');
    Route::get('/getContactTypeDropdown', [App\Http\Controllers\organization\GeneralInfoController::class, 'getContactTypeDropdown'])->name('getContactTypeDropdown');

    //location
    Route::post('/saveLocation', [App\Http\Controllers\organization\GeneralInfoController::class, 'saveLocation'])->name('saveLocation');
    Route::get('/getDisasterListInCheckbox', [App\Http\Controllers\organization\GeneralInfoController::class, 'getDisasterListInCheckbox'])->name('getDisasterListInCheckbox');

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
    
    Route::post('/saveKitchenStatus', [App\Http\Controllers\organization\StructuralController::class, 'saveKitchenStatus'])->name('saveKitchenStatus');
    Route::get('/loadKitchenStatus', [App\Http\Controllers\organization\StructuralController::class, 'loadKitchenStatus'])->name('loadKitchenStatus');
    Route::post('/saveFoodStoreStatus', [App\Http\Controllers\organization\StructuralController::class, 'saveFoodStoreStatus'])->name('saveFoodStoreStatus');
    Route::post('/saveUtensilKitchen', [App\Http\Controllers\organization\StructuralController::class, 'saveUtensilKitchen'])->name('saveUtensilKitchen');
    Route::post('/saveDinningHall', [App\Http\Controllers\organization\StructuralController::class, 'saveDinningHall'])->name('saveDinningHall');
    Route::get('/loadFoodStoreStatus', [App\Http\Controllers\organization\StructuralController::class, 'loadFoodStoreStatus'])->name('loadFoodStoreStatus');
    Route::get('/loadUtensilKitchenStatus', [App\Http\Controllers\organization\StructuralController::class, 'loadUtensilKitchenStatus'])->name('loadUtensilKitchenStatus');

    // infrastructure route
    Route::post('/saveInfrastructure', [App\Http\Controllers\organization\StructuralController::class, 'saveInfrastructure'])->name('saveInfrastructure');
    Route::get('/getCategoryInDropdown', [App\Http\Controllers\organization\StructuralController::class, 'getCategoryInDropdown'])->name('getCategoryInDropdown');
    Route::get('/getSubCategoryDropdown/{categoryId}', [App\Http\Controllers\organization\StructuralController::class, 'getSubCategoryDropdown'])->name('getSubCategoryDropdown');
    Route::get('/getStructureFacilityInDropdown', [App\Http\Controllers\organization\StructuralController::class, 'getStructureFacilityInDropdown'])->name('getStructureFacilityInDropdown');
    Route::get('/loadInfrastructureList', [App\Http\Controllers\organization\StructuralController::class, 'loadInfrastructureList'])->name('loadInfrastructureList');
    Route::get('/getDesignerDropdown', [App\Http\Controllers\organization\StructuralController::class, 'getDesignerDropdown'])->name('getDesignerDropdown');

    // establishment route
    Route::get('/getLevelInDropdown', [App\Http\Controllers\organization\EstablishmentController::class, 'getLevelInDropdown'])->name('getLeveInDropdown');
    Route::get('/getLocationInDropdown', [App\Http\Controllers\organization\EstablishmentController::class, 'getLocationInDropdown'])->name('getLocationInDropdown');
    Route::post('/saveEstablishment', [App\Http\Controllers\organization\EstablishmentController::class, 'saveEstablishment'])->name('saveEstablishment');
    Route::post('/saveClassStream', [App\Http\Controllers\organization\EstablishmentController::class, 'saveClassStream'])->name('saveClassStream');
    Route::get('/getClass', [App\Http\Controllers\organization\EstablishmentController::class, 'getClass'])->name('getClass');
    Route::get('/getStream', [App\Http\Controllers\organization\EstablishmentController::class, 'getStream'])->name('getStream');
    Route::get('/loadOrganizationDetails', [App\Http\Controllers\organization\EstablishmentController::class, 'loadOrganizationDetails'])->name('loadOrganizationDetails');
    Route::get('/loadEstbDetailsForVerification/{appNo}/{type}', [App\Http\Controllers\organization\EstablishmentController::class, 'loadEstbDetailsForVerification'])->name('loadEstbDetailsForVerification');
    Route::post('/updateNewEstablishmentApplication', [App\Http\Controllers\organization\EstablishmentController::class, 'updateNewEstablishmentApplication'])->name('updateNewEstablishmentApplication');
    Route::get('/loadProprietorDetails', [App\Http\Controllers\organization\EstablishmentController::class, 'loadProprietorDetails'])->name('loadProprietorDetails');
    Route::get('/loadApprovedOrgs', [App\Http\Controllers\organization\EstablishmentController::class, 'loadApprovedOrgs'])->name('loadApprovedOrgs');
    Route::get('/getApprovedOrgDetails/{type}/{key}', [App\Http\Controllers\organization\EstablishmentController::class, 'getApprovedOrgDetails'])->name('getApprovedOrgDetails');
    Route::post('/registerOrganizationDetails', [App\Http\Controllers\organization\EstablishmentController::class, 'registerOrganizationDetails'])->name('registerOrganizationDetails');
    Route::get('/getschoolDetials', [App\Http\Controllers\organization\EstablishmentController::class, 'getschoolDetials'])->name('getschoolDetials');
    Route::get('/getFullSchoolDetials/{id}', [App\Http\Controllers\organization\EstablishmentController::class, 'getFullSchoolDetials'])->name('getFullSchoolDetials');
    Route::get('/checkPendingApplication/{type}', [App\Http\Controllers\organization\EstablishmentController::class, 'checkPendingApplication'])->name('checkPendingApplication');
    
    // head quater office route
    Route::post('/saveBasicDetails', [App\Http\Controllers\organization\EstablishmentController::class, 'saveBasicDetails'])->name('saveBasicDetails');
    Route::post('/saveContactDetails', [App\Http\Controllers\organization\EstablishmentController::class, 'saveContactDetails'])->name('saveContactDetails');
    Route::get('/loadBasicDetails', [App\Http\Controllers\organization\EstablishmentController::class, 'loadBasicDetails'])->name('loadBasicDetails');
    Route::get('/getsAgencyList', [App\Http\Controllers\organization\EstablishmentController::class, 'getsAgencyList'])->name('getsAgencyList');
    Route::get('/getHeadQuarterDetails/{id}', [App\Http\Controllers\organization\EstablishmentController::class, 'getHeadQuarterDetails'])->name('getHeadQuarterDetails');
    
    // Change Basic route
    Route::post('/saveChangeBasicDetails', [App\Http\Controllers\organization\RestructuringController::class, 'saveChangeBasicDetails'])->name('saveChangeBasicDetails');
    Route::post('/saveChangeClass', [App\Http\Controllers\organization\RestructuringController::class, 'saveChangeClass'])->name('saveChangeClass');
    Route::get('/loadCurrentOrgDetails/{orgId}', [App\Http\Controllers\organization\RestructuringController::class, 'loadCurrentOrgDetails'])->name('loadCurrentOrgDetails');
    Route::get('/loadCurrentProprietorDetails/{orgId}', [App\Http\Controllers\organization\RestructuringController::class, 'loadCurrentProprietorDetails'])->name('loadCurrentProprietorDetails');
    Route::get('/getCurrentClass', [App\Http\Controllers\organization\RestructuringController::class, 'getCurrentClass'])->name('getCurrentClass');
    Route::get('/getCurrentStream', [App\Http\Controllers\organization\RestructuringController::class, 'getCurrentStream'])->name('getCurrentStream');
    Route::get('/getApplicationNo', [App\Http\Controllers\organization\RestructuringController::class, 'getApplicationNo'])->name('getApplicationNo');
    Route::get('/loadChangeDetailForVerification/{appNo}/{type}', [App\Http\Controllers\organization\RestructuringController::class, 'loadChangeDetailForVerification'])->name('loadChangeDetailForVerification');
    Route::get('/loadPriviousOrgDetails/{orgId}', [App\Http\Controllers\organization\RestructuringController::class, 'loadPriviousOrgDetails'])->name('loadPriviousOrgDetails');
    Route::post('/updateChangeBasicDetailApplication', [App\Http\Controllers\organization\RestructuringController::class, 'updateChangeBasicDetailApplication'])->name('updateChangeBasicDetailApplication');

    // merger route
    Route::get('/getOrgList', [App\Http\Controllers\organization\RestructuringController::class, 'getOrgList'])->name('getOrgList');
    Route::post('/saveMerger', [App\Http\Controllers\organization\RestructuringController::class, 'saveMerger'])->name('saveMerger');
    Route::get('/loadMergerForVerification/{appNo}/{type}', [App\Http\Controllers\organization\RestructuringController::class, 'loadMergerForVerification'])->name('loadMergerForVerification');
    Route::post('/updateMergerApplication', [App\Http\Controllers\organization\RestructuringController::class, 'updateMergerApplication'])->name('updateMergerApplication');
    
    // closure route
    Route::post('/saveClosure', [App\Http\Controllers\organization\RestructuringController::class, 'saveClosure'])->name('saveClosure');
    Route::get('/loadClosureList', [App\Http\Controllers\organization\RestructuringController::class, 'loadOrganizationDetails'])->name('loadOrganizationDetails');

    // bifurcation route
    Route::post('/saveBifurcation', [App\Http\Controllers\organization\RestructuringController::class, 'saveBifurcation'])->name('saveBifurcation');
    // Route::get('/loadBifurcation', [App\Http\Controllers\organization\RestructuringController::class, 'loadOrganizationDetails'])->name('loadOrganizationDetails');
    Route::get('/loadbifurcationForVerification/{appNo}/{type}', [App\Http\Controllers\organization\RestructuringController::class, 'loadbifurcationForVerification'])->name('loadbifurcationForVerification');
    Route::post('/updateBifurcationApplication', [App\Http\Controllers\organization\RestructuringController::class, 'updateBifurcationApplication'])->name('updateBifurcationApplication');
    
});

Route::prefix('staff')->group(function () {
    Route::post('/savePersonalDetails', [App\Http\Controllers\staff\StaffController::class, 'savePersonalDetails'])->name('savePersonalDetails');
    Route::get('/loaddraftpersonalDetails/{type}', [App\Http\Controllers\staff\StaffController::class, 'loaddraftpersonalDetails'])->name('loaddraftpersonalDetails');
    Route::get('/loadpersonalDetails/{id}', [App\Http\Controllers\staff\StaffController::class, 'loadpersonalDetails'])->name('loadpersonalDetails');
    
    Route::post('/savequalificationDetails', [App\Http\Controllers\staff\StaffController::class, 'savequalificationDetails'])->name('savequalificationDetails');
    Route::get('/loadQualification/{staff_id}', [App\Http\Controllers\staff\StaffController::class, 'loadQualification'])->name('loadQualification');
    Route::get('/loadStaffQualification/{staff_id}', [App\Http\Controllers\staff\StaffController::class, 'loadStaffQualification'])->name('loadStaffQualification');
    
    Route::post('/savenominationDetails', [App\Http\Controllers\staff\StaffController::class, 'savenominationDetails'])->name('savenominationDetails');
    Route::get('/loadNominations/{staff_id}', [App\Http\Controllers\staff\StaffController::class, 'loadNominations'])->name('loadNominations');
    Route::get('/loadStaffNomination/{staff_id}', [App\Http\Controllers\staff\StaffController::class, 'loadStaffNomination'])->name('loadStaffNomination');

    Route::post('/updatefinalstaffDetails', [App\Http\Controllers\staff\StaffController::class, 'updatefinalstaffDetails'])->name('updatefinalstaffDetails');
    Route::post('/updatefinalPrivatestaffDetails', [App\Http\Controllers\staff\StaffController::class, 'updatefinalPrivatestaffDetails'])->name('updatefinalPrivatestaffDetails');
    
    Route::get('/loadAllStaff/{type}', [App\Http\Controllers\staff\StaffController::class, 'loadAllStaff'])->name('loadAllStaff');

    Route::get('/loadStaff', [App\Http\Controllers\staff\StaffController::class, 'loadStaff'])->name('loadStaff');

    Route::post('/saveTransferWindow', [App\Http\Controllers\staff\StaffController::class, 'saveTransferWindow'])->name('saveTransferWindow');
    Route::get('/loadTransferWindow', [App\Http\Controllers\staff\StaffController::class, 'loadTransferWindow'])->name('loadTransferWindow');
    
    Route::get('/getRoles/{param}', [App\Http\Controllers\staff\HrDevelopmentController::class, 'getRoles'])->name('loadTrangetRolessferWindow');
    Route::post('/saveprogramDetails', [App\Http\Controllers\staff\HrDevelopmentController::class, 'saveprogramDetails'])->name('saveprogramDetails');
    Route::get('/loadDraftDetails', [App\Http\Controllers\staff\HrDevelopmentController::class, 'loadDraftDetails'])->name('loadDraftDetails');
    Route::post('/saveprogramFinalDetails', [App\Http\Controllers\staff\HrDevelopmentController::class, 'saveprogramFinalDetails'])->name('saveprogramFinalDetails');
    
});
Route::prefix('common')->group(function () {
    Route::get('/viewFiles/{full_path}', [App\Http\Controllers\CommonController::class, 'viewFiles'])->name('viewFiles');
    Route::get('/deleteFile/{full_path}/{id}', [App\Http\Controllers\CommonController::class, 'deleteFile'])->name('deleteFile');
    Route::get('/getApplicationDetials/{applicationId}', [App\Http\Controllers\CommonController::class, 'getApplicationDetials'])->name('getApplicationDetials');
    Route::get('/getTaskList/{type}', [App\Http\Controllers\CommonController::class, 'getTaskList'])->name('getTaskList');
    Route::get('/getSessionDetail', [App\Http\Controllers\CommonController::class, 'getSessionDetail'])->name('getSessionDetail');
    Route::get('/getDzoNameById/{id}', [App\Http\Controllers\CommonController::class, 'getDzoNameById'])->name('getDzoNameById');
    Route::get('/getGewogNameById/{id}', [App\Http\Controllers\CommonController::class, 'getGewogNameById'])->name('getGewogNameById');
});

Route::prefix('students')->group(function () {
    Route::post('/saveStdResponsibility', [App\Http\Controllers\student\GeneralInfoController::class, 'saveStdResponsibility'])->name('saveStdResponsibility');
    Route::get('/loadStdResponsibility', [App\Http\Controllers\student\GeneralInfoController::class, 'loadStdResponsibility'])->name('loadStdResponsibility');
    
    
}); 
 
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/getpersonbycid/{cid}', [App\Http\Controllers\AdministrationController::class, 'getpersonbycid'])->name('getpersonbycid');






