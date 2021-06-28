<?php
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
Route::get('/select_system', [App\Http\Controllers\HomeController::class, 'select_system'])->name('select_system');
Route::get('/get_screens_on_submodules/{type}/{id}', [App\Http\Controllers\HomeController::class, 'get_screens_on_submodules'])->name('get_screens_on_submodules');
Route::get('/get_privileges/{id}', [App\Http\Controllers\HomeController::class, 'get_privileges'])->name('get_privileges');



Route::prefix('masters')->group(function () {
    Route::post('/saveGlobalMasters', [App\Http\Controllers\AdministrationController::class, 'saveGlobalMasters'])->name('saveGlobalMasters');
    Route::get('/loadGlobalMasters/{param}', [App\Http\Controllers\AdministrationController::class, 'loadGlobalMasters'])->name('loadGlobalMasters');
    Route::get('/getroles/{param}', [App\Http\Controllers\AdministrationController::class, 'getroles'])->name('getroles');
    Route::get('/all_active_dropdowns/{model}/{parent_id}', [App\Http\Controllers\AdministrationController::class, 'all_active_dropdowns'])->name('all_active_dropdowns');
    Route::post('/saveStaffMasters', [App\Http\Controllers\AdministrationController::class, 'saveStaffMasters'])->name('saveStaffMasters');
    Route::get('/loadStaffMasters/{param}', [App\Http\Controllers\AdministrationController::class, 'loadStaffMasters'])->name('loadStaffMasters');
    Route::get('/loadStaffDropdownMasters/{model}/{parent_id}', [App\Http\Controllers\AdministrationController::class, 'loadStaffDropdownMasters'])->name('loadStaffDropdownMasters');
    Route::post('/saveHrDevelopmentMasters', [App\Http\Controllers\staff\HrDevelopmentMastersController::class, 'saveHrDevelopmentMasters'])->name('saveHrDevelopmentMasters');
    Route::get('/loadHrDevelopmentMastersData/{type}', [App\Http\Controllers\staff\HrDevelopmentMastersController::class, 'loadHrDevelopmentMastersData'])->name('loadHrDevelopmentMastersData');
    Route::get('/loadHrDevelopmentDepedentMastersData/{model}/{parent_id}', [App\Http\Controllers\staff\HrDevelopmentMastersController::class, 'loadHrDevelopmentDepedentMastersData'])->name('loadHrDevelopmentDepedentMastersData');
    Route::post('/saveDzongkhag', [App\Http\Controllers\AdministrationController::class, 'saveDzongkhag'])->name('savedzongkhag');
    Route::get('/loadalldzongkhag', [App\Http\Controllers\AdministrationController::class, 'loadalldzongkhag'])->name('loadalldzongkhag');

    Route::post('/saveLeaveConfigMasters', [App\Http\Controllers\AdministrationController::class, 'saveLeaveConfigMasters'])->name('saveLeaveConfigMasters');
    Route::post('/saveTransferConfigMasters', [App\Http\Controllers\AdministrationController::class, 'saveTransferConfigMasters'])->name('saveTransferConfigMasters');
    Route::get('/loadLeaveConfigMasters/{type}/{submitter}', [App\Http\Controllers\AdministrationController::class, 'loadLeaveConfigMasters'])->name('loadLeaveConfigMasters');
    Route::get('/loadAllLeaveConfigMasters', [App\Http\Controllers\AdministrationController::class, 'loadAllLeaveConfigMasters'])->name('loadAllLeaveConfigMasters');
    Route::get('/loadLeaveConfigDetails/{id}', [App\Http\Controllers\AdministrationController::class, 'loadLeaveConfigDetails'])->name('loadLeaveConfigDetails');
    Route::post('/saveLocation', [App\Http\Controllers\AdministrationController::class, 'saveLocation'])->name('saveLocation');
    Route::get('/loadLocation', [App\Http\Controllers\AdministrationController::class, 'loadLocation'])->name('loadLocation');

    Route::prefix('organizationMasterController')->group(function (){
        Route::post('/saveOrganizationMaster', [App\Http\Controllers\organization\OrganizationMasterController::class, 'saveOrganizationMaster'])->name('saveOrganizationMaster');
        Route::get('/loadFinacialtype', [App\Http\Controllers\organization\OrganizationMasterController::class, 'loadFinacialtype'])->name('loadFinacialtype');
        Route::get('/loadincomeList', [App\Http\Controllers\organization\OrganizationMasterController::class, 'loadincomeList'])->name('loadincomeList');
        Route::get('/loadOrganizaitonmasters/{type}/{model}', [App\Http\Controllers\organization\OrganizationMasterController::class, 'loadOrganizaitonmasters'])->name('loadOrganizaitonmasters');

    });

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

    //new Routes for furniture
    Route::post('/saveFurnitureType', [App\Http\Controllers\AdministrationController::class, 'saveFurnitureType'])->name('saveFurnitureType');
    Route::get('/loadFurnitureType', [App\Http\Controllers\AdministrationController::class, 'loadFurnitureType'])->name('loadFurnitureType');

    Route::post('/saveFurnitureItem', [App\Http\Controllers\AdministrationController::class, 'saveFurnitureItem'])->name('saveFurnitureItem');
    Route::get('/loadFurnitureItem', [App\Http\Controllers\AdministrationController::class, 'loadFurnitureItem'])->name('loadFurnitureItem');
    Route::get('/getFurnitureTypeDropdown', [App\Http\Controllers\AdministrationController::class, 'getFurnitureTypeDropdown'])->name('getFurnitureTypeDropdown');

    Route::post('/saveFurnitureUsage', [App\Http\Controllers\AdministrationController::class, 'saveFurnitureUsage'])->name('saveFurnitureUsage');
    Route::get('/loadFurnitureUsage', [App\Http\Controllers\AdministrationController::class, 'loadFurnitureUsage'])->name('loadFurnitureUsage');

    Route::get('/loadEquipmentUsage', [App\Http\Controllers\AdministrationController::class, 'loadEquipmentUsage'])->name('loadEquipmentUsage');
    Route::post('/saveEquipmentUsage', [App\Http\Controllers\AdministrationController::class, 'saveEquipmentUsage'])->name('saveEquipmentUsage');


    Route::post('/saveSportFacility', [App\Http\Controllers\AdministrationController::class, 'saveSportFacility'])->name('saveSportFacility');
    Route::get('/loadSportFacility', [App\Http\Controllers\AdministrationController::class, 'loadSportFacility'])->name('loadSportFacility');

    Route::post('/saveSportFacilitySubtype', [App\Http\Controllers\AdministrationController::class, 'saveSportFacilitySubtype'])->name('saveSportFacilitySubtype');
    Route::get('/loadSportFacilitySubtype', [App\Http\Controllers\AdministrationController::class, 'loadSportFacilitySubtype'])->name('loadSportFacilitySubtype');

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
    Route::get('/getClassStream', [App\Http\Controllers\AdministrationController::class, 'getClassStream'])->name('getClassStream');

    Route::post('/saveClassStreamMapping', [App\Http\Controllers\AdministrationController::class, 'saveClassStreamMapping'])->name('saveClassStreamMapping');
    Route::get('/loadClassStreamMapping/{type}', [App\Http\Controllers\AdministrationController::class, 'loadClassStreamMapping'])->name('loadClassStreamMapping');

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

    Route::post('/saveAttachment', [App\Http\Controllers\AdministrationController::class, 'saveAttachment'])->name('saveAttachment');
    Route::get('/loadAttachment', [App\Http\Controllers\AdministrationController::class, 'loadAttachment'])->name('loadAttachment');

    Route::post('/saveDisasterCommittee', [App\Http\Controllers\AdministrationController::class, 'saveDisasterCommittee'])->name('saveDisasterCommittee');
    Route::get('/loadDisasterComm', [App\Http\Controllers\AdministrationController::class, 'loadDisasterComm'])->name('loadDisasterComm');

    Route::post('/saveEccdFacility', [App\Http\Controllers\AdministrationController::class, 'saveEccdFacility'])->name('saveEccdFacility');
    Route::get('/getEccdStructureType', [App\Http\Controllers\AdministrationController::class, 'getEccdStructureType'])->name('getEccdStructureType');
    Route::get('/loadEccdFacilityList', [App\Http\Controllers\AdministrationController::class, 'loadEccdFacilityList'])->name('loadEccdFacilityList');

    //Student Masters
    Route::post('/saveStudentMasters', [App\Http\Controllers\student\StudentMasterController::class, 'saveStudentMasters'])->name('saveStudentMasters');

    Route::get('/loadStudentMasters/{param}', [App\Http\Controllers\student\StudentMasterController::class, 'loadStudentMasters'])->name('loadStudentMasters');
    Route::get('/loadActiveStudentMasters/{param}', [App\Http\Controllers\student\StudentMasterController::class, 'loadActiveStudentMasters'])->name('loadActiveStudentMasters');
    Route::get('/allActiveStudentDropdowns/{model}/{parent_id}', [App\Http\Controllers\student\StudentMasterController::class, 'allActiveStudentDropdowns'])->name('allActiveStudentDropdowns');
    //GET Scout Section
    Route::get('/getScoutSection', [App\Http\Controllers\student\StudentMasterController::class, 'getScoutSection'])->name('');
    //Get Scouts Section Level By Scouts Section Level
    Route::get('/getScoutSectionLevel/{scoutSectionId}', [App\Http\Controllers\student\StudentMasterController::class, 'getScoutSectionLevel'])->name('getScoutSectionLevel');

    Route::post('/saveValidationcondition', [App\Http\Controllers\student\StudentMasterController::class, 'saveValidationcondition'])->name('saveValidationcondition');
    Route::get('/loadValidationcondition', [App\Http\Controllers\student\StudentMasterController::class, 'loadValidationcondition'])->name('loadValidationcondition');


    // Academic Master
    Route::post('/saveAcademicMasters', [App\Http\Controllers\AdministrationController::class, 'saveAcademicMasters'])->name('saveAcademicMasters');
    Route::get('/loadAcademicMasters/{param}', [App\Http\Controllers\AdministrationController::class, 'loadAcademicMasters'])->name('loadAcademicMasters');
    Route::get('/loadClassSubject/{class_id}/{stream_id?}', [App\Http\Controllers\AdministrationController::class, 'loadClassSubject'])->name('loadClassSubject');
    Route::get('/allActiveDropdowns/{model}/{parent_id}', [App\Http\Controllers\AdministrationController::class, 'allActiveDropdowns'])->name('allActiveAropdowns');
    Route::post('/saveClassSubject', [App\Http\Controllers\AdministrationController::class, 'saveClassSubject'])->name('saveClassSubject');
    Route::post('/saveAssessmentFrequency', [App\Http\Controllers\AdministrationController::class, 'saveAssessmentFrequency'])->name('saveAssessmentFrequency');
    Route::get('/getClassAssessmentFrequency', [App\Http\Controllers\AdministrationController::class, 'getClassAssessmentFrequency'])->name('getClassAssessmentFrequency');
    Route::get('/loadclassSubAssmtFrequency', [App\Http\Controllers\AdministrationController::class, 'loadclassSubAssmtFrequency'])->name('loadclassSubAssmtFrequency');
    Route::get('/loadclassSubjectAssessment/{term_id}/{sub_id}/{class_id}/{stream_id?}', [App\Http\Controllers\AdministrationController::class, 'loadclassSubjectAssessment'])->name('loadclassSubjectAssessment');
    Route::post('/saveclassSubjectAssessment', [App\Http\Controllers\AdministrationController::class, 'saveclassSubjectAssessment'])->name('saveclassSubjectAssessment');
});

    //Mess Manage Master
