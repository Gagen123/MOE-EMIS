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
use Illuminate\Support\Facades\Storage;

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

    public function loadEquipment($orgId=""){
        if($orgId=="null" || $orgId==""){
            $orgId=$this->getWrkingAgencyId();
            
        }
        $dis = $this->apiService->listData('emis/organization/equipment/loadEquipment/'.$orgId);
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
            'users'      =>  'required',"array","min:2",
        ];
        $customMessages = [
            'school.required'       => 'School is required',
            'classes.required'      => 'Class field is required',
            'users.required'        => 'Please mention section',
            'users.min'             => 'Atleast 2 section is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $loc =[
            'school'                    =>  $request['school'],
            'classes'                   =>  $request['classes'],
            'class_stream_id'           =>  $request['class_stream_id'],
            'stream'                    =>  $request['stream'],
            'users'                     =>  $request['users'],
            'actiontype'                =>  $request['action_type'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/organization/section/saveSection', $loc);
        return $response_data;
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
        if($orgId != "undefined" && $orgId != null){
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

        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $remarks = $request->remarks;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'Organization';
        if($files!=null && $files!=""){
            if(sizeof($files)>0 && !is_dir($file_store_path)){
                mkdir($file_store_path,0777,TRUE);
            }
            if(sizeof($files)>0){
                foreach($files as $index => $file){
                    $file_name = time().'_' .$file->getClientOriginalName();
                    move_uploaded_file($file,$file_store_path.'/'.$file_name);
                    array_push($attachment_details,
                        array(
                            'path'                   =>  $file_store_path,
                            'original_name'          =>  $file_name,
                            'user_defined_name'      =>  $filenames[$index],
                            // 'remark'                 =>  $remarks[$index]
                        )
                    );
                }
            }
        }   
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
            'attachment_details'    =>  $attachment_details,
            'user_id'               =>  $this->userId()
        ];
        // dd($loc);
        $response_data= $this->apiService->createData('emis/organization/location/saveLocation', $loc);
        return $response_data;
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

    public function getExistingSectionByClass($classId = ""){
        $sectionList = $this->apiService->listData('emis/organization/section/getExistingSectionByClass/'.$classId);
        return $sectionList;
    }
    public function loadOrganizationByDzoId($dzo_id = ""){
        if($dzo_id == ""){
            $dzo_id=$this->getUserDzoId();
        }
        $orgList = $this->apiService->listData('emis/organization/getOrgList/'.$dzo_id);
        return $orgList;
    }
    public function getClassByOrg($id=""){  
        if($id=="sessionDet"){
            $id=$this->getWrkingAgencyId();
        }
        $response_data = $this->apiService->listData('emis/organization/getClassByOrg/'.$id);
        return $response_data;
    }

    
    public function udpateOrgProfile(Request $request){
        $file = $request->attachments;
        $path="";
        $file_store_path='orgProfile';
        if($file!=null && $file!="" && $file!="undefined"){
            $fle="public/".$request->profile_path;
            if (Storage::exists($fle)){
                Storage::delete($fle);
            }
            $file_name = time().'_' .$file->getClientOriginalName();
            $file_path = $request->file('attachments')->storeAs($file_store_path, $file_name, 'public');
            $path=$file_store_path.'/'.$file_name;
        }
        $org_details =[
            'org_id'            =>  $request['org_id'],
            'vission'           =>  $request['vission'],
            'mission'           =>  $request['mission'],
            'attachments'       =>  $path, 
            'user_id'           =>  $this->userId()
        ];
        // dd($org_details);
        $response_data= $this->apiService->createData('emis/organization/udpateOrgProfile', $org_details);
        return $response_data;
    }
    
    public function getOrgProfile($id = ""){
        $org_details = $this->apiService->listData('emis/organization/getOrgProfile/'.$id);
        return $org_details;
    }

}
