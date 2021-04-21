<?php

namespace App\Http\Controllers\organization;

use Session;
// use Redirect;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\AuthUser;


class StructuralController extends Controller
{
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveSport(Request $request){
        $rules = [
            'facility'          =>  'required',
            'type'              =>  'required',
            'status'            =>  'required',
        ];
        $customMessages = [
            'facility.required'         => 'Facility is required',
            'type.required'             => 'Type is required',
            'status.required'           => 'TyCurrent Status is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $sport =[
            'organizationId'                        =>  $this->getWrkingAgencyId(),
            'facility'                              =>  $request['facility'],
            'type'                                  =>  $request['type'],
            'yearOfEstablish'                       =>  $request['yearOfEstablish'],
            'status'                                =>  $request['status'],
            'supportedBy'                           =>  $request['supportedBy'],
            'numberOfFacility'                      =>  $request['numberOfFacility'], 
            'facilityAccessibleToDisabled'          =>  $request['facilityAccessibleToDisabled'],
            'id'                                    =>  $request['id'],
            'user_id'                               =>  $this->userId()
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/sport/saveSport', $sport);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
    
    public function loadSport($orgId=""){
        if($orgId=="null" || $orgId==""){
            $orgId=$this->getWrkingAgencyId();
        }
        $loadSport = $this->apiService->listData('emis/organization/sport/loadSport/'.$orgId);
        return $loadSport;
    }

    public function getFacilityInDropdown(Request $request){
        $facilityDropdown = $this->apiService->listData('emis/organization/sport/getFacilityInDropdown');
        return $facilityDropdown;
    }

    public function getSupportInDropdown(Request $request){
        $supportDropdown = $this->apiService->listData('emis/organization/sport/getSupportInDropdown');
        return $supportDropdown;
    }

    public function saveInfrastructure(Request $request){
        $rules = [
            'category'                   =>  'required',
            'subCategory'                =>  'required',
            'yearOfConstruction'         =>  'required',
            // 'presentCondition'           =>  'required',
        ];
        $customMessages = [
            'category.required'                 => 'Category is required',
            'subCategory.required'              => 'Sub Category is required',
            'yearOfConstruction.required'       => 'Year of Construction is required',
            // 'presentCondition.required'         => 'Present Condition of Structure is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $infrastructure =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'category'                  =>  $request['category'],
            'subCategory'               =>  $request['subCategory'],
            'structureNo'               =>  $request['structureNo'],
            'yearOfConstruction'        =>  $request['yearOfConstruction'],
            'plintchArea'               =>  $request['plintchArea'],
            'noOfFloor'                 =>  $request['noOfFloor'], 
            'totalCapacity'             =>  $request['totalCapacity'],
            'rampAccess'                =>  $request['rampAccess'],
            'presentCondition'          =>  $request['presentCondition'],
            'design'                    =>  $request['design'],
            'id'                        =>  $request['id'],
            'users'                     =>  $request['users'],
            'user_id'                   =>  $this->userId()
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/infrastructure/saveInfrastructure', $infrastructure);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadInfrastructureList($orgId=""){
        if($orgId=="null" || $orgId==""){
            $orgId=$this->getWrkingAgencyId();
        }
        $list = $this->apiService->listData('emis/organization/infrastructure/loadInfrastructureList/'.$orgId);
        return $list;
    }
                            
    public function getCategoryInDropdown(){
        $categoryDropdown = $this->apiService->listData('emis/organization/infrastructure/getCategoryInDropdown');
        return $categoryDropdown;
    }

    public function getSubCategoryDropdown($categoryId = ""){
        $subCategoryDropdown = $this->apiService->listData('emis/organization/infrastructure/getSubCategoryInDropdown/'.$categoryId);
        return $subCategoryDropdown;
    }

    public function getStructureFacilityInDropdown(){
        $dropdown = $this->apiService->listData('emis/organization/infrastructure/getStructureFacilityInDropdown');
        return $dropdown;
    }

    public function getSubFacilityDropdown($facilityId=""){
        $dropdown = $this->apiService->listData('emis/organization/sport/getSubFacilityDropdown/'.$facilityId);
        return $dropdown;
    }

    public function getDesignerDropdown(){
        $serviceProvider = $this->apiService->listData('emis/organization/infrastructure/getDesignerDropdown');
        return $serviceProvider;
    }

    public function getInfrastructureDetails($infraId=""){
        $infraDetails = $this->apiService->listData('emis/organization/infrastructure/getInfrastructureDetails/'.$infraId);
        return $infraDetails;
    }

    public function saveKitchenStatus(Request $request){
        $kitchenStatus =[
            'organizationId'             =>  $this->getWrkingAgencyId(),
            'kitchen_status'             =>  $request['kitchen_status'],
            'status'                     =>  $request['status'],
            'type'                       =>  $request['type'],
            'id'                         =>  $request['id'],
            'user_id'                    =>  $this->userId() 
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/schoolFeeding/saveKitchenStatus', $kitchenStatus);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadKitchenStatus(){
        $loadKitchenStatus = $this->apiService->listData('emis/organization/schoolFeeding/loadKitchenStatus/'.$this->userId() );
        return $loadKitchenStatus;
    }

    public function saveFoodStoreStatus(Request $request){
        $foodStatus =[
            'organizationId'             =>  $this->getWrkingAgencyId(),
            'food_status'                =>  $request['food_status'],
            'status'                     =>  $request['status'],
            'type'                       =>  $request['type'],
            'id'                         =>  $request['id'],
            'user_id'                    =>  $this->userId() 
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/schoolFeeding/saveFoodStoreStatus', $foodStatus);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function saveUtensilKitchen(Request $request){
        $equipmentKitchen =[
            'organizationId'             =>  $this->getWrkingAgencyId(),
            'equipment_kitchen'          =>  $request['equipment_kitchen'],
            'status'                     =>  $request['status'],
            'type'                       =>  $request['type'],
            'id'                         =>  $request['id'],
            'user_id'                    =>  $this->userId() 
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/schoolFeeding/saveUtensilKitchen', $equipmentKitchen);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function saveDinningHall(Request $request){
        $dinningHall =[
            'organizationId'             =>  $this->getWrkingAgencyId(),
            'dinning_hall'               =>  $request['dinning_hall'],
            'status'                     =>  $request['status'],
            'type'                       =>  $request['type'],
            'id'                         =>  $request['id'],
            'user_id'                    =>  $this->userId() 
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/schoolFeeding/saveDinningHall', $dinningHall);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadFoodStoreStatus(){
        $loadFoodStoreStatus = $this->apiService->listData('emis/organization/schoolFeeding/loadFoodStoreStatus/'.$this->userId() );
        return $loadFoodStoreStatus;
    }

    public function loadUtensilKitchenStatus(){
        $utensil = $this->apiService->listData('emis/organization/schoolFeeding/loadUtensilKitchenStatus/'.$this->userId() );
        return $utensil;
    }
}