Route::post('/saveQuater', [App\Http\Controllers\AdministrationController::class, 'saveQuater'])->name('saveQuater');
Route::get('/loadQuater', [App\Http\Controllers\AdministrationController::class, 'loadQuater'])->name('loadQuater');

Route::prefix('organization')->group(function () {
    /** general information route  */
    Route::post('/saveSection', [App\Http\Controllers\organization\GeneralInfoController::class, 'saveSection'])->name('saveSection');
    Route::get('/getClassByOrganizationId/{orgId}', [App\Http\Controllers\organization\GeneralInfoController::class, 'getClassByOrganizationId'])->name('getClassByOrganizationId');
    Route::get('/getStreamByClassId/{classId}', [App\Http\Controllers\organization\GeneralInfoController::class, 'getStreamByClassId'])->name('getStreamByClassId');
    Route::get('/getExistingSectionByClass/{classId}', [App\Http\Controllers\organization\GeneralInfoController::class, 'getExistingSectionByClass'])->name('getExistingSectionByClass');

    Route::post('/saveClassMapping', [App\Http\Controllers\organization\GeneralInfoController::class, 'saveClassMapping'])->name('saveClassMapping');
    Route::get('/loadOrganizationByDzoId/{dzo_id}', [App\Http\Controllers\organization\GeneralInfoController::class, 'loadOrganizationByDzoId'])->name('loadOrganizationByDzoId');
    Route::get('/getCurrentClassStream/{school_id}', [App\Http\Controllers\organization\GeneralInfoController::class, 'getCurrentClassStream'])->name('getCurrentClassStream');

    //routes for furniture
    Route::post('/saveFurniture', [App\Http\Controllers\organization\FurnitureController::class, 'saveFurniture'])->name('saveFurniture');
    Route::get('/loadFurniture', [App\Http\Controllers\organization\FurnitureController::class, 'loadFurniture'])->name('loadFurniture');
    Route::get('/getFurnitureDetails/{furId}', [App\Http\Controllers\organization\FurnitureController::class, 'getFurnitureDetails'])->name('getFurnitureDetails');

    //routes for visitor information
    Route::post('/saveVisitorInformation', [App\Http\Controllers\organization\VisitorController::class, 'saveVisitorInformation'])->name('saveVisitorInformation');
    Route::get('/loadVisitorInformation', [App\Http\Controllers\organization\VisitorController::class, 'loadVisitorInformation'])->name('loadVisitorInformation');
    Route::get('/getVisitorTypeDropdown', [App\Http\Controllers\organization\VisitorController::class, 'getVisitorTypeDropdown'])->name('getVisitorTypeDropdown');
    Route::get('/getVisitorDetails/{visId}', [App\Http\Controllers\organization\VisitorController::class, 'getVisitorDetails'])->name('getVisitorDetails');

    //routes for projections
    Route::post('/saveProjections', [App\Http\Controllers\organization\ProjectionsController::class, 'saveProjections'])->name('saveProjections');
    Route::get('/loadProjections', [App\Http\Controllers\organization\ProjectionsController::class, 'loadProjections'])->name('loadProjections');

    //routes for disasters information
 //   Route::post('/saveDisasterInformation', [App\Http\Controllers\organization\DisasterController::class, 'saveDisasterInformation'])->name('saveDisasterInformation');


    //route for income
    Route::post('/saveIncomeInformation', [App\Http\Controllers\organization\FinanceController::class, 'saveIncomeInformation'])->name('saveIncomeInformation');
    Route::get('/loadIncomeInformation', [App\Http\Controllers\organization\FinanceController::class, 'loadIncomeInformation'])->name('loadIncomeInformation');

    //routes for financial information saveFinancialInfo
    Route::post('/saveFinancialInformation', [App\Http\Controllers\organization\FinanceController::class, 'saveFinancialInformation'])->name('saveFinancialInformation');
    Route::post('/saveFinancialInfo', [App\Http\Controllers\organization\FinanceController::class, 'saveFinancialInfo'])->name('saveFinancialInfo');
    Route::post('/updateFinancialInfo', [App\Http\Controllers\organization\FinanceController::class, 'updateFinancialInfo'])->name('updateFinancialInfo');
    Route::post('/saveIncomeinfo', [App\Http\Controllers\organization\FinanceController::class, 'saveIncomeinfo'])->name('saveIncomeinfo');
    Route::post('/updateIncomeinfo', [App\Http\Controllers\organization\FinanceController::class, 'updateIncomeinfo'])->name('updateIncomeinfo');
    Route::get('/loadFinancialInformation', [App\Http\Controllers\organization\FinanceController::class, 'loadFinancialInformation'])->name('loadFinancialInformation');


    //connectivity
    Route::post('/saveConnectivity', [App\Http\Controllers\organization\GeneralInfoController::class, 'saveConnectivity'])->name('saveConnectivity');
    Route::get('/getRoadTypeDropdown', [App\Http\Controllers\organization\GeneralInfoController::class, 'getRoadTypeDropdown'])->name('getRoadTypeDropdown');
    Route::get('/getElectricitySourceDropdown', [App\Http\Controllers\organization\GeneralInfoController::class, 'getElectricitySourceDropdown'])->name('getElectricitySourceDropdown');
    Route::get('/getElectricitySupplyDropdown', [App\Http\Controllers\organization\GeneralInfoController::class, 'getElectricitySupplyDropdown'])->name('getElectricitySupplyDropdown');
    Route::get('/getServiceProviderDropdown', [App\Http\Controllers\organization\GeneralInfoController::class, 'getServiceProviderDropdown'])->name('getServiceProviderDropdown');
    Route::get('/getServiceProviderDropdown1', [App\Http\Controllers\organization\GeneralInfoController::class, 'getServiceProviderDropdown1'])->name('getServiceProviderDropdown1');
    Route::get('/getContactTypeDropdown', [App\Http\Controllers\organization\GeneralInfoController::class, 'getContactTypeDropdown'])->name('getContactTypeDropdown');


    //new connectivity Route
    Route::post('/saveConnectivityDetails', [App\Http\Controllers\organization\ConnectivityController::class, 'saveConnectivityDetails'])->name('saveConnectivityDetails');
    Route::get('/loadConnectivityInformation/{org_id}', [App\Http\Controllers\organization\ConnectivityController::class, 'loadConnectivityInformation'])->name('loadConnectivityInformation');

    //location
    Route::post('/saveLocation', [App\Http\Controllers\organization\GeneralInfoController::class, 'saveLocation'])->name('saveLocation');
    Route::get('/getLocationDetails', [App\Http\Controllers\organization\GeneralInfoController::class, 'getLocationDetails'])->name('getLocationDetails');
    Route::get('/getDisasterListInCheckbox', [App\Http\Controllers\organization\GeneralInfoController::class, 'getDisasterListInCheckbox'])->name('getDisasterListInCheckbox');

    // equipment route
    // Route::post('/saveEquipment', [App\Http\Controllers\organization\GeneralInfoController::class, 'saveEquipment'])->name('saveEquipment');
    Route::get('/getEquipmentDetails/{equId}', [App\Http\Controllers\organization\EquipmentController::class, 'getEquipmentDetails'])->name('getEquipmentDetails');
    Route::post('/saveEquipment', [App\Http\Controllers\organization\EquipmentController::class, 'saveEquipment'])->name('saveEquipment');
    Route::get('/loadEquipment', [App\Http\Controllers\organization\EquipmentController::class, 'loadEquipment'])->name('loadEquipment');
    Route::get('/getType', [App\Http\Controllers\organization\GeneralInfoController::class, 'getType'])->name('getType');
    Route::get('/getItem/{typeId}', [App\Http\Controllers\organization\GeneralInfoController::class, 'getItem'])->name('getItem');
    Route::get('/getLocationUse', [App\Http\Controllers\organization\GeneralInfoController::class, 'getLocationUse'])->name('getLocationUse');

    Route::get('/getFurnitureType', [App\Http\Controllers\organization\GeneralInfoController::class, 'getFurnitureType'])->name('getFurnitureType');
    Route::get('/getFurnitureItem/{itemId}', [App\Http\Controllers\organization\GeneralInfoController::class, 'getFurnitureItem'])->name('getFurnitureItem');
    Route::get('/getFurnitureUse', [App\Http\Controllers\organization\GeneralInfoController::class, 'getFurnitureUse'])->name('getFurnitureUse');

    Route::post('/udpateOrgProfile', [App\Http\Controllers\organization\GeneralInfoController::class, 'udpateOrgProfile'])->name('udpateOrgProfile');
    Route::get('/getOrgProfile/{id}', [App\Http\Controllers\organization\GeneralInfoController::class, 'getOrgProfile'])->name('getOrgProfile');
    Route::post('/updateOrgBasicDetials', [App\Http\Controllers\organization\GeneralInfoController::class, 'updateOrgBasicDetials'])->name('updateOrgBasicDetials');
    Route::post('/updateSenDetials', [App\Http\Controllers\organization\GeneralInfoController::class, 'updateSenDetials'])->name('updateSenDetials');
    Route::post('/updateBasicDetails', [App\Http\Controllers\organization\GeneralInfoController::class, 'updateBasicDetails'])->name('updateBasicDetails');
    Route::get('/loadSeenDetailsByOrgId/{orgId}', [App\Http\Controllers\organization\GeneralInfoController::class, 'loadSeenDetailsByOrgId'])->name('loadSeenDetailsByOrgId');

    /** structural facility route */
    Route::post('/saveSport', [App\Http\Controllers\organization\StructuralController::class, 'saveSport'])->name('saveSport');
    Route::post('/saveEccd', [App\Http\Controllers\organization\StructuralController::class, 'saveEccd'])->name('saveEccd');
    Route::get('/loadSport/{orgId}', [App\Http\Controllers\organization\StructuralController::class, 'loadSport'])->name('loadSport');
    Route::get('/loadeccd/{orgId}', [App\Http\Controllers\organization\StructuralController::class, 'loadeccd'])->name('loadeccd');
    Route::get('/getFacilityInDropdown', [App\Http\Controllers\organization\StructuralController::class, 'getFacilityInDropdown'])->name('getFacilityInDropdown');
    Route::get('/getSupportInDropdown', [App\Http\Controllers\organization\StructuralController::class, 'getSupportInDropdown'])->name('getSupportInDropdown');
    Route::get('/getSubFacilityDropdown/{facilityId}', [App\Http\Controllers\organization\StructuralController::class, 'getSubFacilityDropdown'])->name('getSubFacilityDropdown');

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
    Route::get('/loadInfrastructureList/{orgId}', [App\Http\Controllers\organization\StructuralController::class, 'loadInfrastructureList'])->name('loadInfrastructureList');
    Route::get('/getDesignerDropdown', [App\Http\Controllers\organization\StructuralController::class, 'getDesignerDropdown'])->name('getDesignerDropdown');
    Route::get('/getInfrastructureDetails/{infraId}', [App\Http\Controllers\organization\StructuralController::class, 'getInfrastructureDetails'])->name('getInfrastructureDetails');
    Route::prefix('structural')->group(function () {
        Route::post('/saveWashFeeding', [App\Http\Controllers\organization\StructuralController::class, 'saveWashFeeding'])->name('saveWashFeeding');
        Route::get('/getWashFeeding/{type}', [App\Http\Controllers\organization\StructuralController::class, 'getWashFeeding'])->name('getWashFeeding');

    });
    //eccd Infrastructure
    Route::post('/saveEccdInfrastructure', [App\Http\Controllers\organization\StructuralController::class, 'saveEccdInfrastructure'])->name('saveEccdInfrastructure');
    Route::get('/loadEccdInfrastructureList/{orgId}', [App\Http\Controllers\organization\StructuralController::class, 'loadEccdInfrastructureList'])->name('loadEccdInfrastructureList');
    Route::get('/getStructureTypeInDropdown', [App\Http\Controllers\organization\StructuralController::class, 'getStructureTypeInDropdown'])->name('getStructureTypeInDropdown');
    Route::get('/geteccdStructureFacilityInDropdown/{structuretype}', [App\Http\Controllers\organization\StructuralController::class, 'geteccdStructureFacilityInDropdown'])->name('geteccdStructureFacilityInDropdown');
    Route::get('/getEccdInfrastructureDetails/{eccdinfraId}', [App\Http\Controllers\organization\StructuralController::class, 'getEccdInfrastructureDetails'])->name('getEccdInfrastructureDetails');

    // establishment route
    Route::get('/getLevelInDropdown', [App\Http\Controllers\organization\EstablishmentController::class, 'getLevelInDropdown'])->name('getLeveInDropdown');
    Route::get('/getLocationInDropdown', [App\Http\Controllers\organization\EstablishmentController::class, 'getLocationInDropdown'])->name('getLocationInDropdown');
    Route::post('/saveEstablishment', [App\Http\Controllers\organization\EstablishmentController::class, 'saveEstablishment'])->name('saveEstablishment');
    Route::get('/loadEstablishmentApplciaiton/{record_id}', [App\Http\Controllers\organization\EstablishmentController::class, 'loadEstablishmentApplciaiton'])->name('loadEstablishmentApplciaiton');
    Route::post('/saveUploadedFiles', [App\Http\Controllers\organization\EstablishmentController::class, 'saveUploadedFiles'])->name('saveUploadedFiles');
    Route::post('/saveClassStream', [App\Http\Controllers\organization\EstablishmentController::class, 'saveClassStream'])->name('saveClassStream');
    Route::get('/getClass', [App\Http\Controllers\organization\EstablishmentController::class, 'getClass'])->name('getClass');
    Route::get('/getStream', [App\Http\Controllers\organization\EstablishmentController::class, 'getStream'])->name('getStream');
    Route::get('/getClassMappingDetails/{mapping_id}', [App\Http\Controllers\organization\EstablishmentController::class, 'getClassMappingDetails'])->name('getClassMappingDetails');
    Route::get('/loadOrganizationDetails', [App\Http\Controllers\organization\EstablishmentController::class, 'loadOrganizationDetails'])->name('loadOrganizationDetails');
    Route::get('/loadEstbDetailsForVerification/{appNo}/{type}', [App\Http\Controllers\organization\EstablishmentController::class, 'loadEstbDetailsForVerification'])->name('loadEstbDetailsForVerification');
    Route::get('/loadEstbDetailsForView/{appNo}', [App\Http\Controllers\organization\EstablishmentController::class, 'loadEstbDetailsForView'])->name('loadEstbDetailsForView');

    Route::post('/updateNewEstablishmentApplication', [App\Http\Controllers\organization\EstablishmentController::class, 'updateNewEstablishmentApplication'])->name('updateNewEstablishmentApplication');
    Route::get('/loadProprietorDetails', [App\Http\Controllers\organization\EstablishmentController::class, 'loadProprietorDetails'])->name('loadProprietorDetails');
    Route::get('/loadOrgApplications/{type}', [App\Http\Controllers\organization\EstablishmentController::class, 'loadOrgApplications'])->name('loadOrgApplications');
    Route::get('/loadOrgChangeApplications/{type}', [App\Http\Controllers\organization\EstablishmentController::class, 'loadOrgChangeApplications'])->name('loadOrgChangeApplications');
    Route::get('/loadApprovedOrgs/{type}', [App\Http\Controllers\organization\EstablishmentController::class, 'loadApprovedOrgs'])->name('loadApprovedOrgs');
    Route::get('/getApprovedOrgDetails/{type}/{key}', [App\Http\Controllers\organization\EstablishmentController::class, 'getApprovedOrgDetails'])->name('getApprovedOrgDetails');
    Route::post('/registerOrganizationDetails', [App\Http\Controllers\organization\EstablishmentController::class, 'registerOrganizationDetails'])->name('registerOrganizationDetails');
    Route::get('/getschoolDetials', [App\Http\Controllers\organization\EstablishmentController::class, 'getschoolDetials'])->name('getschoolDetials');
    Route::get('/getschoolList/{dzoid}', [App\Http\Controllers\organization\EstablishmentController::class, 'getschoolList'])->name('getschoolList');
    Route::get('/getFullSchoolDetials/{id}', [App\Http\Controllers\organization\EstablishmentController::class, 'getFullSchoolDetials'])->name('getFullSchoolDetials');
    Route::get('/getClassByOrg/{id}', [App\Http\Controllers\organization\GeneralInfoController::class, 'getClassByOrg'])->name('getClassByOrg');
    Route::get('/checkPendingApplication/{type}', [App\Http\Controllers\organization\EstablishmentController::class, 'checkPendingApplication'])->name('checkPendingApplication');

    Route::get('/loaddraftApplication/{type}', [App\Http\Controllers\organization\EstablishmentController::class, 'loaddraftApplication'])->name('loaddraftApplication');

    /** used to populate and edit data in school list and Location page */
    Route::get('/getLocationDetails/{id}', [App\Http\Controllers\organization\EstablishmentController::class, 'getLocationDetails'])->name('getLocationDetails');
    /** used to populate and edit data in school list and Connectivity page */
    Route::get('/getConnectivityDetails/{id}', [App\Http\Controllers\organization\EstablishmentController::class, 'getConnectivityDetails'])->name('getConnectivityDetails');
    /** used to populate and edit data in school list and section page */
    Route::get('/getSectionDetails/{id}', [App\Http\Controllers\organization\EstablishmentController::class, 'getSectionDetails'])->name('getSectionDetails');

    // head quater office route
    Route::post('/saveBasicDetails', [App\Http\Controllers\organization\EstablishmentController::class, 'saveBasicDetails'])->name('saveBasicDetails');
    Route::get('/loadheadQuarterDetails/{id}', [App\Http\Controllers\organization\EstablishmentController::class, 'loadheadQuarterDetails'])->name('loadheadQuarterDetails');

    Route::post('/saveContactDetails', [App\Http\Controllers\organization\EstablishmentController::class, 'saveContactDetails'])->name('saveContactDetails');
    Route::get('/loadBasicDetails', [App\Http\Controllers\organization\EstablishmentController::class, 'loadBasicDetails'])->name('loadBasicDetails');
    Route::get('/getsAgencyList/{param}', [App\Http\Controllers\organization\EstablishmentController::class, 'getsAgencyList'])->name('getsAgencyList');
    Route::get('/getHeadQuarterDetails/{id}', [App\Http\Controllers\organization\EstablishmentController::class, 'getHeadQuarterDetails'])->name('getHeadQuarterDetails');

    // Change Basic route
    Route::post('/saveChangeBasicDetails', [App\Http\Controllers\organization\RestructuringController::class, 'saveChangeBasicDetails'])->name('saveChangeBasicDetails');
    Route::get('/getChangeBasicDetails/{appId}', [App\Http\Controllers\organization\RestructuringController::class, 'getChangeBasicDetails'])->name('getChangeBasicDetails');
    Route::post('/saveChangeClass', [App\Http\Controllers\organization\RestructuringController::class, 'saveChangeClass'])->name('saveChangeClass');
    Route::get('/loadCurrentOrgDetails/{orgId}', [App\Http\Controllers\organization\RestructuringController::class, 'loadCurrentOrgDetails'])->name('loadCurrentOrgDetails');
    Route::get('/loadCurrentProprietorDetails/{orgId}', [App\Http\Controllers\organization\RestructuringController::class, 'loadCurrentProprietorDetails'])->name('loadCurrentProprietorDetails');
    Route::get('/getCurrentClass', [App\Http\Controllers\organization\RestructuringController::class, 'getCurrentClass'])->name('getCurrentClass');
    Route::get('/getCurrentStream', [App\Http\Controllers\organization\RestructuringController::class, 'getCurrentStream'])->name('getCurrentStream');
    Route::get('/getApplicationNo', [App\Http\Controllers\organization\RestructuringController::class, 'getApplicationNo'])->name('getApplicationNo');
    Route::get('/loadChangeDetailForVerification/{appNo}/{type}', [App\Http\Controllers\organization\RestructuringController::class, 'loadChangeDetailForVerification'])->name('loadChangeDetailForVerification');
    Route::get('/loadPriviousOrgDetails/{orgId}', [App\Http\Controllers\organization\RestructuringController::class, 'loadPriviousOrgDetails'])->name('loadPriviousOrgDetails');
    Route::post('/updateChangeBasicDetailApplication', [App\Http\Controllers\organization\RestructuringController::class, 'updateChangeBasicDetailApplication'])->name('updateChangeBasicDetailApplication');
    Route::get('/deleteFile/{full_path}/{id}', [App\Http\Controllers\organization\RestructuringController::class, 'deleteFile'])->name('deleteFile');
    // merger route
    // Route::get('/getOrgList', [App\Http\Controllers\organization\RestructuringController::class, 'getOrgList'])->name('getOrgList');
    Route::post('/saveMerger', [App\Http\Controllers\organization\RestructuringController::class, 'saveMerger'])->name('saveMerger');
    Route::get('/loadMergerForVerification/{appNo}/{type}', [App\Http\Controllers\organization\RestructuringController::class, 'loadMergerForVerification'])->name('loadMergerForVerification');
    Route::post('/updateMergerApplication', [App\Http\Controllers\organization\RestructuringController::class, 'updateMergerApplication'])->name('updateMergerApplication');
    Route::get('/loadMergerApplications', [App\Http\Controllers\organization\EstablishmentController::class, 'loadMergerApplications'])->name('loadMergerApplications');

    // closure route
    Route::post('/saveClosure', [App\Http\Controllers\organization\RestructuringController::class, 'saveClosure'])->name('saveClosure');
    Route::get('/loadClosureList', [App\Http\Controllers\organization\RestructuringController::class, 'loadOrganizationDetails'])->name('loadOrganizationDetails');
    Route::get('/loadClosureApplicationDetails/{appNo}/{type}', [App\Http\Controllers\organization\RestructuringController::class, 'loadClosureApplicationDetails'])->name('loadClosureApplicationDetails');
    Route::get('/loadClosureForVerification/{appNo}/{type}', [App\Http\Controllers\organization\RestructuringController::class, 'loadClosureForVerification'])->name('loadClosureForVerification');
    Route::post('/updateClosureApplication', [App\Http\Controllers\organization\RestructuringController::class, 'updateClosureApplication'])->name('updateClosureApplication');
    Route::get('/loadClosureApplications', [App\Http\Controllers\organization\EstablishmentController::class, 'loadClosureApplications'])->name('loadClosureApplications');

    // bifurcation route
    Route::post('/saveBifurcation', [App\Http\Controllers\organization\RestructuringController::class, 'saveBifurcation'])->name('saveBifurcation');
    // Route::get('/loadBifurcation', [App\Http\Controllers\organization\RestructuringController::class, 'loadOrganizationDetails'])->name('loadOrganizationDetails');
    Route::get('/loadBifurcationForVerification/{appNo}/{type}', [App\Http\Controllers\organization\RestructuringController::class, 'loadBifurcationForVerification'])->name('loadbifurcationForVerification');
    Route::post('/updateBifurcationApplication', [App\Http\Controllers\organization\RestructuringController::class, 'updateBifurcationApplication'])->name('updateBifurcationApplication');
    Route::get('/loadBifurcationApplications', [App\Http\Controllers\organization\EstablishmentController::class, 'loadBifurcationApplications'])->name('loadBifurcationApplications');

    //Reopening Routes
    Route::post('/saveReopening', [App\Http\Controllers\organization\RestructuringController::class, 'saveReopening'])->name('saveReopening');
    Route::get('/loadReopeningApplications', [App\Http\Controllers\organization\EstablishmentController::class, 'loadReopeningApplications'])->name('loadReopeningApplications');
    Route::get('/loadReopeningForVerification/{appNo}/{type}', [App\Http\Controllers\organization\RestructuringController::class, 'loadReopeningForVerification'])->name('loadReopeningForVerification');
    Route::post('/updateReopeningApplication', [App\Http\Controllers\organization\RestructuringController::class, 'updateReopeningApplication'])->name('updateReopeningApplication');

    //Compound Details
    Route::post('/saveSchoolCompundDetails', [App\Http\Controllers\organization\CompoundDetailsController::class, 'saveSchoolCompundDetails'])->name('saveSchoolCompundDetails');
    Route::get('/loadcompoundareadetials', [App\Http\Controllers\organization\CompoundDetailsController::class, 'loadcompoundareadetials'])->name('loadcompoundareadetials');

    //disaster Information
    Route::post('/saveDisasterInformation', [App\Http\Controllers\organization\DisasterController::class, 'saveDisasterInformation'])->name('saveDisasterInformation');
    Route::get('/loadDisasterInformation', [App\Http\Controllers\organization\DisasterController::class, 'loadDisasterInformation'])->name('loadDisasterInformation');
});
Route::prefix('questionAnswerController')->group(function () {
    Route::post('/saveQuestionaries', [App\Http\Controllers\question_answer\QuestionAnswerController::class, 'saveQuestionaries'])->name('saveQuestionaries');
    Route::get('/loadQuestionaries/{type}', [App\Http\Controllers\question_answer\QuestionAnswerController::class, 'loadQuestionaries'])->name('loadQuestionaries');
    Route::post('/saveAnswers', [App\Http\Controllers\question_answer\QuestionAnswerController::class, 'saveAnswers'])->name('saveAnswers');
    Route::get('/getAnswers/{question_id}', [App\Http\Controllers\question_answer\QuestionAnswerController::class, 'getAnswers'])->name('getAnswers');
    Route::delete('/deleteAns/{id}', [App\Http\Controllers\question_answer\QuestionAnswerController::class, 'deleteAns'])->name('deleteAns');
});


