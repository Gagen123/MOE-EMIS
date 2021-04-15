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

class GeneralInfoController extends Controller
{
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveEquipment(Request $request){
        $rules = [
            'type'          =>  'required',
            'item'          =>  'required',
            'location'      =>  'required',
            'number'        =>  'required',
        ];
        $customMessages = [
            'type.required'         => 'Type is required',
            'item.required'         => 'Item is required',
            'location.required'     => 'Location/Use is required',
            'number.required'       => 'Number is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $loc =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'type'                      =>  $request['type'],
            'item'                      =>  $request['item'],
            'location'                  =>  $request['location'],
            'number'                    =>  $request['number'],
            'actiontype'                =>  $request['action_type'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/equipment/saveEquipmentAndFurniture', $loc);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadEquipment(Request $request){
        $dis = $this->apiService->listData('emis/organization/equipment/loadEquipment/'.$this->getWrkingAgencyId());
        return $dis;
    }

    public function getType(){
        $type = $this->apiService->listData('emis/organization/equipment/getType');
        return $type;
    }
    public function getItem($itemId = ""){
        $itemList = $this->apiService->listData('emis/organization/equipment/getItem/'.$itemId);
        return $itemList;
    }

    public function getLocationUse(){
        $locationUse = $this->apiService->listData('emis/organization/equipment/getLocationUse');
        return $locationUse;
    }

    public function saveSection(Request $request){
        $rules = [
            'school'     =>  'required',
            'classes'    =>  'required',
        ];
        $customMessages = [
            'school.required'       => 'School is required',
            'classes.required'      => 'Class field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $loc =[
            'school'                    =>  $request['school'],
            'classes'                   =>  $request['classes'],
            'stream'                    =>  $request['stream'],
            'users'                     =>  $request['users'],
            'actiontype'                =>  $request['action_type'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/section/saveSection', $loc);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function saveConnectivity(Request $request){
        $orgId = $request->organizationId;
        if($orgId != null){
            $orgId = $orgId;
        }else{
            $orgId = $this->getWrkingAgencyId();
        }
        $rules = [
            'approachRoad'          =>  'required',
            'electricitySource'     =>  'required',
            'telephone'             =>  'required',
            'internet'              =>  'required',
        ];
        $customMessages = [
            'approachRoad.required'         => 'Approach Road is required',
            'electricitySource.required'    => 'Electricity Source field is required',
            'telephone.required'            => 'Telephone Service Provider field is required',
            'internet.required'             => 'Internet Service Provider field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $connectivity =[
            'organizationId'            =>  $orgId,
            'approachRoad'              =>  $request['approachRoad'],
            'electricitySource'         =>  $request['electricitySource'],
            'telephone'                 =>  $request['telephone'],
            'internet'                  =>  $request['internet'],
            'distanceFromRoad'          =>  $request['distanceFromRoad'],
            'daysFromRoad'              =>  $request['daysFromRoad'],
            'hoursFromRoad'             =>  $request['hoursFromRoad'],
            'electricitySupply'         =>  $request['electricitySupply'],
            'electricalSubstation'      =>  $request['electricalSubstation'],
            'bandwidth'                 =>  $request['bandwidth'],
            'drukRen'                   =>  $request['drukRen'],
            'id'                        =>  $request['id'],
            'users'                     =>  $request['users'],
            'user_id'                   =>  $this->userId()
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/connectivity/saveConnectivity', $connectivity);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function getRoadTypeDropdown(){
        $roadType = $this->apiService->listData('emis/organization/connectivity/getRoadTypeDropdown');
        return $roadType;
    }

    public function getElectricitySourceDropdown(){
        $electriSource = $this->apiService->listData('emis/organization/connectivity/getElectricitySourceDropdown');
        return $electriSource;
    }

    public function getElectricitySupplyDropdown(){
        $electriSupply = $this->apiService->listData('emis/organization/connectivity/getElectricitySupplyDropdown');
        return $electriSupply;
    }

    public function getServiceProviderDropdown(){
        $serviceProvider = $this->apiService->listData('emis/organization/connectivity/getServiceProviderDropdown');
        return $serviceProvider;
    }
    
    public function getServiceProviderDropdown1(){
        $serviceProvider = $this->apiService->listData('emis/organization/connectivity/getServiceProviderDropdown1');
        return $serviceProvider;
    }

    public function getContactTypeDropdown(){
        $serviceProvider = $this->apiService->listData('emis/organization/connectivity/getContactTypeDropdown');
        return $serviceProvider;
    }

    public function saveLocation(Request $request){
        $orgId = $request->organizationId;
        if($orgId != null){
            $orgId = $orgId;
        }else{
            $orgId = $this->getWrkingAgencyId();
        }
        $rules = [
            'landOwnership'         =>  'required',
            'compoundFencing'       =>  'required',
            'entranceGate'          =>  'required',
            'thramNo'               =>  'required',
            'compoundArea'          =>  'required',
        ];
        $customMessages = [
            'landOwnership.required'        => 'Land Ownership is required',
            'compoundFencing.required'      => 'Compound Fencing is required',
            'entranceGate.required'         => 'Entrance Gate is required',
            'thramNo.required'              => 'Thram No is required',
            'compoundArea.required'         => 'Compound Area is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $loc =[
            'organizationId'        =>  $orgId,
            'landOwnership'         =>  $request['landOwnership'],
            'compoundFencing'       =>  $request['compoundFencing'],
            'entranceGate'          =>  $request['entranceGate'],
            'longitude'             =>  $request['longitude'],
            'latitude'              =>  $request['latitude'],
            'altitude'              =>  $request['altitude'],
            'thramNo'               =>  $request['thramNo'],
            'cid'                   =>  $request['cid'],
            'name'                  =>  $request['name'],
            'compoundArea'          =>  $request['compoundArea'],
            'id'                    =>  $request['id'],
            'disaster'              =>  $request['disaster'],
            'user_id'               =>  $this->userId()
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/location/saveLocation', $loc);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function getDisasterListInCheckbox(){
        $disasterList = $this->apiService->listData('emis/organization/location/getDisasterListInCheckbox');
        return $disasterList;
    }

    public function saveClassMapping(Request $request){
        $rules = [
            'school'         =>  'required',
            'class'          =>  'required',
        ];
        $customMessages = [
            'school.required'        => 'School is required',
            'class.required'         => 'Class is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $loc =[
            'school'        =>  $request['school'],
            'class'         =>  $request['class'],
            'id'            =>  $request['id'],
        ];
        try{
            $response_data= $this->apiService->createData('emis/organization/classMapping/saveClassMapping', $loc);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function getClassByOrganizationId($orgId = ""){
        $itemList = $this->apiService->listData('emis/organization/section/getClassByOrganizationId/'.$orgId);
        return $itemList;
    }

    public function getStreamByClassId($classId = ""){
        $itemList = $this->apiService->listData('emis/organization/section/getStreamByClassId/'.$classId);
        return $itemList;
    }
}
