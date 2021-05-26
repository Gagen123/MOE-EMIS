<?php

namespace App\Http\Controllers\organization;

use Session;
// use Redirect;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
use App\Http\Controllers\Controller;

class RestructuringController extends Controller
{
    use AuthUser;
    use ServiceHelper;
    public $apiService;
    public $database_name="organization_db";
    public $table_name="application_details";
    public $bif_table_name="bifurcations";

    public $service_name=" ";
    public $service_name_closure="Closure";
    public $merge_service_name="Merger";
    public $bif_service_name="Bifurcation";

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveChangeBasicDetails(Request $request){
        $this->service_name = $request['application_for'];

        switch($request['application_type']){
            case "name_change" : {
                    $validation = $this->validateNameChangeFields($request);
                    $establishment_data = $this->setNameChangeFields($request);
                    break;
                }
            case "feeding_change" : {
                    $validation = $this->validateGeneralChange($request);
                    $establishment_data = $this->setFeedingChange($request);
                    break;
                }
            case "level_change" : {
                    $validation = $this->validateChangeInLevel($request);
                    $establishment_data = $this->setChangeInLevel($request);
                    break;
                }
            case "proprietor_change" : {
                    $validation = $this->validateChangeInProprietor($request);
                    $establishment_data = $this->setChangeInProprietor($request);
                    break;
                }
            case "sen_change" : {
                    $validation = $this->validateGeneralChange($request);
                    $establishment_data = $this->setSenChange($request);
                    break;
                }
            case "all_details" : {
                    $validation = $this->validateAllChangesFields($request);
                    $establishment_data = $this->setAllChangesFields($request);
                    break;
                }
            default : {
                
                break;
            }
        }

        $rules = $validation['rules'];
        $customMessages = $validation['messages'];

        $this->validate($request, $rules, $customMessages);

        $workflowdet=json_decode($this->apiService->listData('system/getRolesWorkflow/submitter/'.$this->getRoleIds('roleIds')));
        $screen_id="";
        $status="";
        $app_role="";
        
        foreach($workflowdet as $work){
            if($work->Establishment_type==$request->organization_type){
                $screen_id=$work->SysSubModuleId;
                $status=$work->Sequence;
                $app_role=$work->SysRoleId;
            }
        }
        if($screen_id==null || $screen_id==""){
            return 'No Screen';
        }

        $response_data= $this->apiService->createData('emis/organization/changeDetails/saveBasicChangeDetails', $establishment_data);
        $service_name=json_decode($response_data)->data->establishment_type;

        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$this->service_name,//service name 
            'application_number'=>json_decode($response_data)->data->application_no,
            'screen_id'         =>$screen_id,
            'status_id'         =>$status,
            'remarks'           =>null,
            'app_role_id'       => $app_role,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        // dd($workflow_data);
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        return $work_response_data;
        // return $response_data;
    }