Route::prefix('staff')->group(function () {
    Route::post('/savePersonalDetails', [App\Http\Controllers\staff\StaffController::class, 'savePersonalDetails'])->name('savePersonalDetails');
    Route::get('/loaddraftpersonalDetails/{type}', [App\Http\Controllers\staff\StaffController::class, 'loaddraftpersonalDetails'])->name('loaddraftpersonalDetails');
    Route::get('/checkThisCid/{cid}', [App\Http\Controllers\staff\StaffController::class, 'checkThisCid'])->name('checkThisCid');

    //staff approval by gagen
    Route::prefix('StaffApprovalController')->group(function (){
        Route::post('/savePrincipalApproval', [App\Http\Controllers\staff\StaffApprovalController::class, 'savePrincipalApproval'])->name('savePrincipalApproval');
        Route::get('/loadPrincipalRecuritmentApplication/{appId}/{type}', [App\Http\Controllers\staff\StaffApprovalController::class, 'loadPrincipalRecuritmentApplication'])->name('loadPrincipalRecuritmentApplication');
        Route::post('/updatePrincipalApproval', [App\Http\Controllers\staff\StaffApprovalController::class, 'updatePrincipalApproval'])->name('savePrincipalApproval');
        Route::get('/loadPrincipalApprovalApplication/{type}', [App\Http\Controllers\staff\StaffApprovalController::class, 'loadPrincipalApprovalApplication'])->name('loadPrincipalRecuritmentApplication');
        Route::get('/loadPrincipalApplicationDetials/{appNo}', [App\Http\Controllers\staff\StaffApprovalController::class, 'loadPrincipalApplicationDetials'])->name('loadPrincipalApplicationDetials');
        Route::get('/loadPrincipalAttachmentDetials/{id}', [App\Http\Controllers\staff\StaffApprovalController::class, 'loadPrincipalAttachmentDetials'])->name('loadPrincipalAttachmentDetials');
    });
    Route::prefix('StaffApprovalController')->group(function (){
        Route::post('/saveExpatriateRecuritment', [App\Http\Controllers\staff\StaffApprovalController::class, 'saveExpatriateRecuritment'])->name('saveExpatriateRecuritment');
        Route::get('/loadPrincipalRecuritmentApplication/{appId}/{type}', [App\Http\Controllers\staff\StaffApprovalController::class, 'loadPrincipalRecuritmentApplication'])->name('loadPrincipalRecuritmentApplication');
        Route::post('/UpdateExpatriateRecuritment', [App\Http\Controllers\staff\StaffApprovalController::class, 'UpdateExpatriateRecuritment'])->name('UpdateExpatriateRecuritment');
        Route::get('/loadExpatriateApprovalApplication/{type}', [App\Http\Controllers\staff\StaffApprovalController::class, 'loadExpatriateApprovalApplication'])->name('loadExpatriateApprovalApplication');

    });

    Route::post('/savequalificationDetails', [App\Http\Controllers\staff\StaffController::class, 'savequalificationDetails'])->name('savequalificationDetails');
    Route::get('/loadQualification/{staff_id}', [App\Http\Controllers\staff\StaffController::class, 'loadQualification'])->name('loadQualification');
    Route::get('/loadStaffQualification/{staff_id}', [App\Http\Controllers\staff\StaffController::class, 'loadStaffQualification'])->name('loadStaffQualification');

    Route::post('/savenominationDetails', [App\Http\Controllers\staff\StaffController::class, 'savenominationDetails'])->name('savenominationDetails');
    Route::get('/loadNominations/{staff_id}', [App\Http\Controllers\staff\StaffController::class, 'loadNominations'])->name('loadNominations');
    Route::get('/loadStaffNomination/{staff_id}', [App\Http\Controllers\staff\StaffController::class, 'loadStaffNomination'])->name('loadStaffNomination');

    Route::post('/updatefinalstaffDetails', [App\Http\Controllers\staff\StaffController::class, 'updatefinalstaffDetails'])->name('updatefinalstaffDetails');
    Route::post('/updatefinalPrivatestaffDetails', [App\Http\Controllers\staff\StaffController::class, 'updatefinalPrivatestaffDetails'])->name('updatefinalPrivatestaffDetails');

    // Route::get('/loadAllStaff/{type}', [App\Http\Controllers\staff\StaffController::class, 'loadAllStaff'])->name('loadAllStaff');

    // Route::get('/loadStaff/{type}', [App\Http\Controllers\staff\StaffController::class, 'loadStaff'])->name('loadStaff');

    Route::post('/saveTransferWindow', [App\Http\Controllers\staff\StaffController::class, 'saveTransferWindow'])->name('saveTransferWindow');
    Route::get('/loadTransferWindow', [App\Http\Controllers\staff\StaffController::class, 'loadTransferWindow'])->name('loadTransferWindow');
    Route::prefix('hrdevelopment')->group(function (){
        Route::post('/saveprogramDetails', [App\Http\Controllers\staff\HrDevelopmentController::class, 'saveprogramDetails'])->name('saveprogramDetails');
        Route::get('/loadDraftDetails', [App\Http\Controllers\staff\HrDevelopmentController::class, 'loadDraftDetails'])->name('loadDraftDetails');
        Route::post('/saveprogramFinalDetails', [App\Http\Controllers\staff\HrDevelopmentController::class, 'saveprogramFinalDetails'])->name('saveprogramFinalDetails');
        Route::get('/loadprogramDetails', [App\Http\Controllers\staff\HrDevelopmentController::class, 'loadprogramDetails'])->name('loadprogramDetails');
        Route::get('/loadDetails/{id}', [App\Http\Controllers\staff\HrDevelopmentController::class, 'loadDetails'])->name('loadDetails');
        Route::get('/loadProgramDetailsForNomination', [App\Http\Controllers\staff\HrDevelopmentController::class, 'loadProgramDetailsForNomination'])->name('loadProgramDetailsForNomination');
        Route::post('/saveParticipant', [App\Http\Controllers\staff\HrDevelopmentController::class, 'saveParticipant'])->name('saveParticipant');
        Route::get('/getParticipantDetails/{action_type}/{program_id}', [App\Http\Controllers\staff\HrDevelopmentController::class, 'getParticipantDetails'])->name('getParticipantDetails');
        Route::get('/deleteParticipant/{id}', [App\Http\Controllers\staff\HrDevelopmentController::class, 'deleteParticipant'])->name('deleteParticipant');
        Route::post('/submitParticipants', [App\Http\Controllers\staff\HrDevelopmentController::class, 'submitParticipants'])->name('submitParticipants');
        Route::post('/updateParticipant', [App\Http\Controllers\staff\HrDevelopmentController::class, 'updateParticipant'])->name('updateParticipant');
        Route::post('/updateapplication', [App\Http\Controllers\staff\HrDevelopmentController::class, 'updateapplication'])->name('updateapplication');
    });

    Route::prefix('transfer')->group(function (){
        Route::get('/getcurrentTransferWindowDetails/{id}', [App\Http\Controllers\staff\TransferController::class, 'getcurrentTransferWindowDetails'])->name('getcurrentTransferWindowDetails');
        Route::post('/submitapplicantDetails', [App\Http\Controllers\staff\TransferController::class, 'submitapplicantDetails'])->name('submitapplicantDetails');
        Route::get('/getDraftDetails', [App\Http\Controllers\staff\TransferController::class, 'getDraftDetails'])->name('getDraftDetails');
        Route::post('/submitFinalapplicantDetails', [App\Http\Controllers\staff\TransferController::class, 'submitFinalapplicantDetails'])->name('submitFinalapplicantDetails');
        Route::get('/loadtrainsferDetails/{appNo}/{type}', [App\Http\Controllers\staff\TransferController::class, 'loadtrainsferDetails'])->name('loadtrainsferDetails');
        Route::post('/updateTransferApplication', [App\Http\Controllers\staff\TransferController::class, 'updateTransferApplication'])->name('updateTransferApplication');
    });
    Route::prefix('managementBody')->group(function (){
        Route::post('/saveManagementBody', [App\Http\Controllers\staff\ManagementBodyController::class, 'saveManagementBody'])->name('saveManagementBody');
        Route::post('/saveManagementBodyComposition', [App\Http\Controllers\staff\ManagementBodyController::class, 'saveManagementBodyComposition'])->name('saveManagementBodyComposition');
        Route::get('/loadManagementBodyComposition/{id}', [App\Http\Controllers\staff\ManagementBodyController::class, 'loadManagementBodyComposition'])->name('loadManagementBodyComposition');
        Route::get('/deleteManagementBodyComposition/{id}/{itemId}', [App\Http\Controllers\staff\ManagementBodyController::class, 'deleteManagementBodyComposition'])->name('deleteManagementBodyComposition');
        Route::post('/updateManagementBody', [App\Http\Controllers\staff\ManagementBodyController::class, 'updateManagementBody'])->name('updateManagementBody');
        Route::get('/loadcreatedManagementBodyComposition', [App\Http\Controllers\staff\ManagementBodyController::class, 'loadcreatedManagementBodyComposition'])->name('loadcreatedManagementBodyComposition');
        Route::get('/loadcurrentbaord/{id}', [App\Http\Controllers\staff\ManagementBodyController::class, 'loadcurrentbaord'])->name('loadcurrentbaord');
        Route::post('/saveManagementMeeting', [App\Http\Controllers\staff\ManagementBodyController::class, 'saveManagementMeeting'])->name('saveManagementMeeting');
        Route::post('/saveResolutions', [App\Http\Controllers\staff\ManagementBodyController::class, 'saveResolutions'])->name('saveResolutions');
        Route::get('/loadCurrentMeeting', [App\Http\Controllers\staff\ManagementBodyController::class, 'loadCurrentMeeting'])->name('loadCurrentMeeting');
    });
    Route::prefix('staffServices')->group(function (){
        Route::post('/saveStaffAward', [App\Http\Controllers\staff\StaffServicesController::class, 'saveStaffAward'])->name('saveStaffAward');
        Route::get('/loadStaffAward', [App\Http\Controllers\staff\StaffServicesController::class, 'loadStaffAward'])->name('loadStaffAward');
        Route::get('/deleteStaffServices/{type}/{id}', [App\Http\Controllers\staff\StaffServicesController::class, 'deleteStaffServices'])->name('deleteStaffServices');
        Route::post('/saveStaffResponsibility', [App\Http\Controllers\staff\StaffServicesController::class, 'saveStaffResponsibility'])->name('saveStaffResponsibility');
        Route::get('/loadStaffResponsibility', [App\Http\Controllers\staff\StaffServicesController::class, 'loadStaffResponsibility'])->name('loadStaffResponsibility');

        Route::post('/saveStaffDisaplinary', [App\Http\Controllers\staff\StaffServicesController::class, 'saveStaffDisaplinary'])->name('saveStaffDisaplinary');
        Route::get('/loadStaffdisaplinary', [App\Http\Controllers\staff\StaffServicesController::class, 'loadStaffdisaplinary'])->name('loadStaffdisaplinary');

        Route::post('/saveStaffAttendance', [App\Http\Controllers\staff\StaffServicesController::class, 'saveStaffAttendance'])->name('saveStaffAttendance');
        Route::get('/loadStaffattendance/{dzo_id}', [App\Http\Controllers\staff\StaffServicesController::class, 'loadStaffattendance'])->name('loadStaffattendance');
        Route::get('/loadattendanceDetails/{id}', [App\Http\Controllers\staff\StaffServicesController::class, 'loadattendanceDetails'])->name('loadattendanceDetails');

        Route::get('/checkAttendanceDetailsByDate/{year}/{month}', [App\Http\Controllers\staff\StaffServicesController::class, 'checkAttendanceDetailsByDate'])->name('checkAttendanceDetailsByDate');

        Route::get('/checkEligibility/{type_id}', [App\Http\Controllers\staff\StaffServicesController::class, 'checkEligibility'])->name('checkEligibility');
        Route::post('/submitLeaveApplication', [App\Http\Controllers\staff\StaffServicesController::class, 'submitLeaveApplication'])->name('submitLeaveApplication');
        Route::post('/editLeaveApplication', [App\Http\Controllers\staff\StaffServicesController::class, 'editLeaveApplication'])->name('editLeaveApplication');

        Route::get('/loadLeaveDetails/{appNo}/{type}', [App\Http\Controllers\staff\StaffServicesController::class, 'loadLeaveDetails'])->name('loadLeaveDetails');
        Route::post('/verifyApproveRejectLeaveApplication', [App\Http\Controllers\staff\StaffServicesController::class, 'verifyApproveRejectLeaveApplication'])->name('verifyApproveRejectLeaveApplication');
        Route::get('/getApprovedLeaveCount/{staff_id}/{leave_type_id}', [App\Http\Controllers\staff\StaffServicesController::class, 'getApprovedLeaveCount'])->name('getApprovedLeaveCount');
        Route::get('/getOnGoingLeave/{staff_id}', [App\Http\Controllers\staff\StaffServicesController::class, 'getOnGoingLeave'])->name('getOnGoingLeave');
        Route::get('/getallLeaves', [App\Http\Controllers\staff\StaffServicesController::class, 'getallLeaves'])->name('getallLeaves');
    });
    Route::prefix('staffLeadershipSerivcesController')->group(function (){
        Route::post('/createPost', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'createPost'])->name('createPost');
        Route::get('/loadAllPosts', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'loadAllPosts'])->name('loadAllPosts');
        Route::get('/loadDetials/{id}', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'loadDetials'])->name('loadDetials');
        Route::get('/loadAllPostList', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'loadAllPostList'])->name('loadAllPostList');
        Route::get('/loadPostDetials/{id}', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'loadPostDetials'])->name('loadPostDetials');
        Route::post('/submitApplication', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'submitApplication'])->name('submitApplication');
        Route::get('/loadapplicaitontDetials/{id}', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'loadapplicaitontDetials'])->name('loadapplicaitontDetials');
        Route::get('/loadAllApplication', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'loadAllApplication'])->name('loadAllApplication');
        Route::post('/createLeadershipSelection', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'createLeadershipSelection'])->name('createLeadershipSelection');
        Route::get('/loadLeadershipSelection/{type}/{id}', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'loadLeadershipSelection'])->name('loadLeadershipSelection');
        Route::post('/createNominationForLeadershipSelection', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'createNominationForLeadershipSelection'])->name('createNominationForLeadershipSelection');
        Route::get('/loadNominationForLeadershipSelection/{id}', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'loadNominationForLeadershipSelection'])->name('loadNominationForLeadershipSelection');
        Route::post('/publishleadership', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'publishleadership'])->name('publishleadership');
        Route::get('/loadAllLeadershipSelection', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'loadAllLeadershipSelection'])->name('loadAllLeadershipSelection');

        Route::get('/checkforfeedbackLink', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'checkforfeedbackLink'])->name('checkforfeedbackLink');
        Route::get('/getleadershipDetailsForFeedback/{id}', [App\Http\Controllers\staff\StaffLeadershipSerivcesController::class, 'getleadershipDetailsForFeedback'])->name('getleadershipDetailsForFeedback');
    });


});
Route::prefix('common')->group(function () {
    Route::get('/getRoles/{param}', [App\Http\Controllers\CommonController::class, 'getRoles'])->name('loadTrangetRolessferWindow');

    Route::get('/viewFiles/{full_path}', [App\Http\Controllers\CommonController::class, 'viewFiles'])->name('viewFiles');
    Route::get('/deleteFile/{full_path}/{id}', [App\Http\Controllers\CommonController::class, 'deleteFile'])->name('deleteFile');
    Route::get('/getApplicationDetials/{applicationId}', [App\Http\Controllers\CommonController::class, 'getApplicationDetials'])->name('getApplicationDetials');
    Route::get('/getTaskList/{type}', [App\Http\Controllers\CommonController::class, 'getTaskList'])->name('getTaskList');
    Route::get('/commonLeaveOthers/{type}', [App\Http\Controllers\CommonController::class, 'commonLeaveOthers'])->name('commonLeaveOthers');
    Route::get('/releaseApplication/{application_number}', [App\Http\Controllers\CommonController::class, 'releaseApplication'])->name('releaseApplication');
    Route::get('/getScreenAccess/{type}',[App\Http\Controllers\CommonController::class, 'getScreenAccess'])->name('getScreenAccess');
    Route::get('/getSessionDetail', [App\Http\Controllers\CommonController::class, 'getSessionDetail'])->name('getSessionDetail');
    Route::get('/getDzoNameById/{id}', [App\Http\Controllers\CommonController::class, 'getDzoNameById'])->name('getDzoNameById');
    Route::get('/getGewogNameById/{id}', [App\Http\Controllers\CommonController::class, 'getGewogNameById'])->name('getGewogNameById');
    // Route::get('/getOrgDetailsById/{id}/{accesslevel}', [App\Http\Controllers\CommonController::class, 'getOrgDetailsById'])->name('getOrgDetailsById');

    //Get Student List
    Route::get('/getStudentList/{orgId}/{orgClassStreamId}', [App\Http\Controllers\CommonController::class, 'getStudentList'])->name('getStudentList');

});

