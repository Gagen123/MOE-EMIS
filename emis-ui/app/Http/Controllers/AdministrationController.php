<?php

namespace App\Http\Controllers;
use Session;
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

    public function saveGlobalMasters(Request $request){
        $rules=[];
        $customMessages =[];
        if($request['record_type']=="country"){
            $rules = [
                'name'          =>  'required',
                'nationality'   =>  'required',
                'code'          =>  'required',
                'status'        =>  'required',
            ];
        }
        if($request['record_type']=="dzongkhag" || $request['record_type']=="gender"){
            $rules = [
            'name'          =>  'required',
                'code'      =>  'required',
                'status'    =>  'required',
            ];
        }
        if($request['record_type']=="gewog" || $request['record_type']=="village"){
            $rules = [
                'name'          =>  'required',
                'parent_field'  => 'required',
                'code'          =>  'required',
                'status'        =>  'required',
            ];
            $customMessages = [
                'parent_field.required' => 'This field is required',
            ];
        }
        $this->validate($request, $rules,$customMessages);
        $data =[
            'name'                  =>  $request['name'],
            'nationality'           =>  $request['nationality'],
            'parent_field'          =>  $request['parent_field'],
            'code'                  =>  $request['code'],
            'guideline_for'         =>  $request['guideline_for'],
            'guidelines'            =>  $request['guidelines'],
            'status'                =>  $request['status'],
            'actiontype'            =>  $request['action_type'],
            'id'                    =>  $request['id'],
            'record_type'           =>$request['record_type'],
            'user_id'               =>$this->userId()
        ];
        // dd($data);
        try{
            $response_data= $this->apiService->createData('emis/masters/saveGlobalMasters', $data);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadGlobalMasters($param=""){
        $global_masters = $this->apiService->listData('emis/masters/loadGlobalMasters/'.$param);
        return $global_masters;
    }

    public function getroles($param){
        // dd($this->getRoleIds('roleIds'));
        $param=$param.'SSS'.$this->getAccessLevel().'SSS'.$this->getUserDzoId().'SSS'.$this->getWrkingAgencyId().'SSS'.$this->getRoleIds('roleIds');
        $system = $this->apiService->listData('system/get_roles/'.$param);
        return $system;
    }

    public function all_active_dropdowns($model="",$parent_id=""){
        $response_data = $this->apiService->listData('emis/masters/load_dropdown/'.$model."/".$parent_id);
        return $response_data;
    }

    public function saveStaffMasters(Request $request){
        $rules=[];
        $customMessages =[];
        $rules = [
            'name'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'name.required' => 'This field is required',
            'status.required' => 'This field is required',
        ];
        if($request['record_type']=="transfer_reason" || $request['record_type']=="mgmn_designation" || $request['record_type']=="major_group"
        || $request['record_type']=="position_level" || $request['record_type']=="qualificaiton_type" || $request['record_type']=="qualificaiton_level"
        || $request['record_type']=="relationship" || $request['record_type']=="marital_status" || $request['record_type']=="subject_area"
        || $request['record_type']=="cureer_stage" || $request['record_type']=="qualification_description" || $request['record_type']=="course_mode"
        || $request['record_type']=="sub_major_group" || $request['record_type']=="position_title" || $request['record_type']=="staff_subject"
        || $request['record_type']=="staff_qualification" || $request['record_type']=="staff_qualification" || $request['record_type']=="staff_award_category"
        || $request['record_type']=="staff_award_type" || $request['record_type']=="staff_role_responsibility" || $request['record_type']=="staff_offence_type"
        || $request['record_type']=="staff_offence_severity" || $request['record_type']=="staff_offence_action" || $request['record_type']=="leave_type"){
            $rules=array_merge($rules,
                array('code'  =>  'required|numeric|digits:4',)
            );
            $customMessages=array_merge($customMessages,
                array('code.required'  =>  'This field is required',
                'code.numeric'         => 'The field must be numeric.',
                'code.digits'          => 'The field should be of 4 digits.',)
            );
        }
        if($request['record_type']=="sub_major_group" || $request['record_type']=="position_title" || $request['record_type']=="staff_subject" || $request['record_type']=="staff_qualification" || $request['record_type']=="staff_qualification" || $request['record_type']=="staff_award_type" || $request['record_type']=="leave_type"){
            $rules=array_merge($rules,
                array('parent_field'=> 'required',)
            );
            $customMessages=array_merge($customMessages,
                array('parent_field.required'=> 'This field is required',)
            );
        }
        if($request['record_type']=="staff_qualification"){
            $rules=array_merge($rules,
                array('parent_field1'  =>  'required',)
            );
            $customMessages=array_merge($customMessages,
                array('parent_field1.required'  =>  'This field is required',)
            );
        }
        $this->validate($request, $rules,$customMessages);

        $data =[
            'name'            =>$request['name'],
            'parent_field'    =>$request['parent_field'],
            'parent_field1'   =>$request['parent_field1'],
            'position_level'  =>$request['position_level'],
            'status'          =>$request['status'],
            'code'            =>$request['code'],
            'actiontype'      =>$request['action_type'],
            'id'              =>$request['id'],
            'record_type'     =>$request['record_type'],
            'user_id'         =>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/masters/saveStaffMasters', $data);
        return $response_data;
    }

    public function saveLeaveConfigMasters(Request $request){
        $rules=[];
        $customMessages =[];
        $rules = [
            'leave_type_id' =>  'required',
            'role_id'       =>  'required',
        ];
        $customMessages = [
            'leave_type_id.required' => 'This field is required',
            'role_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $data =[
            'id'                =>  $request['id'],
            'leave_type_id'     =>  $request['leave_type_id'],
            'role_id'           =>  $request['role_id'],
            'action_type'       =>  $request['action_type'],
            'role_action_mapp'  =>  $request['role_action_mapp'],
            'user_id'           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/masters/saveLeaveConfigMasters', $data);
        return $response_data;
    }

    public function loadLeaveConfigMasters($type="",$submitter=""){
        $response_data = $this->apiService->listData('emis/masters/loadLeaveConfigMasters/'.$type.'/'.$submitter);
        return $response_data;
    }

    public function loadAllLeaveConfigMasters(){
        $response_data = $this->apiService->listData('emis/masters/loadAllLeaveConfigMasters');
        return $response_data;
    }

    public function loadLeaveConfigDetails($id=""){
        $response_data = $this->apiService->listData('emis/masters/loadLeaveConfigDetails/'.$id);
        return $response_data;
    }

    public function loadStaffMasters($param=""){
        $global_masters = $this->apiService->listData('emis/masters/loadStaffMasters/'.$param);
        return $global_masters;
    }
    public function loadStaffDropdownMasters($model="",$parent_id=""){
        $response_data = $this->apiService->listData('emis/masters/loadStaffDropdownMasters/'.$model."/".$parent_id);
        return $response_data;
    }

    public function saveAcademicMasters(Request $request){
        $rules=[];
        $customMessages =[];

        if($request['record_type'] == 'subject_group') {
            $rules = [
                'name'  =>  'required',
                'display_order' => 'required',
                'status'    =>  'required',

            ];
            $customMessages = [
                'name.required' => 'This field is required',
                'display_order.required' => 'This field is required',
                'status.required' => 'This field is required',
            ];
        }
        if($request['record_type'] == 'subject') {
            $rules = [
                'aca_sub_category_id' => 'required',
                'name'  =>  'required',
                'display_order' => 'required',
                'status'    =>  'required',
                'assessed_by_class_teacher' => 'required'
            ];
            $customMessages = [
                'aca_sub_category_id.required' => 'This field is required',
                'name.required' => 'This field is required',
                'display_order.required' => 'This field is required',
                'status.required' => 'This field is required',
                'assessed_by_class_teacher.required' => 'This field is required',

            ];
        }
        if($request['record_type'] == 'assessment_area') {
            $rules = [
                'aca_sub_id' => 'required',
                'name'  =>  'required',
                'code' => 'required',
                'display_order' => 'required',
                'status'    =>  'required',
            ];
            $customMessages = [
                'aca_sub_id.required' => 'This field is required',
                'name.required' => 'This field is required',
                'code.required' => 'This field is required',
                'display_order.required' => 'This field is required',
                'status.required' => 'This field is required',
            ];
        }

        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/masters/saveAcademicMasters', $data);
        return $response_data;
    }
    public function loadAcademicMasters($param=""){
        $global_masters = $this->apiService->listData('emis/masters/loadAcademicMasters/'.$param);
        return $global_masters;
    }
    public function loadClassSubject($class_id="",$stream_id=""){
        $uri = 'emis/masters/loadClassSubject/'.$class_id;
        if($stream_id){
           $uri .= ('/'.$stream_id);
        }
        $response_data = $this->apiService->listData($uri);
        return $response_data;
    }
    public function getClassAssessmentFrequency(){
        $global_masters = $this->apiService->listData('emis/masters/getClassAssessmentFrequency');
        return $global_masters;
    }
    public function saveClassSubject(Request $request){
        $rules = [
            'data.*.aca_sub_id' => 'required',
            'data.*.aca_rating_type_id'  => 'required',
        ];
        $customMessages = [
            'data.*.aca_sub_id.required' => 'This field is required',
            'data.*.aca_rating_type_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/masters/saveClassSubject', $data);
        return $response_data;

    }
    public function saveAssessmentFrequency(Request $request){
        $rules = [
           'data.*.aca_assmt_frequency_id' => 'required',
        ];
        $customMessages = [
            'data.*.aca_assmt_frequency_id.required' => 'All the fields are required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/masters/saveAssessmentFrequency', $data);
        return $response_data;

    }
    public function loadclassSubAssmtFrequency(){
        $global_masters = $this->apiService->listData('emis/masters/loadclassSubAssmtFrequency');
        return $global_masters;
    }
    public function loadclassSubjectAssessment($term_id, $sub_id, $class_id, $stream_id=""){
        $uri = 'emis/masters/loadclassSubjectAssessment/'.$term_id.'/'.$sub_id.'/'.$class_id;
    if($stream_id){
           $uri .= ('/'.$stream_id);
        }
        $response_data = $this->apiService->listData($uri);
        return $response_data;
    }
    public function saveclassSubjectAssessment(Request $request){
        $rules = [
           'aca_assmt_term_id' => 'required',
           'aca_sub_id' => 'required',
           'org_class_id' => 'required',
           'data.*.display_order' => 'required',
           'data.*.aca_assmt_area_id' => 'required',

        ];
        $customMessages = [
            'aca_assmt_term_id.required' => 'This field is required',
            'aca_sub_id.required' => 'This field is required',
            'org_class_id.required' => 'This field is required',
            'data.*.display_order.required' => 'This field is required',
            'data.*.aca_assmt_area_id.required' => 'This field is required',

        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/masters/saveclassSubjectAssessment', $data);
        return $response_data;

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
            'description'   =>  $request['description'],
            'status'        =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'            =>  $request['id'],
            'user_id'       =>$this->userId()
        ];
        //dd('loc');
        try{
            $response_data= $this->apiService->createData('emis/masters/location/saveLocation', $loc);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
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
            'disasterName'   =>  $request['disasterName'],
            'description'    =>  $request['description'],
            'status'         =>  $request['status'],
            'actiontype'     =>  $request['action_type'],
            'id'             =>  $request['id'],
            'user_id'        =>$this->userId()
        ];
        try{
            $response_data= $this->apiService->createData('emis/masters/disaster/saveDisaster', $dis);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
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
            'description'            =>  $request['description'],
            'status'                 =>  $request['status'],
            'actiontype'             =>  $request['action_type'],
            'id'                     =>  $request['id'],
            'user_id'                =>$this->userId()
        ];
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
            'levelName'       =>  $request['levelName'],
            'description'    =>  $request['description'],
            'status'         =>  $request['status'],
            'actiontype'     =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->userId()
        ];
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
            'user_id'=>$this->userId()
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
            'description'    =>  $request['description'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->userId()
        ];
        //dd( $cat);
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
            'description'    =>  $request['description'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->userId()
        ];
       // dd($cat);
        $response_data= $this->apiService->createData('emis/masters/equipmentUsage/saveEquipmentUsage', $cat);
        return $response_data;

    }

    public function loadEquipmentUsage(Request $request){
      //  dd('from UI');
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
            'description'        =>  $request['description'],
            'status'             =>  $request['status'],
            'actiontype'         =>  $request['action_type'],
            'id'                 =>  $request['id'],
            'user_id'            =>$this->userId()
        ];
       // dd( $cat);
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
            'description'        =>  $request['description'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/masters/sportSupporter/saveSportSupporter', $cat);
        return $response_data;

    }

    public function loadSportSupporter(Request $request){
        $strCategory = $this->apiService->listData('emis/masters/sportSupporter/loadSportSupporter');
        return $strCategory;
    }

    public function loadSportFacilitySubtype(){
        $load = $this->apiService->listData('emis/masters/sportFacilitySubtype/loadSportFacilitySubtype');
        return $load;
    }

    public function saveSportFacilitySubtype(Request $request){
        $rules = [
            'sportFacility'  =>  'required',
            'subtypeName'    =>  'required',
        ];
        $customMessages = [
            'sportFacility.required' => 'Sport facility is required',
            'subtypeName.required' => 'Name is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $cat =[
            'sportFacility'     =>  $request['sportFacility'],
            'description'       =>  $request['description'],
            'subtypeName'       =>  $request['subtypeName'],
            'status'            =>  $request['status'],
            'id'                =>  $request['id'],
            'user_id'           =>$this->userId()
        ];
      //  dd($cat);
        $response_data= $this->apiService->createData('emis/masters/sportFacilitySubtype/saveSportFacilitySubtype', $cat);
        return $response_data;

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
            'user_id'=>$this->userId()
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
            'user_id'=>$this->userId()
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
            'className'      =>  $request['className'],
            'description'    =>  $request['description'],
            'status'         =>  $request['status'],
            'id'             =>  $request['id'],
            'user_id'        =>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/masters/class/saveClass', $class);
        return $response_data;

    }

    public function loadClass(Request $request){
        //dd('m here');
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
            'description'   =>  $request['description'],
            'status'        =>  $request['status'],
            'id'            =>  $request['id'],
            'user_id'       =>$this->userId()
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

    public function saveClassStreamMapping(Request $request){

        //need to do array validation
        // $rules = [
        //     'className'  =>  'required',
        //     'status'    =>  'required',
        // ];
        // $customMessages = [
        //     'className.required' => 'Class is required',
        //     'status.required'   => 'Status field is required',
        // ];
        // $this->validate($request, $rules, $customMessages);

        $class =[
            'classStream'  =>  $request['classStream'],
            'status'  =>  $request['status'],
            'id'    =>  $request['id'],
            'user_id'=>$this->userId()
        ];

        $response_data= $this->apiService->createData('emis/masters/classStreamMapping/saveClassStream', $class);
        return $response_data;

    }

    public function loadClassStreamMapping($type=""){
        $loadClassStream = $this->apiService->listData('emis/masters/classStreamMapping/loadClassStreamMapping/'.$type);
        return $loadClassStream;
    }

    public function saveElectricitySource(Request $request){
        $rules = [
            'sourceName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'sourceName.required' => 'Source Name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $source =[
            'sourceName'    =>  $request['sourceName'],
            'description'   =>  $request['description'],
            'status'        =>  $request['status'],
            'id'            =>  $request['id'],
            'user_id'       =>$this->userId()
        ];
        // dd($dis);
        try{
            $response_data= $this->apiService->createData('emis/masters/electricitySource/saveElectricitySource', $source);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadElectricitySource(){
        $loadElectricitySource = $this->apiService->listData('emis/masters/electricitySource/loadElectricitySource');
        return $loadElectricitySource;
    }

    public function saveElectricitySupply(Request $request){
        $rules = [
            'supplyName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'supplyName.required' => 'Source Name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $source =[
            'supplyName'    =>  $request['supplyName'],
            'description'   =>  $request['description'],
            'status'        =>  $request['status'],
            'id'            =>  $request['id'],
            'user_id'       =>$this->userId()
        ];
        try{
            $response_data= $this->apiService->createData('emis/masters/electricitySupply/saveElectricitySupply', $source);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadElectricitySupply(){
        $loadElectricitySupply = $this->apiService->listData('emis/masters/electricitySupply/loadElectricitySupply');
        return $loadElectricitySupply;
    }

    public function saveRoadType(Request $request){
        $rules = [
            'roadType'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'roadType.required' => 'Road Type is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $source =[
            'roadType'       =>  $request['roadType'],
            'description'    =>  $request['description'],
            'status'         =>  $request['status'],
            'id'             =>  $request['id'],
            'user_id'        =>$this->userId()
        ];

        $response_data= $this->apiService->createData('emis/masters/roadType/saveRoadType', $source);
        return $response_data;
    }

    public function loadRoadType(){
        $loadRoadType = $this->apiService->listData('emis/masters/roadType/loadRoadType');
        return $loadRoadType;
    }

    public function saveServiceProvider(Request $request){
        $rules = [
            'serviceType'  =>  'required',
            'serviceName'  =>  'required',
            'status'        =>  'required',
        ];
        $customMessages = [
            'serviceType.required' => 'Service Type is required',
            'serviceName.required' => 'Service Name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $source =[
            'serviceType'    =>  $request['serviceType'],
            'serviceName'    =>  $request['serviceName'],
            'description'    =>  $request['description'],
            'status'        =>  $request['status'],
            'id'            =>  $request['id'],
            'user_id'       =>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/masters/serviceProvider/saveServiceProvider', $source);
        return $response_data;
    }

    public function loadServiceProvider(){
        $loadServiceProvider = $this->apiService->listData('emis/masters/serviceProvider/loadServiceProvider');
        return $loadServiceProvider;
    }

    public function saveStructureDesigner(Request $request){
        $rules = [
            'designerName'  =>  'required',
            'description'   =>  'required',
            'status'        =>  'required',
        ];
        $customMessages = [
            'designerName.required' => 'Designer Name is required',
            'description.required'  => 'Description is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $source =[
            'designerName'    =>  $request['designerName'],
            'description'     =>  $request['description'],
            'status'          =>  $request['status'],
            'id'              =>  $request['id'],
            'user_id'         =>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/masters/structureDesigner/saveStructureDesigner', $source);
        return $response_data;
    }

    public function loadStructureDesigner(){
        $loadStructureDesigner = $this->apiService->listData('emis/masters/structureDesigner/loadStructureDesigner');
        return $loadStructureDesigner;
    }

    public function saveContactType(Request $request){
        $rules = [
            'contactName'  =>  'required',
            'status'        =>  'required',
        ];
        $customMessages = [
            'contactName.required' => 'Contact Name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $source =[
            'contactName'    =>  $request['contactName'],
            'description'    =>  $request['description'],
            'status'        =>  $request['status'],
            'id'            =>  $request['id'],
            'user_id'       =>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/masters/contactType/saveContactType', $source);
        return $response_data;
    }

    public function loadContactType(){
        $loadContactType = $this->apiService->listData('emis/masters/contactType/loadContactType');
        return $loadContactType;
    }

    public function saveAttachment(Request $request){
        $rules = [
            'attachmentName'  =>  'required',
            'status'          =>  'required',
        ];
        $customMessages = [
            'attachmentName.required'     => 'Attachment name is required',
            'status.required'             => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $attachment =[
            'attachmentName'    =>  $request['attachmentName'],
            'description'       =>  $request['description'],
            'status'            =>  $request['status'],
            'id'                =>  $request['id'],
            'user_id'           =>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/masters/attachment/saveAttachment', $attachment);
        return $response_data;

    }

    public function loadAttachment(){
        $loadAttachment = $this->apiService->listData('emis/masters/attachment/loadAttachment');
        return $loadAttachment;
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
        try{
            $response_data= $this->apiService->createData('masters/term/saveTerm', $dis);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadTerm(Request $request){
        $dis = $this->apiService->listData('masters/term/loadTerm');
        return $dis;
    }
    public function getpersonbycid($cid){
        $person = json_decode($this->apiService->listData('getcensusdata/'. $cid));
        if ($person->citizenDetailsResponse) {
            $response_data = $person->citizenDetailsResponse;
            return  response()->json($response_data);
        }else {
            return response()->json('Citizen detail not found. Please check CID and try again.', 404);
        }
    }
    public function loadQuater(Request $request){
     //  return('from UI');
        $dis = $this->apiService->listData('emis/masters/mess_manage/loadQuater');
        return $dis;
    }
    public function saveQuater(Request $request){

        $rules = [
            'quaterName'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'quaterName.required' => 'Quater Name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $dis =[
            'quaterName'  =>  $request['quaterName'],
            'status'    =>  $request['status'],
            'actiontype'    =>  $request['action_type'],
            'id'    =>  $request['id'],
            'user_id'=>$this->userId()
        ];
        try{
            $response_data= $this->apiService->createData('emis/masters/mess_manage/saveQuater', $dis);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
    public function saveDisasterCommittee(Request $request){
       // dd('m here');
        $rules = [
            'disasterCommName'  =>  'required',
            'status'            =>  'required',
        ];
        $customMessages = [
            'disasterCommName.required'         => 'Disaster Committee Name is required',
            'status.required'                   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $disComm =[
            'disasterCommName'   =>  $request['disasterCommName'],
            'description'        =>  $request['description'],
            'status'             =>  $request['status'],
            'actiontype'         =>  $request['action_type'],
            'id'                 =>  $request['id'],
            'user_id'            =>$this->userId()
        ];
       // dd($disComm);
        try{
            $response_data= $this->apiService->createData('emis/masters/disasterComm/saveDisasterCommittee', $disComm);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
    public function loadDisasterComm(Request $request){
      //  dd('loading');
        $dis = $this->apiService->listData('emis/masters/disasterComm/loadDisasterComm');
        return $dis;
    }
   


    // Furniture 
    public function saveFurnitureType(Request $request){
        $rules = [
            'name'  =>  'required',
            'status'    =>  'required',
        ];
        $customMessages = [
            'name.required' => 'furniture name is required',
            'status.required'   => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $fur =[
            'organizationId'    =>  $this->getWrkingAgencyId(),
            'name'              =>  $request['name'],
            'description'       =>  $request['description'],
            'status'            =>  $request['status'],
         //   'actiontype'        =>  $request['action_type'],
            'id'                =>  $request['id'],
            'user_id'           =>$this->userId()
        ];
       // dd( $fur);
        $response_data= $this->apiService->createData('emis/masters/furnitureType/saveFurnitureType', $fur);
        return $response_data;

    }
    public function loadFurnitureType(){
        $global_masters = $this->apiService->listData('emis/masters/furnitureType/loadFurnitureType');
        return $global_masters;
    }

    public function saveFurnitureItem(Request $request){
        $rules = [
            'name'                  =>  'required',
            'furnitureType'         =>  'required',
            'status'                =>  'required',
        ];
        $customMessages = [
            'name.required'             => 'Name item is required',
            'furnitureType.required'    => 'Furniture type name is required',
            'status.required'           => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $furitem =[
            'name'                      =>  $request['name'],
            'furnitureType'             =>  $request['furnitureType'],
            'description'               =>  $request['description'],
            'status'                    =>  $request['status'],
        //    'actiontype'                =>  $request['action_type'],
            'id'                        =>  $request['id'],
            'user_id'                   =>$this->userId()
        ];
      //  dd( $furitem);
        $response_data= $this->apiService->createData('emis/masters/furnitureItem/saveFurnitureItem', $furitem);
        return $response_data;
    }

    public function loadFurnitureItem(){
        $response_data = $this->apiService->listData('emis/masters/furnitureItem/loadFurnitureItem');
        return $response_data;
    }
    public function getFurnitureTypeDropdown(){
  //  dd('from UI');
        $response_data = $this->apiService->listData('emis/masters/furnitureItem/getFurnitureTypeDropdown');
        return $response_data;
    }

    public function saveFurnitureUsage(Request $request){
        $rules = [
            'name'                          =>  'required',
            'status'                        =>  'required',
        ];
        $customMessages = [
            'name.required'                 => 'Furniture usage name is required',
            'status.required'               => 'Status field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $furuse =[
            'name'                          =>  $request['name'],
            'description'                   =>  $request['description'],
            'status'                        =>  $request['status'],
         //   'actiontype'                    =>  $request['action_type'],
            'id'                            =>  $request['id'],
            'user_id'                       =>$this->userId()
        ];
      //  dd($furuse);
        $response_data= $this->apiService->createData('emis/masters/furnitureUsage/saveFurnitureUsage', $furuse);
        return $response_data;

    }
    public function loadFurnitureUsage(Request $request){
        //  dd('from UI');
        $strCategory = $this->apiService->listData('emis/masters/furnitureUsage/loadFurnitureUsage');
        return $strCategory;
    }



    
    

    

}