    public function saveChangeClass(Request $request){
        $rules = [
            'class'          =>  'required',
        ];
        $customMessages = [
            'class.required'         => 'Class is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $workflowdet=$this->getsubmitterStatus('change');
        if($workflowdet['screen_id']=="0"){
            return "No Screen";
        }
        $classStream =[
            'application_number'        =>  $request['application_number'],
            'class'                     =>  $request['class'],
            'stream'                    =>  $request['stream'],
            'status'                    =>  $request['status'],  
            'user_id'                   =>  $this->userId() ,
        ];
        $response_data= $this->apiService->createData('emis/organization/changeDetails/saveChangeClass', $classStream);
        $workflow_data=[
            'db_name'           =>  $this->database_name,
            'table_name'        =>  $this->table_name,
            'service_name'      =>  $this->service_name,
            'application_number'=>  $request['application_number'],
            'screen_id'         =>  $workflowdet['screen_id'],
            'status_id'         =>  $workflowdet['status'],
            'remarks'           =>  null,
            'user_dzo_id'       =>  $this->getUserDzoId(),
            'access_level'      =>  $this->getAccessLevel(),
            'working_agency_id' =>  $this->getWrkingAgencyId(),
            'action_by'         =>  $this->userId(),
        ];
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        return $work_response_data;
        
    }

    public function loadChangeDetailForVerification($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=$this->apiService->createData('emis/common/updateTaskDetails',$update_data); 
       
        $workflowstatus=$this->getCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/changeDetails/loadChangeDetailForVerification/'.$appNo));
        $loadOrganizationDetails->app_stage=$workflowstatus;
        return json_encode($loadOrganizationDetails);
    }
    public function loadPriviousOrgDetails($orgId=""){
        $loadPriviousOrgDetails = json_decode($this->apiService->listData('emis/organization/changeDetails/loadPriviousOrgDetails/'.$orgId));
        return json_encode($loadPriviousOrgDetails);
    }

    public function updateChangeBasicDetailApplication(Request $request){
        $workflowdet=$this->getcurrentworkflowStatusForUpdate('change');
        $work_status=$workflowdet['status'];
        $org_status='Under Process';
        if($request->actiontype=="reject"){
            $work_status=0;
            $org_status="Rejected";
        }
        if($request->actiontype=="approve"){
            $org_status="Approved";
        }
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$this->service_name,
            'application_number'=>$request->applicationNo,
            'screen_id'         =>$workflowdet['screen_id'],
            'status_id'         =>$work_status,
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        $estd =[
            'status'                       =>   $org_status,
            'application_number'           =>   $request->applicationNo,
            'remarks'                      =>   $request->remarks,
            'user_id'                      =>   $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/organization/changeDetails/updateChangeBasicDetails', $estd);
        // dd($response_data);
        return $work_response_data;
    }

    public function getCurrentClass(){
        $classInCheckbox = $this->apiService->listData('emis/organization/changeDetails/getCurrentClass');
        return $classInCheckbox;
    }
    public function getCurrentStream(){
        $streamInCheckbox = $this->apiService->listData('emis/organization/changeDetails/getCurrentStream');
        return $streamInCheckbox;
    }

    public function getApplicationNo(){
        $applicationNo = $this->apiService->listData('emis/organization/changeDetails/getApplicationNo/'.$this->userId());
        return $applicationNo;
    }

    public function loadCurrentOrgDetails($orgId=""){
        $loadCurrentOrgDetails = $this->apiService->listData('emis/organization/changeDetails/loadCurrentOrgDetails/'.$orgId);
        return $loadCurrentOrgDetails;
    }

    public function loadCurrentProprietorDetails($orgId=""){
        $load = $this->apiService->listData('emis/organization/changeDetails/loadCurrentProprietorDetails/'.$orgId);
        return $load;
    }

    public function saveMerger(Request $request){
        $rules = [
            'proposedName'      =>  'required',
            'level'             =>  'required',
            'category'          =>  'required',
            'dzongkhag'         =>  'required',
            'gewog'             =>  'required',
            'chiwog'            =>  'required',
            'locationType'      =>  'required',
            'senSchool'         =>  'required',
        ];
        $customMessages = [
            'proposedName.required' =>  'Name is required',
            'level.required'        => 'Level is required',
            'category.required'     => 'Category is required',
            'dzongkhag.required'    => 'Dzongkhag is required',
            'gewog.required'        => 'Gewog is required',
            'chiwog.required'       => 'Chiwog is required',
            'locationType.required' => 'Location Type is required',
            'senSchool.required'    => 'SEN School is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $merger =[
            'orgId1'                   =>       $request['orgId1'],
            'orgId2'                   =>       $request['orgId2'],
            'proposedName'             =>       $request['proposedName'],
            'cid'                      =>       $request['cid'],
            'name'                     =>       $request['name'],
            'phoneNo'                  =>       $request['phoneNo'],
            'email'                    =>       $request['email'],
            'category'                 =>       $request['category'],
            'level'                    =>       $request['level'],
            'dzongkhag'                =>       $request['dzongkhag'],
            'gewog'                    =>       $request['gewog'],
            'chiwog'                   =>       $request['chiwog'],
            'location'                 =>       $request['locationType'],
            'geoLocated'               =>       $request['geoLocated'],
            'senSchool'                =>       $request['senSchool'],
            'parentSchool'             =>       $request['parentSchool'],
            'coLocated'                =>       $request['coLocated'],
            'year'                     =>       $request['year'],
            'class'                    =>       $request['class'],
            'stream'                   =>       $request['stream'],
            'id'                       =>       $request['id'],
            'user_id'                  =>  $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/organization/merger/saveMerger', $merger);
        
        $workflowdet=$this->getsubmitterStatus('merge');
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$this->merge_service_name,
            'application_number'=>json_decode($response_data)->data->applicationNo,
            'screen_id'         =>$workflowdet['screen_id'],
            'status_id'         =>$workflowdet['status'],
            'remarks'           =>null,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        return $response_data;
    }

    public function loadMergerForVerification($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=$this->apiService->createData('emis/common/updateTaskDetails',$update_data); 
        $workflowstatus=$this->getCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/merger/loadMergerForVerification/'.$appNo));
        $loadOrganizationDetails->app_stage=$workflowstatus;
        return json_encode($loadOrganizationDetails);
    }
    public function updateMergerApplication(Request $request){
        $workflowdet=$this->getcurrentworkflowStatusForUpdate('merge');
        $work_status=$workflowdet['status'];
        $org_status='Under Process';
        if($request->actiontype=="reject"){
            $work_status=0;
            $org_status="Rejected";
        }
        if($request->actiontype=="approve"){
            $org_status="Approved";
        }
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$this->merge_service_name,
            'application_number'=>$request->applicationNo,
            'screen_id'         =>$workflowdet['screen_id'],
            'status_id'         =>$work_status,
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        $estd =[
            'status'                       =>   $org_status,
            'application_number'           =>   $request->applicationNo,
            'remarks'                      =>   $request->remarks,
            'user_id'                      =>   $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/organization/establishment/updateEstablishment', $estd);
        return $work_response_data;
    }

    public function saveClosure(Request $request){
        $rules = [
            'reason'          =>  'required',
        ];
        $customMessages = [
            'reason.required'      => 'Reason is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $closure =[
            'code'                     =>  $request['code'],
            'name'                     =>  $request['name'],
            'category'                 =>  $request['category'],
            'level'                    =>  $request['levelId'],
            'dzongkhag'                =>  $request['dzongkhagId'],
            'gewog'                    =>  $request['gewogId'],
            'chiwog'                   =>  $request['chiwogId'],
            'location'                 =>  $request['locationId'],
            'geoLocated'               =>  $request['geoLocated'],
            'senSchool'                =>  $request['senSchool'],
            'parentSchool'             =>  $request['parentSchool'],
            'coLocatedParent'          =>  $request['coLocatedParent'],
            'cid'                      =>  $request['cid'],
            'fullName'                 =>  $request['fullName'],
            'phoneNo'                  =>  $request['phoneNo'],
            'email'                    =>  $request['email'],
            'status'                   =>  $request['status'],
            'reason'                   =>  $request['reason'],
            'remark'                   =>  $request['remark'],
            'id'                       =>  $request['id'],
            'user_id'                  =>  $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/organization/closure/saveClosure', $closure);
        // dd($response_data);
        $workflowdet=$this->getsubmitterStatus('closure');
        if($workflowdet['screen_id']=="0"){
            return "No Screen";
        }
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$this->service_name_closure,
            'application_number'=>json_decode($response_data)->data->applicationNo,
            'screen_id'         =>$workflowdet['screen_id'],
            'status_id'         =>$workflowdet['status'],
            'remarks'           =>null,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        // dd($workflow_data);
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        return $work_response_data;
    }

    public function loadClosureApplicationDetails($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=$this->apiService->createData('emis/common/updateTaskDetails',$update_data); 
        
        $workflowstatus=$this->getCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/closure/loadClosureApplicationDetails/'.$appNo));
        // dd($loadOrganizationDetails);
        $loadOrganizationDetails->app_stage=$workflowstatus;
        return json_encode($loadOrganizationDetails);
    }

    public function updateClosureApplication(Request $request){
        $workflowdet=$this->getcurrentworkflowStatusForUpdate('closure');
        $work_status=$workflowdet['status'];
        $org_status='Under Process';
        if($request->actiontype=="reject"){
            $work_status=0;
            $org_status="Rejected";
        }
        if($request->actiontype=="approve"){
            $org_status="Approved";
        }
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$this->service_name_closure,
            'application_number'=>$request->applicationNo,
            'screen_id'         =>$workflowdet['screen_id'],
            'status_id'         =>$work_status,
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        // dd($workflow_data);
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        $closure =[
            'status'                       =>   $org_status,
            'application_number'           =>   $request->applicationNo,
            'remarks'                      =>   $request->yourRemark,
            'user_id'                      =>   $this->userId() 
        ];
        // dd($closure);
        $response_data= $this->apiService->createData('emis/organization/closure/updateClosure', $closure);
        return $work_response_data;
    }

    public function saveBifurcation(Request $request){
        $rules = [
            'name'              =>  'required',
            'level'             =>  'required',
            'category'          =>  'required',
            'dzongkhag'         =>  'required',
            'gewog'             =>  'required',
            'chiwog'            =>  'required',
            'location'          =>  'required',
            'senSchool'         =>  'required',
            'name1'              =>  'required',
            'level1'             =>  'required',
            'category1'          =>  'required',
            'dzongkhag1'         =>  'required',
            'gewog1'             =>  'required',
            'chiwog1'            =>  'required',
            'location1'          =>  'required',
            'senSchool1'         =>  'required',
        ];
        $customMessages = [
            'name.required'          => 'Name is required',
            'level.required'         => 'Level is required',
            'category.required'      => 'Category is required',
            'dzongkhag.required'     => 'Dzongkhag is required',
            'gewog.required'         => 'Gewog is required',
            'chiwog.required'        => 'Chiwog is required',
            'location.required'      => 'Location Type is required',
            'senSchool.required'     => 'SEN School is required',
            'name1.required'         => 'Name is required',
            'level1.required'        => 'Level is required',
            'category1.required'     => 'Category is required',
            'dzongkhag1.required'    => 'Dzongkhag is required',
            'gewog1.required'        => 'Gewog is required',
            'chiwog1.required'       => 'Chiwog is required',
            'location1.required'     => 'Location Type is required',
            'senSchool1.required'    => 'SEN School is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $bifurcation =[
            'name'                      =>  $request['name'],
            'level'                     =>  $request['level'],
            'category'                  =>  $request['category'],
            'dzongkhag'                 =>  $request['dzongkhag'],
            'gewog'                     =>  $request['gewog'],
            'chiwog'                    =>  $request['chiwog'],
            'location'                  =>  $request['location'],
            'geoLocated'                =>  $request['geoLocated'],
            'senSchool'                 =>  $request['senSchool'],
            'parentSchool'              =>  $request['parentSchool'],
            'coLocated'                 =>  $request['coLocated'],
            'class'                     =>  $request['class'],
            'stream'                    =>  $request['stream'],

            'name1'                     =>  $request['name1'],
            'level1'                    =>  $request['level1'],
            'category1'                 =>  $request['category1'],
            'dzongkhag1'                =>  $request['dzongkhag1'],
            'gewog1'                    =>  $request['gewog1'],
            'chiwog1'                   =>  $request['chiwog1'],
            'location1'                 =>  $request['location1'],
            'geoLocated1'               =>  $request['geoLocated1'],
            'senSchool1'                =>  $request['senSchool1'],
            'parentSchool1'             =>  $request['parentSchool1'],
            'coLocated1'                =>  $request['coLocated1'],
            'class1'                    =>  $request['class1'],
            'stream1'                   =>  $request['stream1'],

            'parent_id'                 =>  $request['parent_id']
        ];
        $response_data= $this->apiService->createData('emis/organization/bifurcation/saveBifurcation', $bifurcation);
        // dd($response_data);
        $workflowdet=$this->getsubmitterStatus('merge');
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->bif_table_name,
            'service_name'      =>$this->bif_service_name,
            'application_number'=>json_decode($response_data)->data->applicationNo,
            'screen_id'         =>$workflowdet['screen_id'],
            'status_id'         =>$workflowdet['status'],
            'remarks'           =>null,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        return $response_data;
    }

    public function loadbifurcationForVerification($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=$this->apiService->createData('emis/common/updateTaskDetails',$update_data); 
        $workflowstatus=$this->getCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/bifurcation/loadbifurcationForVerification/'.$appNo));
        // dd($loadOrganizationDetails);
        $loadOrganizationDetails->app_stage=$workflowstatus;
        return json_encode($loadOrganizationDetails);
    }

    public function updateBifurcationApplication(Request $request){
        $workflowdet=$this->getcurrentworkflowStatusForUpdate('bifurca');
        $work_status=$workflowdet['status'];
        $org_status='Under Process';
        if($request->actiontype=="reject"){
            $work_status=0;
            $org_status="Rejected";
        }
        if($request->actiontype=="approve"){
            $org_status="Approved";
        }
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->bif_table_name,
            'service_name'      =>$this->bif_service_name,
            'application_number'=>$request->applicationNo,
            'screen_id'         =>$workflowdet['screen_id'],
            'status_id'         =>$work_status,
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        $estd =[
            'status'                       =>   $org_status,
            'application_number'           =>   $request->applicationNo,
            'remarks'                      =>   $request->remarks,
            'user_id'                      =>   $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/organization/establishment/updateEstablishment', $estd);
        return $work_response_data;
    }
    public function loadOrganizationDetails(){
        $loadBifurcationDetails = $this->apiService->listData('emis/organization/bifurcation/loadBifurcation');
        return $loadBifurcationDetails;
    }
    
    public function getOrgList(){
        $loadBifurcationDetails = $this->apiService->listData('emis/organization/getOrgList/'.$this->getUserDzoId());
        return $loadBifurcationDetails;
    }
    

    /**
     * Validation Rules for different types of changes
     */
    
    private function validateNameChangeFields($request){
        $rules = [
            'proposedName'                =>  'required',
            'initiatedBy'                 =>  'required',
            'organizationId'              =>  'required'
        ];
        $customMessages = [
            'proposedName.required'         => 'Proposed Name is required',
            'initiatedBy.required'          => 'Initiated By is required',
            'organizationId.required'       => 'Organization is required'
        ];
        $this->validate($request, $rules, $customMessages);
        
        $validation = array();
        $validation['rules'] = $rules;
        $validation['messages'] = $customMessages;

        return ($validation);
    }

    private function validateChangeInLevel($request){
        $rules = [
            'level'                       =>  'required',
            'organizationId'              =>  'required'
        ];
        $customMessages = [
            'level.required'                => 'New Level is required',
            'organizationId.required'       => 'Organization is required'
        ];
        $this->validate($request, $rules, $customMessages);
        
        $validation = array();
        $validation['rules'] = $rules;
        $validation['messages'] = $customMessages;

        return ($validation);
    }

    //this is used to validate both SEN and Feeding

    private function validateGeneralChange($request){
        $rules = [
            'organizationId'              =>  'required'
        ];
        $customMessages = [
            'organizationId.required'       => 'Organization is required'
        ];
        $this->validate($request, $rules, $customMessages);
        
        $validation = array();
        $validation['rules'] = $rules;
        $validation['messages'] = $customMessages;

        return ($validation);
    }

    private function validateChangeInProprietor($request){
        $rules = [
            'proprietorName'              =>  'required',
            'proprietorCid'               =>  'required',
            'proprietorPhone'             =>  'required',
            'proprietorEmail'             =>  'required',
            'proprietorMobile'            =>  'required',
            'organizationId'              =>  'required'
        ];
        $customMessages = [
            'proprietorName.required'           => 'Proprietor Name is required',
            'proprietorCid.required'            => 'Proprietor CID is required',
            'proprietorPhone.required'          => 'Phone No. is required',
            'proprietorMobile.required'         => 'Mobile No.  is required',
            'proprietorEmail.required'         => 'Email  is required',
            'organizationId.required'       => 'Organization is required'
        ];

        $this->validate($request, $rules, $customMessages);
        
        $validation = array();
        $validation['rules'] = $rules;
        $validation['messages'] = $customMessages;

        return ($validation);
    }
    
    
    private function validateAllChangesFields($request){

        $rules = [
            'name'                  =>  'required',
            'level'                 =>  'required',
            'category'              =>  'required',
            'dzongkhag'             =>  'required',
            'gewog'                 =>  'required',
            'chiwog'                =>  'required',
            'locationType'          =>  'required',
            'senSchool'             =>  'required',
        ];
        $customMessages = [
            'name.required'         => 'Proposed Name is required',
            'level.required'                => 'Level is required',
            'category.required'             => 'Category is required',
            'dzongkhag.required'            => 'Dzongkhag is required',
            'gewog.required'                => 'Gewog is required',
            'chiwog.required'               => 'Chiwog is required',
            'locationType.required'         => 'Location Type  is required',
            'senSchool.required'            => 'Sen School is required',
            
        ];
        $this->validate($request, $rules, $customMessages);
        
        $validation = array();
        $validation['rules'] = $rules;
        $validation['messages'] = $customMessages;

        return ($validation);
    }

    /**
     * Setting the data fields to be saved
     */

    private function setNameChangeFields($request){
        /**
         * organizationId:'',proposedName:'',initiatedBy:' ', application_type:'name_change', 
         *  application_for:'Change in Name', action_type:'add', status:'pending'
         */

        $change =[
            'organizationId'            =>  $request['organizationId'],
            'proposedName'              =>  $request['proposedName'],
            'initiatedBy'               =>  $request['initiatedBy'],
            'application_type'          =>  $request['application_type'],
            'application_for'           =>  $request['application_for'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'], 
            'id'                        =>  $request['id'], 
            'user_id'                   =>  $this->userId() 
        ];

        return $change;
    }

    private function setChangeInLevel($request){
        /**
         * organizationId:'', application_type:'level_change', class:[], stream:[],
         * application_for:'Change in Level', action_type:'add', status:'pending'
         */

        $change =[
            'organizationId'            =>  $request['organizationId'],
            'level_change'              =>  $request['level_change'],
            'level'                     =>  $request['level'],
            'class'                     =>  $request['class'],
            'stream'                    =>  $request['stream'],
            'application_type'          =>  $request['application_type'],
            'application_for'           =>  $request['application_for'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'],  
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId() 
        ];

        return $change;
    }

    private function setFeedingChange($request){
        /**
         * organizationId:'',feeding:[],  application_type:'feeding_change', isfeedingschool:'0',
         * application_for:'Change in Feeding Details', action_type:'add', status:'pending'
         */

        $change =[
            'organizationId'            =>  $request['organizationId'],
            'feeding'                   =>  $request['feeding'],
            'isfeedingschool'           =>  $request['isfeedingschool'],
            'application_type'          =>  $request['application_type'],
            'application_for'           =>  $request['application_for'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'],  
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId() 
        ];

        return $change;
    }

    private function setSenChange($request){
        /**
         * organizationId:'', application_type:'sen_change', senSchool:'0',
         * application_for:'Change in SEN details', action_type:'add', status:'pending'
         */

        $change =[
            'organizationId'            =>  $request['organizationId'],
            'senSchool'                 =>  $request['senSchool'],
            'application_type'          =>  $request['application_type'],
            'application_for'           =>  $request['application_for'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'],  
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId() 
        ];

        return $change;
    }

    private function setChangeInProprietor($request){
        /**
         * organizationId:'',proprietorName:'',proprietorCid:' ', proprietorPhone:'', proprietorMobile:'', proprietorEmail:'',
         *   application_type:'proprietor_change', application_for:'Change in Proprietor', action_type:'add', status:'pending'
         */

        $change =[
            'organizationId'            =>  $request['organizationId'],
            'proprietorName'            =>  $request['proprietorName'],
            'proprietorCid'             =>  $request['proprietorCid'],
            'proprietorPhone'           =>  $request['proprietorPhone'],
            'proprietorMobile'          =>  $request['proprietorMobile'],
            'proprietorEmail'           =>  $request['proprietorEmail'],
            'application_type'          =>  $request['application_type'],
            'application_for'           =>  $request['application_for'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'],  
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId() 
        ];

        return $change;
    }

    private function setAllChangesFields($request){

        $change =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'name'                      =>  $request['name'],
            'level'                     =>  $request['level'],
            'category'                  =>  $request['category'],
            'dzongkhag'                 =>  $request['dzongkhag'],
            'gewog'                     =>  $request['gewog'],
            'chiwog'                    =>  $request['chiwog'],
            'locationType'              =>  $request['locationType'],
            'geoLocated'                =>  $request['geoLocated'],
            'senSchool'                 =>  $request['senSchool'],
            'geoLocated'                =>  $request['geoLocated'],
            'coLocatedParent'           =>  $request['coLocatedParent'],
            'parentSchool'              =>  $request['parentSchool'],
            'cid'                       =>  $request['cid'],
            'fullName'                  =>  $request['fullName'],
            'phoneNo'                   =>  $request['phoneNo'],
            'email'                     =>  $request['email'],
            'status'                    =>  $request['status'],   
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId() 
        ];

        return $change;
    }
}
