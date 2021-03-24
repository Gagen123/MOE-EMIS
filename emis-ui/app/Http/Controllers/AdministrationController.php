<?php

namespace App\Http\Controllers;
use Session;
// use Redirect;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;
use Illuminate\Http\Request;

class AdministrationController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    
    public function save_global_masters(Request $request){
        $rules=[];
        if($request['record_type']=="country"){
            $rules = [
                'name'  =>  'required',
                'nationality'  =>  'required',
                'code'  =>  'required',
                'status'    =>  'required',
            ];
        } 
        if($request['record_type']=="dzongkhag"){
            $rules = [
                'name'  =>  'required',
                'code'  =>  'required',
                'status'    =>  'required',
            ];
        }
        $this->validate($request, $rules);
        $data =[ 
            'name'  =>  $request['name'],
            'nationality'  =>  $request['nationality'],
            'code'  =>  $request['code'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'record_type'=>$request['record_type'],
            'user_id'=>$this->user_id() 
        ];
        try{
            
            $response_data= $this->apiService->createData('emis/masters/save_global_masters', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
    
    public function load_global_masters($param=""){
        $global_masters = $this->apiService->listData('emis/masters/load_global_masters/'.$param);
        return $global_masters;
    }

    public function save_sfatt_masters(Request $request){
        $rules=[];
        $customMessages =[];
        if($request['record_type']=="working_agency"){
            $rules = [
                'name'  =>  'required',
                'status'    =>  'required',
            ];
        }
        if($request['record_type']=="sub_major_group" || $request['record_type']=="position_title"){
            $rules = [
                'parent_field'=> 'required',
                'name'  =>  'required',
                'code'  =>  'required',
                'status'    =>  'required',
            ];
            $customMessages = [
                'parent_field.required' => 'This field is required',
            ];
        }
        if($request['record_type']=="staff_qualification"){
            $rules = [
                'parent_field'=> 'required',
                'parent_field1'=> 'required',
                'name'  =>  'required',
                'code'  =>  'required',
                'status'    =>  'required',
            ];
            $customMessages = [
                'parent_field.required' => 'This field is required',
                'parent_field1.required' => 'This field is required',
            ];
        }
        
        if($request['record_type']=="transfer_reason" || $request['record_type']=="mgmn_designation" || $request['record_type']=="major_group" || $request['record_type']=="position_level" || $request['record_type']=="qualificaiton_type" || $request['record_type']=="qualificaiton_level" || $request['record_type']=="relationship" || $request['record_type']=="marital_status"){
            $rules = [
                'name'  =>  'required',
                'code'  =>  'required',
                'status'    =>  'required',
            ];
            $customMessages = [
                'name.required' => 'This field is required',
            ];
        }
        $this->validate($request, $rules,$customMessages);
        $data =[ 
            'name'  =>  $request['name'],
            'parent_field'    =>  $request['parent_field'],
            'parent_field1'    =>  $request['parent_field1'],
            'status'    =>  $request['status'],
            'code'    =>  $request['code'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'record_type'=>$request['record_type'],
            'user_id'=>$this->user_id()
        ];
        // dd($data);
        $response_data= $this->apiService->createData('emis/masters/save_sfatt_masters', $data);
        return $response_data;
    }
    
    public function load_staff_masters($param=""){
        $global_masters = $this->apiService->listData('emis/masters/load_staff_masters/'.$param);
        // dd($global_masters);
        return $global_masters;
    }

    public function loaddzongkhagDetails($id){
        $dzo = $this->apiService->listData('emis/masters/dzongkhag/getallDzongkhag');
        return $dzo;
    }

    public function saveLocation(Request $request){
        $rules = [
            'locationName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'locationName.required' => 'Location Name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $loc =[
            'locationName'  =>  $request['locationName'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->user_id()
        ];
        try{
            $response_data= $this->apiService->createData('emis/masters/location/saveLocation', $loc);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
    
    public function loadLocation(Request $request){
        $dis = $this->apiService->listData('emis/masters/location/loadLocation');
        return $dis;
    }

    public function saveDisaster(Request $request){
        $rules = [
            'disasterName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'disasterName.required' => 'Disaster Name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $dis =[
            'disasterName'  =>  $request['disasterName'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->user_id()
        ];
        // dd($dis);
        try{
            $response_data= $this->apiService->createData('emis/masters/disaster/saveDisaster', $dis);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadDisaster(Request $request){
        $dis = $this->apiService->listData('emis/masters/disaster/loadDisaster');
        return $dis;
    }

    public function saveStructureCategory(Request $request){
        $rules = [
            'structureCategoryName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'structureCategoryName.required' => 'Structure category name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $cat =[
            'structureCategoryName'  =>  $request['structureCategoryName'],
            'description'  =>  $request['description'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->user_id()
        ];
        // dd($cat);
        $response_data= $this->apiService->createData('emis/masters/structureCategory/saveStructureCategory', $cat);
        return $response_data;
        
    }

    public function loadStructureCategory(Request $request){
        $str = $this->apiService->listData('emis/masters/structureCategory/loadStructureCategory');
        return $str;
    }

    public function saveLevel(Request $request){
        $rules = [
            'levelName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'levelName.required' => 'Level name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $cat =[
            'levelName'  =>  $request['levelName'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->user_id()
        ];
        // dd($cat);
        $response_data= $this->apiService->createData('emis/masters/level/saveLevel', $cat);
        return $response_data;
        
    }

    public function loadLevel(Request $request){
        $str = $this->apiService->listData('emis/masters/level/loadLevel');
        return $str;
    }

    public function saveStructureFacility(Request $request){
        $rules = [
            'structureFacilityName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'structureFacilityName.required' => 'Structure facility name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $cat =[
            'structureFacilityName'  =>  $request['structureFacilityName'],
            'description'    =>  $request['description'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->user_id()
        ];
        $response_data= $this->apiService->createData('emis/masters/structureFacility/saveStructureFacility', $cat);
        return $response_data;
        
    }

    public function loadStructureFacility(Request $request){
        $strCategory = $this->apiService->listData('emis/masters/structureFacility/loadStructureFacility');
        return $strCategory;
    }

    public function saveEquipmentType(Request $request){
        $rules = [
            'equipmentTypeName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'equipmentTypeName.required' => 'equipment name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $cat =[
            'equipmentTypeName'  =>  $request['equipmentTypeName'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->user_id()
        ];
        $response_data= $this->apiService->createData('emis/masters/equipmentType/saveEquipmentType', $cat);
        return $response_data;
        
    }

    public function loadEquipmentType(Request $request){
        $strCategory = $this->apiService->listData('emis/masters/equipmentType/loadEquipmentType');
        return $strCategory;
    }

    public function saveEquipmentUsage(Request $request){
        $rules = [
            'equipmentUsageName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'equipmentUsageName.required' => 'equipment usage name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $cat =[
            'equipmentUsageName'  =>  $request['equipmentUsageName'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->user_id()
        ];
        $response_data= $this->apiService->createData('emis/masters/equipmentUsage/saveEquipmentUsage', $cat);
        return $response_data;
        
    }

    public function loadEquipmentUsage(Request $request){
        $strCategory = $this->apiService->listData('emis/masters/equipmentUsage/loadEquipmentUsage');
        return $strCategory;
    }

    public function saveSportFacility(Request $request){
        $rules = [
            'sportFacilityName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'sportFacilityName.required' => 'Sport facility name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $cat =[
            'sportFacilityName'  =>  $request['sportFacilityName'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->user_id()
        ];
        $response_data= $this->apiService->createData('emis/masters/sportFacility/saveSportFacility', $cat);
        return $response_data;
        
    }

    public function loadSportFacility(Request $request){
        $strCategory = $this->apiService->listData('emis/masters/sportFacility/loadSportFacility');
        return $strCategory;
    }

    public function saveSportSupporter(Request $request){
        $rules = [
            'sportSupporterName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'sportSupporterName.required' => 'Sport supporter name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $cat =[
            'sportSupporterName'  =>  $request['sportSupporterName'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->user_id()
        ];
        $response_data= $this->apiService->createData('emis/masters/sportSupporter/saveSportSupporter', $cat);
        return $response_data;
        
    }

    public function loadSportSupporter(Request $request){
        $strCategory = $this->apiService->listData('emis/masters/sportSupporter/loadSportSupporter');
        return $strCategory;
    }

    public function saveStrSubCategory(Request $request){
        $rules = [
            'structureCategory'  =>  'required',
            'subCategoryName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'structureCategory.required' => 'Structure category is required',
            'subCategoryName.required' => 'Sub category name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $cat =[
            'structureCategory'  =>  $request['structureCategory'],
            'subCategoryName'  =>  $request['subCategoryName'],
            'description'  =>  $request['description'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->user_id()
        ];
        $response_data= $this->apiService->createData('emis/masters/structureSubCategory/saveStrSubCategory', $cat);
        return $response_data;
        
    }

    public function loadStrSubCategory(Request $request){
        $strCategory = $this->apiService->listData('emis/masters/structureSubCategory/loadStrSubCategory');
        return $strCategory;
    }

    public function getStrCategoryDropdown(Request $request){
        $strCategory = $this->apiService->listData('emis/masters/structureSubCategory/getStrCategoryDropdown');
        return $strCategory;
    }

    public function saveEquipmentItem(Request $request){
        $rules = [
            'equipmentItem'  =>  'required',
            'equipmentType'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'equipmentItem.required' => 'Equipment item is required',
            'equipmentType.required' => 'Equipment type name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $cat =[
            'equipmentItem'  =>  $request['equipmentItem'],
            'equipmentType'  =>  $request['equipmentType'],
            'description'  =>  $request['description'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->user_id()
        ];
        $response_data= $this->apiService->createData('emis/masters/equipmentItem/saveEquipmentItem', $cat);
        return $response_data;
        
    }

    public function saveClass(Request $request){
        $rules = [
            'className'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'className.required' => 'Class is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $class =[
            'className'  =>  $request['className'],
            'status'  =>  $request['status'],
            'id'    =>  $request['id'],
            'user_id'=>$this->user_id()
        ];
        $response_data= $this->apiService->createData('emis/masters/class/saveClass', $class);
        return $response_data;
        
    }

    public function loadClass(Request $request){
            $loadClass = $this->apiService->listData('emis/masters/class/loadClass');
        return $loadClass;
    }

    public function getEquipmentTypeDropdown(Request $request){
        $strCategory = $this->apiService->listData('emis/masters/equipmentItem/getEquipmentTypeDropdown');
        return $strCategory;
    }

    public function loadEquipmentItem(Request $request){
        $strCategory = $this->apiService->listData('emis/masters/equipmentItem/loadEquipmentItem');
        return $strCategory;
    }

    public function saveStream(Request $request){
        $rules = [
            'streamName'    =>  'required',
            'status'        =>  'required',
        ];
        $customMessages = [
            'streamName.required'   => 'Stream is required',
            'status.required'       => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $stream =[
            'streamName'    =>  $request['streamName'],
            'status'        =>  $request['status'],
            'id'            =>  $request['id'],
            'user_id'       =>$this->user_id()
        ];
        $response_data= $this->apiService->createData('emis/masters/stream/saveStream', $stream);
        return $response_data;
    }

    public function getClassInDropdown(Request $request){
        $classDropdown = $this->apiService->listData('emis/masters/stream/getClassInDropdown');
        return $classDropdown;
    }

    public function loadStream(Request $request){
        $loadStream = $this->apiService->listData('emis/masters/stream/loadStream');
        return $loadStream;
    }

    public function saveStudentHealth(Request $request){
        $rules = [
            'studenthealthName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'studenthealthName.required' => 'Name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $dis =[
            'studenthealthName'  =>  $request['studenthealthName'],
        ];
        
    }
    public function loadStudentHealth(Request $request){
        
        $dis = $this->apiService->listData('masters/studentHealth/loadStudentHealth');
        return $dis;
    }

    public function saveScreening(Request $request){
        $rules = [
            'screeningName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'screeningName.required' => 'Name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $src =[
            'screeningName'  =>  $request['screeningName'],
        ];
       
    }
    public function loadScreening(Request $request){
        
        $src = $this->apiService->listData('masters/screening/loadScreening');
        return $src;
    }
    //student_helth_term_controller
    public function saveTerm(Request $request){
        $rules = [
            'termName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'termName.required' => 'Term Name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $dis =[
            'termName'  =>  $request['termName'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
        ];
        // dd($dis);
        try{
            $response_data= $this->apiService->createData('masters/term/saveTerm', $dis);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadTerm(Request $request){
        $dis = $this->apiService->listData('masters/term/loadTerm');
        return $dis;
    }
    
    
}