//routes to load list and detials from respective services
Route::prefix('loadCommons')->group(function () {
    Route::get('/loadOrgList/{type}/{parent_id}', [App\Http\Controllers\common_services\LoadOrganizaitonController::class, 'loadOrgList'])->name('loadOrgList');
    Route::get('/loadInactiveOrgList', [App\Http\Controllers\common_services\LoadOrganizaitonController::class, 'loadInactiveOrgList'])->name('loadInactiveOrgList');
    Route::get('/loadOrgDetails/{type}/{parent_id}', [App\Http\Controllers\common_services\LoadOrganizaitonController::class, 'loadOrgDetails'])->name('loadOrgDetails');
    Route::get('/loadHeaquarterList/{type}/{parent_id}', [App\Http\Controllers\common_services\LoadOrganizaitonController::class, 'loadHeaquarterList'])->name('loadHeaquarterList');
    Route::get('/loadClassStreamSection/{type}/{parent_id}', [App\Http\Controllers\common_services\LoadOrganizaitonController::class, 'loadClassStreamSection'])->name('loadClassStreamSection');
    Route::get('/getClassByType/{type}', [App\Http\Controllers\common_services\LoadOrganizaitonController::class, 'getClassByType'])->name('getClassByType');
    Route::get('/getOrgClassStream', [App\Http\Controllers\common_services\LoadOrganizaitonController::class, 'getOrgClassStream'])->name('getOrgClassStream');
    Route::get('/loadStreamList/{id}', [App\Http\Controllers\common_services\LoadOrganizaitonController::class, 'loadStreamList'])->name('loadStreamList');
    Route::get('/loadSectionList/{id}', [App\Http\Controllers\common_services\LoadOrganizaitonController::class, 'loadSectionList'])->name('loadSectionList');
    Route::get('/getClassStreamSection/{params}', [App\Http\Controllers\common_services\LoadOrganizaitonController::class, 'getClassStreamSection'])->name('getClassStreamSection');
    Route::get('/getClassArray', [App\Http\Controllers\common_services\LoadOrganizaitonController::class, 'getClassArray'])->name('getClassArray');
    Route::get('/getSectionArray', [App\Http\Controllers\common_services\LoadOrganizaitonController::class, 'getSectionArray'])->name('getSectionArray');
    Route::get('/getStreamArray', [App\Http\Controllers\common_services\LoadOrganizaitonController::class, 'getStreamArray'])->name('getStreamArray');

    Route::get('/loadStaffList/{type}/{parent_id}', [App\Http\Controllers\common_services\LoadStaffController::class, 'loadStaffList'])->name('loadStaffList');
    Route::get('/loadFewDetailsStaffList/{type}/{parent_id}', [App\Http\Controllers\common_services\LoadStaffController::class, 'loadFewDetailsStaffList'])->name('loadFewDetailsStaffList');
    Route::get('/viewStaffDetails/{type}/{parent_id}', [App\Http\Controllers\common_services\LoadStaffController::class, 'viewStaffDetails'])->name('viewStaffDetails');
    Route::get('/checkAttendanceDetailsByDate/{year}/{month}', [App\Http\Controllers\common_services\LoadStaffController::class, 'viewStaffDetails'])->name('viewStaffDetails');

});

