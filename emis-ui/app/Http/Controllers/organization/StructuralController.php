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
            'organizationId'                        =>  $request['organizationId'],
            'facility'                              =>  $request['facility'],
            'type'                                  =>  $request['type'],
            'yearOfEstablish'                       =>  $request['yearOfEstablish'],
            'status'                                =>  $request['status'],
            'supportedBy'                           =>  $request['supportedBy'],
            'numberOfFacility'                      =>  $request['numberOfFacility'], 
            'facilityAccessibleToDisabled'          =>  $request['facilityAccessibleToDisabled'],
            'id'                                    =>  $request['id'],
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/sport/saveSport', $sport);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
    
    public function loadSport(Request $request){
        $loadSport = $this->apiService->listData('emis/organization/sport/loadSport');
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
            'structureNo'                =>  'required',
            'yearOfConstruction'         =>  'required',
            'presentCondition'           =>  'required',
        ];
        $customMessages = [
            'category.required'                 => 'Category is required',
            'structureNo.required'              => 'Structure No./Name is required',
            'yearOfConstruction.required'       => 'Year of Construction is required',
            'presentCondition.required'         => 'Present Condition of Structure is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $infrastructure =[
            'organizationId'            =>  $request['organizationId'],
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
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/infrastructure/saveInfrastructure', $infrastructure);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadInfrastructureList(){
        $list = $this->apiService->listData('emis/organization/infrastructure/loadInfrastructureList');
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

    public function saveKitchenStatus(Request $request){
        $kitchenStatus =[
            'organizationId'             =>  1,
            'kitchen_status'             =>  $request['kitchen_status'],
            'status'                     =>  $request['status'],
            'type'                       =>  $request['type'],
            'id'                         =>  $request['id'],
            'user_id'                    =>  $this->user_id() 
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
        $loadKitchenStatus = $this->apiService->listData('emis/organization/schoolFeeding/loadKitchenStatus/'.$this->user_id() );
        return $loadKitchenStatus;
    }
}
