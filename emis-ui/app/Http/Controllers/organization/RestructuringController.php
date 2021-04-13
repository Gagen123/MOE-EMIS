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

    public $service_name="Change Basic Details";
    public $service_name_closure="Closure";
    public $merge_service_name="Merger";
    public $bif_service_name="Bifurcation";

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveChangeBasicDetails(Request $request){
        $rules = [
            'name'          =>  'required',
            'level'                 =>  'required',
            'category'              =>  'required',
            'dzongkhag'             =>  'required',
            'gewog'                 =>  'required',
            'chiwog'                =>  'required',
            'locationType'          =>  'required',
            'senSchool'             =>  'required',
        ];
        $customMessages = [
            'proposedName.required'         => 'Proposed Name is required',
            'level.required'                => 'Level is required',
            'category.required'             => 'Category is required',
            'dzongkhag.required'            => 'Dzongkhag is required',
            'gewog.required'                => 'Gewog is required',
            'chiwog.required'               => 'Chiwog is required',
            'locationType.required'         => 'Location Type  is required',
            'senSchool.required'            => 'Sen School is required',
            
        ];
        $this->validate($request, $rules, $customMessages);
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
        $response_data= $this->apiService->createData('emis/organization/changeDetails/saveBasicChangeDetails', $change);
        return $response_data;
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
            'level'                    =>  $request['level'],
            'dzongkhag'                =>  $request['dzongkhag'],
            'gewog'                    =>  $request['gewog'],
            'chiwog'                   =>  $request['chiwog'],
            'location'                 =>  $request['location'],
            'geoLocated'               =>  $request['geoLocated'],
            'senSchool'                =>  $request['senSchool'],
            'parentSchool'             =>  $request['parentSchool'],
            'coLocated'                =>  $request['coLocated'],
            'cid'                      =>  $request['cid'],
            'name'                     =>  $request['name'],
            'phoneNo'                  =>  $request['phoneNo'],
            'email'                    =>  $request['email'],
            'status'                   =>  $request['status'],
            'reason'                   =>  $request['reason'],
            'remark'                   =>  $request['remark'],
            'id'                       =>  $request['id'],
            'user_id'                  =>  $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/organization/closure/saveClosure', $closure);
        $workflowdet=$this->getsubmitterStatus('closure');
        
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
    
    
}