Route::prefix('students')->group(function () {
    Route::prefix('admission')->group(function (){
        Route::post('/saveStudentDetails', [App\Http\Controllers\student\StudentAdmissionController::class, 'saveStudentDetails'])->name('saveStudentDetails');
        Route::post('/saveStudentGardianDetails', [App\Http\Controllers\student\StudentAdmissionController::class, 'saveStudentGardianDetails'])->name('saveStudentGardianDetails');
        Route::post('/saveStudentClassDetails', [App\Http\Controllers\student\StudentAdmissionController::class, 'saveStudentClassDetails'])->name('saveStudentClassDetails');
        Route::get('/loadStudentList/{param}', [App\Http\Controllers\student\StudentAdmissionController::class, 'loadStudentList'])->name('loadStudentList');
        Route::get('/loadStudentAdmissionList', [App\Http\Controllers\student\StudentAdmissionController::class, 'loadStudentAdmissionList'])->name('loadStudentAdmissionList');
        Route::post('/loadStudentListwithsearch', [App\Http\Controllers\student\StudentAdmissionController::class, 'loadStudentListwithsearch'])->name('loadStudentListwithsearch');
        Route::get('/getStudentDetails/{std_id}', [App\Http\Controllers\student\StudentAdmissionController::class, 'getStudentDetails'])->name('getStudentDetails');
        Route::get('/getstudentGuardainClassDetails/{std_id}/{type}', [App\Http\Controllers\student\StudentAdmissionController::class, 'getstudentGuardainClassDetails'])->name('getStudentGuardainDetails');
        Route::post('/studentAdmissionupdate', [App\Http\Controllers\student\StudentAdmissionController::class, 'studentAdmissionupdate'])->name('studentAdmissionupdate');
    });

    Route::prefix('sen')->group(function (){
        //GET SEN STUDNETS
        Route::get('/getSenStudentList', [App\Http\Controllers\student\SenStudentController::class, 'getSenStudentList']);
        Route::get('/getquestionnaire/{StudentId}', [App\Http\Controllers\student\SenQuestionnaireController::class, 'getQuestionnaire']);
        Route::post('/savequestionnaire', [App\Http\Controllers\student\SenQuestionnaireController::class, 'saveQuestionnaire']);
    });

    Route::post('/reportStudents', [App\Http\Controllers\student\StudentAdmissionRelatedController::class, 'reportStudents'])->name('reportStudents');
    Route::get('/loadUnreportedStudents/{param}', [App\Http\Controllers\student\StudentAdmissionRelatedController::class, 'loadUnreportedStudents'])->name('loadUnreportedStudents');
    Route::post('/saveStudentTransfer', [App\Http\Controllers\student\StudentAdmissionRelatedController::class, 'saveStudentTransfer'])->name('saveStudentTransfer');
    Route::get('/loadStudentTransfers/{param}', [App\Http\Controllers\student\StudentAdmissionRelatedController::class, 'loadStudentTransfers'])->name('loadStudentTransfers');
    Route::post('/saveStudentWhereabouts', [App\Http\Controllers\student\StudentAdmissionRelatedController::class, 'saveStudentWhereabouts'])->name('saveStudentWhereabouts');
    Route::get('/loadStudentWhereabouts/{param}', [App\Http\Controllers\student\StudentAdmissionRelatedController::class, 'loadStudentWhereabouts'])->name('loadStudentWhereabouts');
    Route::get('/loadAboardList/{orgId}', [App\Http\Controllers\student\StudentAdmissionRelatedController::class, 'loadAboardList'])->name('loadAboardList');
    Route::get('/loadAdmissionRequest/{orgId}', [App\Http\Controllers\student\StudentAdmissionRelatedController::class, 'loadAdmissionRequest'])->name('loadAdmissionRequest');
    Route::post('/saveStudentAboard', [App\Http\Controllers\student\StudentAdmissionRelatedController::class, 'saveStudentAboard'])->name('saveStudentAboard');

    Route::get('/loadStudentList/{param}', [App\Http\Controllers\common_services\GeneralStudentController::class, 'loadStudentList'])->name('loadStudentList');
    Route::get('/loadBasicStudentList/{param}', [App\Http\Controllers\common_services\GeneralStudentController::class, 'loadBasicStudentList'])->name('loadBasicStudentList');
    Route::get('/loadStudentByClass/{class}', [App\Http\Controllers\common_services\GeneralStudentController::class, 'loadStudentByClass'])->name('loadStudentByClass');
    Route::get('/loadStudentBySection/{param1}', [App\Http\Controllers\common_services\GeneralStudentController::class, 'loadStudentBySection'])->name('loadStudentBySection');
    Route::get('/studentListByGender/{param}', [App\Http\Controllers\common_services\GeneralStudentController::class, 'studentListByGender'])->name('studentListByGender');
    //for profile
    Route::get('/getStudentDetails/{id}', [App\Http\Controllers\common_services\GeneralStudentController::class, 'getStudentDetails'])->name('getStudentDetails');
    Route::get('/getStudentParentsDetails/{id}', [App\Http\Controllers\common_services\GeneralStudentController::class, 'getStudentParentsDetails'])->name('getStudentParentsDetails');
    Route::get('/getStudentRoleDetails/{id}', [App\Http\Controllers\common_services\GeneralStudentController::class, 'getStudentRoleDetails'])->name('getStudentRoleDetails');
    Route::get('/getStudentProgrammeDetails/{id}', [App\Http\Controllers\common_services\GeneralStudentController::class, 'getStudentProgrammeDetails'])->name('getStudentProgrammeDetails');

    Route::post('/saveStudentAward', [App\Http\Controllers\student\StudentAwardController::class, 'saveStudentAward'])->name('saveStudentAward');
    Route::get('/loadStudentAwards/{param}', [App\Http\Controllers\student\StudentAwardController::class, 'loadStudentAwards'])->name('loadStudentAwards');

    Route::post('/saveStudentClassAllocation', [App\Http\Controllers\student\StudentClassController::class, 'saveStudentClassAllocation'])->name('saveStudentClassAllocation');
    Route::get('/loadStudentClassAllocations/{param}', [App\Http\Controllers\student\StudentClassController::class, 'loadStudentClassAllocations'])->name('loadStudentClassAllocations');

    Route::post('/saveStudentResponsibility', [App\Http\Controllers\student\StudentResponsibilityController::class, 'saveStudentResponsibility'])->name('saveStudentResponsibility');
    Route::get('/loadStudentResponsibilities/{param}', [App\Http\Controllers\student\StudentResponsibilityController::class, 'loadStudentResponsibilities'])->name('loadStudentResponsibilities');
    Route::get('/getAssignedTeacherRoles/{param}', [App\Http\Controllers\student\StudentResponsibilityController::class, 'getTeacherRoles'])->name('getTeacherRoles');

    Route::post('/addStudentRecord', [App\Http\Controllers\student\StudentDisciplinaryController::class, 'addStudentRecord'])->name('addStudentRecord');
    Route::get('/loadStudentRecords/{param}', [App\Http\Controllers\student\StudentDisciplinaryController::class, 'loadStudentRecords'])->name('loadStudentRecords');

    Route::post('/addDewormingRecords', [App\Http\Controllers\student\StudentHealthController::class, 'addDewormingRecords'])->name('addDewormingRecords');
    Route::get('/loadDewormingRecords/{param}', [App\Http\Controllers\student\StudentHealthController::class, 'loadDewormingRecords'])->name('loadDewormingRecords');
    Route::get('/loadViewDewormingDetails/{param}', [App\Http\Controllers\student\StudentHealthController::class, 'loadViewDewormingDetails'])->name('loadViewDewormingDetails');
    Route::get('/getDewormingDetails/{id}', [App\Http\Controllers\student\StudentHealthController::class, 'getDewormingDetails'])->name('getDewormingDetails');

    Route::post('/addSupplementationRecords', [App\Http\Controllers\student\StudentHealthController::class, 'addSupplementationRecords'])->name('addSupplementationRecords');
    Route::get('/loadSupplementationRecords/{param}', [App\Http\Controllers\student\StudentHealthController::class, 'loadSupplementationRecords'])->name('loadSupplementationRecords');
    Route::get('/loadViewSupplementationDetails/{param}', [App\Http\Controllers\student\StudentHealthController::class, 'loadViewSupplementationDetails'])->name('loadViewSupplementationDetails');
    Route::get('/getSupplementationDetails/{id}', [App\Http\Controllers\student\StudentHealthController::class, 'getSupplementationDetails'])->name('getSupplementationDetails');

    Route::post('/addHealthScreeningRecords', [App\Http\Controllers\student\StudentHealthController::class, 'addHealthScreeningRecords'])->name('addHealthScreeningRecords');
    Route::post('/updateHealthScreeningRecords', [App\Http\Controllers\student\StudentHealthController::class, 'updateHealthScreeningRecords'])->name('updateHealthScreeningRecords');
    Route::get('/loadHealthScreeningRecords/{param}', [App\Http\Controllers\student\StudentHealthController::class, 'loadHealthScreeningRecords'])->name('loadHealthScreeningRecords');
    Route::get('/listScreeningSummary/{param}', [App\Http\Controllers\student\StudentHealthController::class, 'listScreeningSummary'])->name('listScreeningSummary');
    Route::get('/getHealthScreeningSummary/{param}', [App\Http\Controllers\student\StudentHealthController::class, 'getHealthScreeningSummary'])->name('getHealthScreeningSummary');
    Route::get('/getHealthScreeningDetails/{param}', [App\Http\Controllers\student\StudentHealthController::class, 'getHealthScreeningDetails'])->name('getHealthScreeningDetails');
    Route::get('/getStudentScreenedDetails/{param}', [App\Http\Controllers\student\StudentHealthController::class, 'getStudentScreenedDetails'])->name('getStudentScreenedDetails');
    Route::get('/getStudentReferredDetails/{param}', [App\Http\Controllers\student\StudentHealthController::class, 'getStudentReferredDetails'])->name('getStudentReferredDetails');
    //Get the summary for all views
    Route::get('/loadViewScreeningDetails/{param}', [App\Http\Controllers\student\StudentHealthController::class, 'loadViewScreeningDetails'])->name('loadViewScreeningDetails');
    Route::get('/getScreeningDetails/{id}', [App\Http\Controllers\student\StudentHealthController::class, 'getScreeningDetails'])->name('getScreeningDetails');
    //Vaccinations
    Route::post('/addVaccinationRecords', [App\Http\Controllers\student\StudentHealthController::class, 'addVaccinationRecords'])->name('addVaccinationRecords');
    Route::post('/updateVaccinationRecords', [App\Http\Controllers\student\StudentHealthController::class, 'updateVaccinationRecords'])->name('updateVaccinationRecords');
    Route::post('/loadVaccinationRecords', [App\Http\Controllers\student\StudentHealthController::class, 'loadVaccinationRecords'])->name('loadVaccinationRecords');


    Route::post('/addBmiRecords', [App\Http\Controllers\student\StudentHealthController::class, 'addBmiRecords'])->name('addBmiRecords');
    Route::get('/loadBmiSummary/{param}', [App\Http\Controllers\student\StudentHealthController::class, 'loadBmiSummary'])->name('loadBmiSummary');
    Route::get('/loadBmiRecords/{param}', [App\Http\Controllers\student\StudentHealthController::class, 'loadBmiRecords'])->name('loadBmiRecords');

    Route::post('/saveStudentProject', [App\Http\Controllers\student\StudentProjectController::class, 'saveStudentProject'])->name('saveStudentProject');
    Route::get('/loadStudentProjects/{param}', [App\Http\Controllers\student\StudentProjectController::class, 'loadStudentProjects'])->name('loadStudentProjects');
    Route::get('/listStudentProjects/{param}', [App\Http\Controllers\student\StudentProjectController::class, 'listStudentProjects'])->name('listStudentProjects');
    Route::post('/saveProjectMembers', [App\Http\Controllers\student\StudentProjectController::class, 'saveProjectMembers'])->name('saveProjectMembers');
    Route::get('/listProjectMembers/{param}', [App\Http\Controllers\student\StudentProjectController::class, 'listProjectMembers'])->name('listProjectMembers');

    Route::post('/saveStudentProgram', [App\Http\Controllers\student\StudentProgramController::class, 'saveStudentProgram'])->name('saveStudentProgram');
    Route::get('/loadStudentPrograms/{param}', [App\Http\Controllers\student\StudentProgramController::class, 'loadStudentPrograms'])->name('loadStudentPrograms');
    Route::get('/listStudentPrograms/{param}', [App\Http\Controllers\student\StudentProgramController::class, 'listStudentPrograms'])->name('listStudentPrograms');
    Route::get('/getProgramDetails/{param}', [App\Http\Controllers\student\StudentProgramController::class, 'getProgramDetails'])->name('getProgramDetails');
    Route::post('/saveProgramMembers', [App\Http\Controllers\student\StudentProgramController::class, 'saveProgramMembers'])->name('saveProgramMembers');
    Route::get('/listProgramMembers/{param}', [App\Http\Controllers\student\StudentProgramController::class, 'listProgramMembers'])->name('listProgramMembers');
    Route::post('/saveProgramActionPlan', [App\Http\Controllers\student\StudentProgramController::class, 'saveProgramActionPlan'])->name('saveProgramActionPlan');
    Route::get('/loadProgramActionPlan/{param}', [App\Http\Controllers\student\StudentProgramController::class, 'loadProgramActionPlan'])->name('loadProgramActionPlan');
    Route::post('/saveProgramInventory', [App\Http\Controllers\student\StudentProgramController::class, 'saveProgramInventory'])->name('saveProgramInventory');
    Route::get('/loadProgramInventory/{param}', [App\Http\Controllers\student\StudentProgramController::class, 'loadProgramInventory'])->name('loadProgramInventory');

    Route::post('/saveStudentTraining', [App\Http\Controllers\student\StudentTrainingController::class, 'saveStudentTraining'])->name('saveStudentTraining');
    Route::get('/loadStudentTrainings/{param}', [App\Http\Controllers\student\StudentTrainingController::class, 'loadStudentTrainings'])->name('loadStudentTrainings');
    Route::get('/listStudentTrainings/{param}', [App\Http\Controllers\student\StudentTrainingController::class, 'listStudentTrainings'])->name('listStudentTrainings');
    Route::post('/saveTrainingParticipants', [App\Http\Controllers\student\StudentTrainingController::class, 'saveTrainingParticipants'])->name('saveTrainingParticipants');
    Route::get('/listTrainingParticipants/{param}', [App\Http\Controllers\student\StudentTrainingController::class, 'listTrainingParticipants'])->name('listTrainingParticipants');

    //Club Routes
    Route::get('/loadStudentClubs/{param}', [App\Http\Controllers\student\StudentProgramController::class, 'loadStudentClubs'])->name('loadStudentClubs');
    Route::get('/listStudentClubs/{param}', [App\Http\Controllers\student\StudentProgramController::class, 'listStudentClubs'])->name('listStudentClubs');
    Route::post('/saveClubMembers', [App\Http\Controllers\student\StudentProgramController::class, 'saveClubMembers'])->name('saveClubMembers');
    Route::get('/listClubMembers/{param}', [App\Http\Controllers\student\StudentProgramController::class, 'listClubMembers'])->name('listClubMembers');

    Route::post('/saveStudentScouts', [App\Http\Controllers\student\StudentScoutController::class, 'saveStudentScouts'])->name('saveStudentScouts');
    Route::get('/loadStudentScouts/{param}', [App\Http\Controllers\student\StudentScoutController::class, 'loadStudentScouts'])->name('loadStudentScouts');
    Route::get('/listStudentScouts/{param}', [App\Http\Controllers\student\StudentScoutController::class, 'listStudentScouts'])->name('listStudentScouts');
    //SAVE STUDENT SCOUTS PARTICIPANTS
    Route::post('/saveScoutParticipants', [App\Http\Controllers\student\StudentScoutController::class, 'saveScoutParticipants'])->name('saveScoutParticipants');
    Route::get('/loadScoutMembers/{orgId}', [App\Http\Controllers\student\StudentScoutController::class, 'loadScoutMembers'])->name('loadScoutMembers');

});
Route::prefix('academics')->group(function () {
    Route::get('/getclassSections', [App\Http\Controllers\academics\AcademicController::class, 'getclassSections'])->name('getclassSections');
    Route::post('/saveClassTeacher', [App\Http\Controllers\academics\AcademicController::class, 'saveClassTeacher'])->name('saveClassTeacher');
    Route::get('/getClassTeacher', [App\Http\Controllers\academics\AcademicController::class, 'getClassTeacher'])->name('getClassTeacher');
    Route::get('/getClassTeacherClasss', [App\Http\Controllers\academics\AcademicController::class, 'getClassTeacherClasss'])->name('getClassTeacherClasss');
    Route::get('/getTeacher', [App\Http\Controllers\academics\AcademicController::class, 'getTeacher'])->name('getTeacher');
    Route::post('/saveSubjectTeacher', [App\Http\Controllers\academics\AcademicController::class, 'saveSubjectTeacher'])->name('saveSubjectTeacher');
    Route::get('/getSubjectTeacher',[App\Http\Controllers\academics\AcademicController::class,'getSubjectTeacher'])->name('getSubjectTeacher');
    Route::post('/saveStudentElectiveSubject', [App\Http\Controllers\academics\AcademicController::class, 'saveStudentElectiveSubject'])->name('saveStudentElectiveSubject');
    Route::get('/loadStudentAttendance',[App\Http\Controllers\academics\AcademicController::class,'loadStudentAttendance'])->name('loadStudentAttendance');
    Route::post('/saveStudentAttendance', [App\Http\Controllers\academics\AcademicController::class, 'saveStudentAttendance'])->name('saveStudentAttendance');
    Route::get('/getStudentElectiveSubjects', [App\Http\Controllers\academics\AcademicController::class, 'getStudentElectiveSubjects'])->name('getStudentElectiveSubjects');
    Route::get('/loadStudentAssessmentList', [App\Http\Controllers\academics\AcademicController::class, 'loadStudentAssessmentList'])->name('loadStudentAssessmentList');
    Route::get('/loadStudentAssessments', [App\Http\Controllers\academics\AcademicController::class, 'loadStudentAssessments'])->name('loadStudentAssessments');
    Route::post('/saveStudentAssessment', [App\Http\Controllers\academics\AcademicController::class, 'saveStudentAssessment'])->name('saveStudentAssessment');
    Route::post('/unlockForEdit/{Id}', [App\Http\Controllers\academics\AcademicController::class, 'unlockForEdit'])->name('unlockForEdit');
    Route::get('/loadConsolidatedResultList', [App\Http\Controllers\academics\AcademicController::class, 'loadConsolidatedResultList'])->name('loadConsolidatedResultList');
    Route::get('/loadConsolidatedResult', [App\Http\Controllers\academics\AcademicController::class, 'loadConsolidatedResult'])->name('loadConsolidatedResult');
    Route::post('/saveConsolidatedResut', [App\Http\Controllers\academics\AcademicController::class, 'saveConsolidatedResut'])->name('saveConsolidatedResut');
    Route::get('/getStudentsForAttendance', [App\Http\Controllers\academics\AcademicController::class, 'getStudentsForAttendance'])->name('getStudentsForAttendance');


});


