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
            'facility'                   =>  'required',
            
        ];
        $customMessages = [
            'facility.required'          => 'Facility is required',
            
        ];
        $this->validate($request, $rules, $customMessages);
        $sport =[
            'organizationId'                        =>  $this->getWrkingAgencyId(),
            'facility'                              =>  $request['facility'],
           // 'support'                               =>  $request['support'],
            'items_received'                        =>  $request->items_received,
            'user_id'                               =>  $this->userId()
        ];
        // try{
            $response_data= $this->apiService->createData('emis/organization/sport/saveSport', $sport);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
    }

    public function getSportsDetails($sportId=""){
       // dd($sportId);
        $sportDetails = $this->apiService->listData('emis/organization/sport/getSportsDetails/'.$sportId);
        return $sportDetails;
    }

    public function saveEccd(Request $request){
        $rules = [
            'facility'          =>  'required',
            'status'            =>  'required',
        ];
        $customMessages = [
            'facility.required'         => 'Facility is required',
            'status.required'           => 'TyCurrent Status is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $sport =[
            'organizationId'                        =>  $this->getWrkingAgencyId(),
            'facility'                              =>  $request['facility'],
            'yearOfEstablish'                       =>  $request['yearOfEstablish'],
            'status'                                =>  $request['status'],
            'area'                                  =>  $request['area'],
            'supportedBy'                           =>  $request['supportedBy'],
            'numberOfFacility'                      =>  $request['numberOfFacility'], 
            'id'                                    =>  $request['id'],
            'user_id'                               =>  $this->userId()
        ];
        // try{
            $response_data= $this->apiService->createData('emis/organization/sport/saveEccd', $sport);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
    }
    
    public function loadSport(){
        $orgId=$this->getWrkingAgencyId();
       // dd($orgId);
        $loadSport = $this->apiService->listData('emis/organization/sport/loadSport/'.$orgId);
        return $loadSport;
    }
    public function loadeccd($orgId=""){
        if($orgId=="null" || $orgId==""){
            $orgId=$this->getWrkingAgencyId();
        }
        $loadSport = $this->apiService->listData('emis/organization/sport/loadeccd/'.$orgId);
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
            'constructionType'          =>  $request['constructionType'],
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
        $response_data= $this->apiService->createData('emis/organization/infrastructure/saveInfrastructure', $infrastructure);
        return $response_data;
        // try{
            // $response_data= $this->apiService->createData('emis/organization/infrastructure/saveInfrastructure', $infrastructure);
            // return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
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
    public function saveWashFeeding(Request $request){
        $infra_data =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'questionList'              =>  $request->questionList,
            'type'                      =>  $request->type,
            'user_id'                   =>  $this->userId() 
        ];
        // dd($request->questionList);
        $response_data= $this->apiService->createData('emis/organization/infrastructure/saveWashFeeding', $infra_data);
        return $response_data;
    }
    public function getWashFeeding($type=""){
        $wash_feeding_detials = $this->apiService->listData('emis/organization/infrastructure/getWashFeeding/'.$type.'SSS'.$this->getWrkingAgencyId());
        return $wash_feeding_detials;
    }
    
    public function saveEccdFacilities(Request $request){
        $eccd_data =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'questionList'              =>  $request->questionList,
            'type'                      =>  $request->type,
            'user_id'                   =>  $this->userId() 
        ];
        // dd($request->questionList);
        $response_data= $this->apiService->createData('emis/organization/infrastructure/saveEccdFacilities', $eccd_data);
        return $response_data;
    }
    public function getEccdFacilitiesList($type=""){
        $eccd_facilities_detials = $this->apiService->listData('emis/organization/infrastructure/getEccdFacilitiesList/'.$type.'SSS'.$this->getWrkingAgencyId());
        return $eccd_facilities_detials;
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
        // try{
            $response_data= $this->apiService->createData('emis/organization/schoolFeeding/saveKitchenStatus', $kitchenStatus);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
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
        // try{
            $response_data= $this->apiService->createData('emis/organization/schoolFeeding/saveFoodStoreStatus', $foodStatus);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
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
        // try{
            $response_data= $this->apiService->createData('emis/organization/schoolFeeding/saveUtensilKitchen', $equipmentKitchen);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
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
        // try{
            $response_data= $this->apiService->createData('emis/organization/schoolFeeding/saveDinningHall', $dinningHall);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
    }

    public function loadFoodStoreStatus(){
        $loadFoodStoreStatus = $this->apiService->listData('emis/organization/schoolFeeding/loadFoodStoreStatus/'.$this->userId() );
        return $loadFoodStoreStatus;
    }

    public function loadUtensilKitchenStatus(){
        $utensil = $this->apiService->listData('emis/organization/schoolFeeding/loadUtensilKitchenStatus/'.$this->userId() );
        return $utensil;
    }
    //eccd infrastructure
    public function getStructureTypeInDropdown(){
        $categoryDropdown = $this->apiService->listData('emis/organization/eccdinfrastructure/getStructureTypeInDropdown');
        return $categoryDropdown;
    }
    
    public function geteccdStructureFacilityInDropdown($structuretype=""){
    // dd($$structuretype);
        $subCategoryDropdown = $this->apiService->listData('emis/organization/eccdinfrastructure/geteccdStructureFacilityInDropdown/'.$structuretype);
        return $subCategoryDropdown;
    }

    public function saveEccdInfrastructure(Request $request){
        $rules = [
            'structuretype'                   =>  'required',
            'constructionType'                =>  'required',
            'yearOfConstruction'              =>  'required',
            // 'presentCondition'           =>  'required',
        ];
        $customMessages = [
            'structuretype.required'                 => 'Structure Type is required',
            'constructionType.required'              => 'Construction Type is required',
            'yearOfConstruction.required'            => 'Year of Construction is required',
            // 'presentCondition.required'         => 'Present Condition of Structure is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $eccdinfrastructure =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'structuretype'             =>  $request['structuretype'],
            'constructionType'          =>  $request['constructionType'],
            'yearOfConstruction'        =>  $request['yearOfConstruction'],
            'plintchArea'               =>  $request['plintchArea'],
            'noOfFloor'                 =>  $request['noOfFloor'], 
            'totalCapacity'             =>  $request['totalCapacity'],
           // 'rampAccess'                =>  $request['rampAccess'],
            'presentCondition'          =>  $request['presentCondition'],
            'design'                    =>  $request['design'],
            'id'                        =>  $request['id'],
            'users'                     =>  $request['users'],
            'user_id'                   =>  $this->userId()
        ];
        //  dd($eccdinfrastructure);
        $response_data= $this->apiService->createData('emis/organization/eccdinfrastructure/saveEccdInfrastructure', $eccdinfrastructure);
        return $response_data;
    }

    public function loadEccdInfrastructureList($orgId=""){
       if($orgId=="null" || $orgId==""){
            $orgId=$this->getWrkingAgencyId();
        }
    // dd($orgId);
        $list = $this->apiService->listData('emis/organization/eccdinfrastructure/loadEccdInfrastructureList/'.$orgId);
        return $list;
    }

    public function getEccdInfrastructureDetails($eccdinfraId=""){
        $infraDetails = $this->apiService->listData('emis/organization/eccdinfrastructure/getEccdInfrastructureDetails/'.$eccdinfraId);
        return $infraDetails;
    }
}
