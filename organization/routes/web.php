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

    $router->group(['prefix' => 'organization/equipment'], function () use ($router) {
        // equipment route
        $router->post('/saveEquipmentAndFurniture', 'generalInformation\EquipmentController@saveEquipmentAndFurniture');
        $router->get('/loadEquipment', 'generalInformation\EquipmentController@loadEquipment');
        $router->get('/getType', 'generalInformation\EquipmentController@getType');
        $router->get('/getItem/{typeId}', 'generalInformation\EquipmentController@getItem');
        $router->get('/getLocationUse', 'generalInformation\EquipmentController@getLocationUse');

    });
    
    $router->group(['prefix' => 'organization/section'], function () use ($router) {
        // section route
        $router->post('/saveSection', 'generalInformation\SectionController@saveSection');
    });

    $router->group(['prefix' => 'organization/connectivity'], function () use ($router) {
         // connectivity route
         $router->post('/saveConnectivity', 'generalInformation\ConnectivityController@saveConnectivity');

    });

    $router->group(['prefix' => 'organization/location'], function () use ($router) {
        // locations route
        $router->post('/saveLocation', 'generalInformation\LocationsController@saveLocation');

   });

   $router->group(['prefix' => 'organization/sport'], function () use ($router) {
        $router->post('/saveSport', 'structuralFacility\SportController@saveSport');
        $router->get('/loadSport', 'structuralFacility\SportController@loadSport');
        $router->get('/getFacilityInDropdown', 'structuralFacility\SportController@getFacilityInDropdown');
        $router->get('/getSupportInDropdown', 'structuralFacility\SportController@getSupportInDropdown');
    });

    $router->group(['prefix' => 'organization/infrastructure'], function () use ($router) {
        $router->post('/saveInfrastructure', 'structuralFacility\InfrastructureController@saveInfrastructure');
        $router->get('/getCategoryInDropdown', 'structuralFacility\InfrastructureController@getCategoryInDropdown');
        $router->get('/getSubCategoryInDropdown/{categoryId}', 'structuralFacility\InfrastructureController@getSubCategoryInDropdown');
        $router->get('/getStructureFacilityInDropdown', 'structuralFacility\InfrastructureController@getStructureFacilityInDropdown');
    });

    $router->group(['prefix' => 'organization/establishment'], function () use ($router) {
        $router->get('/getLevelInDropdown', 'establishment\EstablishmentController@getLevelInDropdown');
        $router->get('/getLocationInDropdown', 'establishment\EstablishmentController@getLocationInDropdown');
        $router->post('/saveEstablishment', 'establishment\EstablishmentController@saveEstablishment');
        $router->post('/saveClassStream', 'establishment\EstablishmentController@saveClassStream');
        $router->get('/getClass', 'establishment\EstablishmentController@getClass');
        $router->get('/getStream', 'establishment\EstablishmentController@getStream');

    });

});