Route::prefix('mess_manage')->group(function () {
    Route::post('/saveFoodRelease', [App\Http\Controllers\mess_manage\MessManagementController::class, 'saveFoodRelease'])->name('saveFoodRelease');
    Route::get('/loadFoodReleaseList', [App\Http\Controllers\mess_manage\MessManagementController::class, 'loadFoodReleaseList'])->name('loadFoodReleaseList');
    Route::get('/getFoodReleaseItem/{foodreleaseId}', [App\Http\Controllers\mess_manage\MessManagementController::class, 'getFoodReleaseItem'])->name('getFoodReleaseItem');

    Route::post('/saveLocalProcure', [App\Http\Controllers\mess_manage\MessManagementController::class, 'saveLocalProcure'])->name('saveLocalProcure');
    Route::get('/loadLocalProcure/{org_Id}', [App\Http\Controllers\mess_manage\MessManagementController::class, 'loadLocalProcure'])->name('loadLocalProcure');

  //  Route::post('/saveStockReceived', [App\Http\Controllers\mess_manage\MessManagementController::class, 'saveStockReceived'])->name('saveStockReceived');
    // Route::post('/saveStockReceived', [App\Http\Controllers\mess_manage\MessManagementController::class, 'saveStockReceived'])->name('saveStockReceived');
    Route::get('/loadFoodReleaseListing/{org_Id}', [App\Http\Controllers\mess_manage\MessManagementController::class, 'loadFoodReleaseListing'])->name('loadFoodReleaseListing');
    Route::get('/getfoodreleaseditemList/{foodreleaseId}', [App\Http\Controllers\mess_manage\MessManagementController::class, 'getfoodreleaseditemList'])->name('getfoodreleaseditemList');
    Route::post('/saveStockReceived', [App\Http\Controllers\mess_manage\MessManagementController::class, 'saveStockReceived'])->name('saveStockReceived');
    //just added today
    Route::get('/getStockReceivedDetails/{stockreceivedId}', [App\Http\Controllers\mess_manage\MessManagementController::class, 'getStockReceivedDetails'])->name('getStockReceivedDetails');
    Route::get('/viewitemreceived/{stockreceivedId}', [App\Http\Controllers\mess_manage\MessManagementController::class, 'viewitemreceived'])->name('viewitemreceived');


    Route::get('/getfoodreleasedetailbyquarter/{quarter_id}/{foodreleaseId}', [App\Http\Controllers\mess_manage\MessManagementController::class, 'getfoodreleasedetailbyquarter'])->name('getfoodreleasedetailbyquarter');
    Route::get('/loadfoodReceivedDetails/{id}', [App\Http\Controllers\mess_manage\MessManagementController::class, 'loadfoodReceivedDetails'])->name('loadfoodReceivedDetails');

  //  Route::get('/loadStockReceivedList', [App\Http\Controllers\mess_manage\MessManagementController::class, 'loadStockReceivedList'])->name('loadStockReceivedList');

    Route::post('/saveStockIssued', [App\Http\Controllers\mess_manage\MessManagementController::class, 'saveStockIssued'])->name('saveStockIssued');
  //  Route::get('/loadStockIssuedList/{org_Id}', [App\Http\Controllers\mess_manage\MessManagementController::class, 'loadStockIssuedList'])->name('loadStockIssuedList');
    Route::get('/getStockIssueItem/{org_Id}', [App\Http\Controllers\mess_manage\MessManagementController::class, 'getStockIssueItem'])->name('getStockIssueItem');
    Route::get('/getStockIssuedList/{org_Id}', [App\Http\Controllers\mess_manage\MessManagementController::class, 'getStockIssuedList'])->name('getStockIssuedList');


    Route::get('/getInventoryList/{org_Id}', [App\Http\Controllers\mess_manage\MessManagementController::class, 'getInventoryList'])->name('getInventoryList');
});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/getpersonbycid/{cid}', [App\Http\Controllers\AdministrationController::class, 'getpersonbycid'])->name('getpersonbycid');



