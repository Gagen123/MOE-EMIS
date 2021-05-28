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

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->group(['prefix' => 'masters/disaster'], function () use ($router) {
        // disaster route
        $router->get('/loadDisaster', 'Masters\DisasterController@loadDisaster');
        $router->post('/saveDisaster', 'Masters\DisasterController@saveDisaster');


    });
    $router->group(['prefix' => 'masters/location'], function () use ($router) {
        // location route
        $router->get('/loadLocation', 'Masters\LocationController@loadLocation');
        $router->post('/saveLocation', 'Masters\LocationController@saveLocation');

    });

    $router->group(['prefix' => 'masters/structureCategory'], function () use ($router) {
        // structure category route
        $router->get('/loadStructureCategory', 'Masters\StructureCategoryController@loadStructureCategory');
        $router->post('/saveStructureCategory', 'Masters\StructureCategoryController@saveStructureCategory');

    });

    $router->group(['prefix' => 'masters/level'], function () use ($router) {
        // level category route
        $router->post('/saveLevel', 'Masters\LevelController@saveLevel');
        $router->get('/loadLevel', 'Masters\LevelController@loadLevel');

    });

    $router->group(['prefix' => 'masters/structureFacility'], function () use ($router) {
        // structure facility category route
        $router->post('/saveStructureFacility', 'Masters\StructureFacilityController@saveStructureFacility');
        $router->get('/loadStructureFacility', 'Masters\StructureFacilityController@loadStructureFacility');

    });

    $router->group(['prefix' => 'masters/equipmentType'], function () use ($router) {
        // equipment type route
        $router->post('/saveEquipmentType', 'Masters\EquipmentTypeController@saveEquipmentType');
        $router->get('/loadEquipmentType', 'Masters\EquipmentTypeController@loadEquipmentType');

    });

    $router->group(['prefix' => 'masters/equipmentUsage'], function () use ($router) {
        // equipment usage route
        $router->post('/saveEquipmentUsage', 'Masters\EquipmentUsageController@saveEquipmentUsage');
        $router->get('/loadEquipmentUsage', 'Masters\EquipmentUsageController@loadEquipmentUsage');

    });

    $router->group(['prefix' => 'masters/sportFacility'], function () use ($router) {
        // sport facility route
        $router->post('/saveSportFacility', 'Masters\SportFacilityTypeController@saveSportFacility');
        $router->get('/loadSportFacility', 'Masters\SportFacilityTypeController@loadSportFacility');

    });

    $router->group(['prefix' => 'masters/sportFacilitySubtype'], function () use ($router) {
        // sport facility subtype route
        $router->post('/saveSportFacilitySubtype', 'Masters\SportFacilitySubTypeController@saveSportFacilitySubtype');
        $router->get('/loadSportFacilitySubtype', 'Masters\SportFacilitySubTypeController@loadSportFacilitySubtype');

    });
    $router->group(['prefix' => 'masters/sportSupporter'], function () use ($router) {
        // sport supporter route
        $router->post('/saveSportSupporter', 'Masters\SportSupporterController@saveSportSupporter');
        $router->get('/loadSportSupporter', 'Masters\SportSupporterController@loadSportSupporter');

    });

    $router->group(['prefix' => 'masters/structureSubCategory'], function () use ($router) {
        // structure sub category route
        $router->post('/saveStrSubCategory', 'Masters\StructureSubCategoryController@saveStrSubCategory');
        $router->get('/getStrCategoryDropdown', 'Masters\StructureSubCategoryController@getStrCategoryDropdown');
        $router->get('/loadStrSubCategory', 'Masters\StructureSubCategoryController@loadStrSubCategory');

    });

    $router->group(['prefix' => 'masters/equipmentItem'], function () use ($router) {
        // equipment item route
        $router->post('/saveEquipmentItem', 'Masters\EquipmentItemController@saveEquipmentItem');
        $router->get('/getEquipmentTypeDropdown', 'Masters\EquipmentItemController@getEquipmentTypeDropdown');
        $router->get('/loadEquipmentItem', 'Masters\EquipmentItemController@loadEquipmentItem');

    });

    $router->group(['prefix' => 'masters/class'], function () use ($router) {
        // class route
        $router->post('/saveClass', 'Masters\ClassController@saveClass');
        $router->get('/loadClass', 'Masters\ClassController@loadClass');
    });

    $router->group(['prefix' => 'masters/stream'], function () use ($router) {
        // class route
        $router->post('/saveStream', 'Masters\StreamController@saveStream');
        $router->get('/loadStream', 'Masters\StreamController@loadStream');
        $router->get('/getClassInDropdown', 'Masters\StreamController@getClassInDropdown');

    });
	
	$router->group(['prefix' => 'masters/classstream'], function () use ($router) {
        $router->get('/getClassStream', 'Masters\ClassStreamController@getClassStream');
    });

    $router->group(['prefix' => 'masters/classStreamMapping'], function () use ($router) {
        // class route
        $router->post('/saveClassStreamMapping', 'Masters\ClassStreamController@saveClassStreamMapping');
        $router->get('/loadClassStreamMapping/{type}', 'Masters\ClassStreamController@loadClassStreamMapping');
    });

    $router->group(['prefix' => 'masters/electricitySource'], function () use ($router) {
        $router->post('/saveElectricitySource', 'Masters\ElectricitySourceController@saveElectricitySource');
        $router->get('/loadElectricitySource', 'Masters\ElectricitySourceController@loadElectricitySource');
    });

    $router->group(['prefix' => 'masters/electricitySupply'], function () use ($router) {
        $router->post('/saveElectricitySupply', 'Masters\ElectricitySupplyController@saveElectricitySupply');
        $router->get('/loadElectricitySupply', 'Masters\ElectricitySupplyController@loadElectricitySupply');
    });

    $router->group(['prefix' => 'masters/roadType'], function () use ($router) {
        $router->post('/saveRoadType', 'Masters\RoadTypeController@saveRoadType');
        $router->get('/loadRoadType', 'Masters\RoadTypeController@loadRoadType');
    });

    $router->group(['prefix' => 'masters/serviceProvider'], function () use ($router) {
        $router->post('/saveServiceProvider', 'Masters\ServiceProviderController@saveServiceProvider');
        $router->get('/loadServiceProvider', 'Masters\ServiceProviderController@loadServiceProvider');
    });

    $router->group(['prefix' => 'masters/contactType'], function () use ($router) {
        $router->post('/saveContactType', 'Masters\ContactTypeController@saveContactType');
        $router->get('/loadContactType', 'Masters\ContactTypeController@loadContactType');
    });

    $router->group(['prefix' => 'masters/attachment'], function () use ($router) {
        $router->post('/saveAttachment', 'Masters\AttachmentController@saveAttachment');
        $router->get('/loadAttachment', 'Masters\AttachmentController@loadAttachment');
    });

    $router->group(['prefix' => 'masters/structureDesigner'], function () use ($router) {
        $router->post('/saveStructureDesigner', 'Masters\StructureDesignerController@saveStructureDesigner');
        $router->get('/loadStructureDesigner', 'Masters\StructureDesignerController@loadStructureDesigner');
    });

    //Organization Transactions Routes
    $router->group(['prefix' => 'organization'], function () use ($router){
        $router->get('/getOrgList/{dzo_id}', ['uses' => 'establishment\EstablishmentController@getOrgList']);
        $router->get('/getClassByOrg/{id}', ['uses' => 'establishment\EstablishmentController@getClassByOrg']);
            // equipment route
        $router->group(['prefix' => 'equipment'], function () use ($router) {
            $router->post('/saveEquipmentAndFurniture', 'generalInformation\EquipmentController@saveEquipmentAndFurniture');
            $router->get('/loadEquipment/{orgId}', 'generalInformation\EquipmentController@loadEquipment');
            $router->get('/getType', 'generalInformation\EquipmentController@getType');
            $router->get('/getItem/{typeId}', 'generalInformation\EquipmentController@getItem');
            $router->get('/getLocationUse', 'generalInformation\EquipmentController@getLocationUse');
        });
        $router->group(['prefix' => 'section'], function () use ($router) {
            // section route
            $router->post('/saveSection', 'generalInformation\SectionController@saveSection');
            $router->get('/getClassByOrganizationId/{orgId}', 'generalInformation\SectionController@getClassByOrganizationId');
            $router->get('/getStreamByClassId/{classId}', 'generalInformation\SectionController@getStreamByClassId');
            $router->get('/getExistingSectionByClass/{classId}', 'generalInformation\SectionController@getExistingSectionByClass');
			$router->get('/getclassSections/{orgId}', 'generalInformation\SectionController@getclassSections');

        });

        $router->group(['prefix' => 'classMapping'], function () use ($router) {
            // section route
            $router->post('/saveClassMapping', 'generalInformation\ClassMappingController@saveClassMapping');

        });

        $router->group(['prefix' => 'connectivity'], function () use ($router) {
            // connectivity route
            $router->post('/saveConnectivity', 'generalInformation\ConnectivityController@saveConnectivity');
            $router->get('/getRoadTypeDropdown', 'generalInformation\ConnectivityController@getRoadTypeDropdown');
            $router->get('/getElectricitySourceDropdown', 'generalInformation\ConnectivityController@getElectricitySourceDropdown');
            $router->get('/getElectricitySupplyDropdown', 'generalInformation\ConnectivityController@getElectricitySupplyDropdown');
            $router->get('/getElectricitySupplyDropdown', 'generalInformation\ConnectivityController@getElectricitySupplyDropdown');
            $router->get('/getServiceProviderDropdown', 'generalInformation\ConnectivityController@getServiceProviderDropdown');
            $router->get('/getServiceProviderDropdown1', 'generalInformation\ConnectivityController@getServiceProviderDropdown1');
            $router->get('/getContactTypeDropdown', 'generalInformation\ConnectivityController@getContactTypeDropdown');

        });
        $router->group(['prefix' => 'location'], function () use ($router) {
            // locations route
            $router->post('/saveLocation', 'generalInformation\LocationsController@saveLocation');
            $router->get('/getLocationDetails/{orgId}', 'generalInformation\LocationsController@getLocationDetails');
            $router->get('/getDisasterListInCheckbox', 'generalInformation\LocationsController@getDisasterListInCheckbox');

        });

        $router->group(['prefix' => 'sport'], function () use ($router) {
            $router->post('/saveSport', 'structuralFacility\SportController@saveSport');
            $router->get('/loadSport/{orgId}', 'structuralFacility\SportController@loadSport');
            $router->get('/getFacilityInDropdown', 'structuralFacility\SportController@getFacilityInDropdown');
            $router->get('/getSupportInDropdown', 'structuralFacility\SportController@getSupportInDropdown');
            $router->get('/getSubFacilityDropdown/{id}', 'structuralFacility\SportController@getSubFacilityDropdown');

        });
        $router->group(['prefix' => 'schoolFeeding'], function () use ($router) {
            $router->post('/saveKitchenStatus', 'structuralFacility\SchoolFeedingController@saveKitchenStatus');
            $router->get('/loadKitchenStatus/{user_id}', ['uses' => 'structuralFacility\SchoolFeedingController@loadKitchenStatus']);
            $router->post('/saveFoodStoreStatus', 'structuralFacility\SchoolFeedingController@saveFoodStoreStatus');
            $router->post('/saveUtensilKitchen', 'structuralFacility\SchoolFeedingController@saveUtensilKitchen');
            $router->post('/saveDinningHall', 'structuralFacility\SchoolFeedingController@saveDinningHall');
            $router->get('/loadFoodStoreStatus/{user_id}', ['uses' => 'structuralFacility\SchoolFeedingController@loadFoodStoreStatus']);
            $router->get('/loadUtensilKitchenStatus/{user_id}', ['uses' => 'structuralFacility\SchoolFeedingController@loadUtensilKitchenStatus']);

        });

        $router->group(['prefix' => 'infrastructure'], function () use ($router) {
            $router->post('/saveInfrastructure', 'structuralFacility\InfrastructureController@saveInfrastructure');
            $router->get('/getCategoryInDropdown', 'structuralFacility\InfrastructureController@getCategoryInDropdown');
            $router->get('/getSubCategoryInDropdown/{categoryId}', 'structuralFacility\InfrastructureController@getSubCategoryInDropdown');
            $router->get('/getStructureFacilityInDropdown', 'structuralFacility\InfrastructureController@getStructureFacilityInDropdown');
            $router->get('/loadInfrastructureList/{orgId}', 'structuralFacility\InfrastructureController@loadInfrastructureList');
            $router->get('/getDesignerDropdown', 'structuralFacility\InfrastructureController@getDesignerDropdown');
            $router->get('/getInfrastructureDetails/{infraId}', 'structuralFacility\InfrastructureController@getInfrastructureDetails');
            $router->post('/saveWashFeeding', 'structuralFacility\InfrastructureController@saveWashFeeding');
            $router->get('/getWashFeeding/{type}', ['uses' => 'structuralFacility\InfrastructureController@getWashFeeding']);

        });

        $router->group(['prefix' => 'establishment'], function () use ($router) {
            $router->get('/getLevelInDropdown', 'establishment\EstablishmentController@getLevelInDropdown');
            $router->get('/getLocationInDropdown', 'establishment\EstablishmentController@getLocationInDropdown');
            $router->post('/saveEstablishment', 'establishment\EstablishmentController@saveEstablishment');
            $router->post('/updateEstablishment', 'establishment\EstablishmentController@updateEstablishment');
            $router->post('/saveClassStream', 'establishment\EstablishmentController@saveClassStream');
            $router->get('/getClass', 'establishment\EstablishmentController@getClass');
            $router->get('/getStream', 'establishment\EstablishmentController@getStream');
            $router->get('/loaddraftApplication/{type}/{user_id}', 'establishment\EstablishmentController@loaddraftApplication');
            $router->post('/saveUploadedFiles', 'establishment\EstablishmentController@saveUploadedFiles');
            $router->get('/loadOrganizationDetails/{user_id}', ['uses' => 'establishment\EstablishmentController@loadOrganizationDetails']);

            //route for student portal
            $router->get('/loadOrganizationDetailsbyOrgId/{id}', ['uses' => 'establishment\EstablishmentController@loadOrganizationDetailsbyOrgId']);

            $router->get('/loadEstbDetailsForVerification/{appNo}', ['uses' => 'establishment\EstablishmentController@loadEstbDetailsForVerification']);
            $router->get('/loadProprietorDetails', ['uses' => 'establishment\EstablishmentController@loadProprietorDetails']);
            $router->get('/loadApprovedOrgs', ['uses' => 'establishment\EstablishmentController@loadApprovedOrgs']);
            $router->get('/loadOrgApplications/{user_id}', ['uses' => 'establishment\EstablishmentController@loadOrgApplications']);
            $router->get('/loadOrgChangeApplications/{user_id}', ['uses' => 'establishment\EstablishmentController@loadOrgChangeApplications']);
            $router->get('/getApprovedOrgDetails/{type}/{key}', ['uses' => 'establishment\EstablishmentController@getApprovedOrgDetails']);
            $router->post('/registerOrganizationDetails', 'establishment\EstablishmentController@registerOrganizationDetails');
            $router->get('/getschoolDetials/{param}', ['uses' => 'establishment\EstablishmentController@getschoolDetials']);
            $router->get('/getFullSchoolDetials/{id}', ['uses' => 'establishment\EstablishmentController@getFullSchoolDetials']);
            $router->get('/getOrgDetailsById/{id}/{usertype}', 'establishment\EstablishmentController@getOrgDetailsById');
            $router->get('/loadorgbyId/{type}/{org_id}', 'establishment\EstablishmentController@loadorgbyId');
            $router->get('/loadorgbygewogId/{gewog_id}', 'establishment\EstablishmentController@loadorgbygewogId');
            $router->get('/getLocationDetails/{id}', ['uses' => 'establishment\EstablishmentController@getLocationDetails']);
            $router->get('/getConnectivityDetails/{id}', ['uses' => 'establishment\EstablishmentController@getConnectivityDetails']);
            $router->get('/getSectionDetails/{id}', ['uses' => 'establishment\EstablishmentController@getSectionDetails']);
        });

        $router->group(['prefix' => 'headQuater'], function () use ($router) {
            $router->post('/saveContactDetails', 'establishment\HeadQuaterController@saveContactDetails');
            $router->post('/saveBasicDetails', 'establishment\HeadQuaterController@saveBasicDetails');
            $router->get('/loadBasicDetails/{user_id}', ['uses' => 'establishment\HeadQuaterController@loadBasicDetails']);
            $router->get('/getsAgencyList/{param}', ['uses' => 'establishment\HeadQuaterController@getsAgencyList']);
            $router->get('/getHeadQuarterDetails/{id}', ['uses' => 'establishment\HeadQuaterController@getHeadQuarterDetails']);

        });

        $router->group(['prefix' => 'changeDetails'], function () use ($router) {
            $router->post('/saveChangeBasicDetails', 'establishment\ChangeBasicDetailsController@saveChangeBasicDetails');
            $router->post('/saveChangeClass', 'establishment\ChangeBasicDetailsController@saveChangeClass');
            $router->get('/loadCurrentOrgDetails/{orgId}', ['uses' => 'establishment\ChangeBasicDetailsController@loadCurrentOrgDetails']);
            $router->get('/loadCurrentProprietorDetails/{orgId}', ['uses' => 'establishment\ChangeBasicDetailsController@loadCurrentProprietorDetails']);
            $router->get('/getCurrentClass', ['uses' => 'establishment\ChangeBasicDetailsController@getCurrentClass']);
            $router->get('/getCurrentStream', ['uses' => 'establishment\ChangeBasicDetailsController@getCurrentStream']);
            $router->get('/getApplicationNo/{userId}', ['uses' => 'establishment\ChangeBasicDetailsController@getApplicationNo']);
            $router->get('/loadChangeDetailForVerification/{appNo}', ['uses' => 'establishment\ChangeBasicDetailsController@loadChangeDetailForVerification']);
            $router->get('/loadPriviousOrgDetails/{orgId}', ['uses' => 'establishment\ChangeBasicDetailsController@loadPriviousOrgDetails']);
            $router->post('/updateChangeBasicDetails', 'establishment\ChangeBasicDetailsController@updateChangeBasicDetails');
        });

        $router->group(['prefix' => 'bifurcation'], function () use ($router) {
            $router->post('/saveBifurcation', 'restructuring\BifurcationController@saveBifurcation');
            $router->get('/loadbifurcationForVerification/{appNo}', ['uses' => 'restructuring\BifurcationController@loadbifurcationForVerification']);
            // $router->get('/loadBifurcation', 'restructuring\BifurcationController@loadBifurcation');

        });

        $router->group(['prefix' => 'merger'], function () use ($router) {
            $router->post('/saveMerger', 'restructuring\MergerController@saveMerger');
            $router->get('/loadMergerForVerification/{appNo}', ['uses' => 'restructuring\MergerController@loadMergerForVerification']);

        });
        $router->group(['prefix' => 'closure'], function () use ($router) {
            $router->post('/saveClosure', 'restructuring\ClosureController@saveClosure');
            $router->get('/loadClosureApplicationDetails/{appNo}', ['uses' => 'restructuring\ClosureController@loadClosureApplicationDetails']);
            $router->post('/updateClosure', 'restructuring\ClosureController@updateClosure');

        });
        
        $router->post('/udpateOrgProfile', 'establishment\EstablishmentController@udpateOrgProfile');
       
        
    });
    $router->group(['prefix' => 'loadOrganization'], function () use ($router) {
        $router->get('/loadOrgList/{type}/{id}', ['uses' => 'LoadOrganizationController@loadOrgList']);
        $router->get('/loadOrgDetails/{type}/{id}', ['uses' => 'LoadOrganizationController@loadOrgDetails']);
        $router->get('/loadClassStreamSection/{type}/{id}', ['uses' => 'LoadOrganizationController@loadClassStreamSection']);
        $router->get('/loadHeaquarterList/{type}/{id}', ['uses' => 'LoadOrganizationController@loadHeaquarterList']);
        $router->get('/getOrgProfile/{id}', ['uses' => 'LoadOrganizationController@getOrgProfile']);
    });
});
