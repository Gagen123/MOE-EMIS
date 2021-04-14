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

class EstablishmentController extends Controller
{
    use AuthUser;
    use ServiceHelper;
    public $apiService;
    public $database_name="organization_db";
    public $table_name="application_details";
    public $service_name="New Establishment";
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function getLevelInDropdown(){
        $level = $this->apiService->listData('emis/organization/establishment/getLevelInDropdown');
        return $level;
    }

    public function getLocationInDropdown(){
        $level = $this->apiService->listData('emis/organization/establishment/getLocationInDropdown');
        return $level;
    }

    public function saveEstablishment(Request $request){
        $rules = [
            'proposedName'          =>  'required',
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
        $estd =[
            'proposedName'                 =>  $request['proposedName'],
            'level'                        =>  $request['level'],
            'category'                     =>  $request['category'],
            'dzongkhag'                    =>  $request['dzongkhag'],
            'gewog'                        =>  $request['gewog'],
            'chiwog'                       =>  $request['chiwog'],
            'locationType'                 =>  $request['locationType'],
            'senSchool'                    =>  $request['senSchool'],
            'geopolicaticallyLocated'      =>  $request['geopolicaticallyLocated'],
            'parentSchool'                 =>  $request['parentSchool'],
            'coLocatedParent'              =>  $request['coLocatedParent'],
            'cid'                          =>  $request['cid'],
            'name'                         =>  $request['name'],
            'phoneNo'                      =>  $request['phoneNo'],
            'email'                        =>  $request['email'],
            'status'                       =>  $request['status'],
            'id'                           =>  $request['id'],
            'user_id'                      =>  $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/organization/establishment/saveEstablishment', $estd);
        return $response_data;
    }

    public function saveClassStream(Request $request){
        $rules = [
            'class'          =>  'required',
        ];
        $customMessages = [
            'class.required'         => 'Class is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $workflowdet=$this->getsubmitterStatus('new establishment');
        // dd($workflowdet['screen_id']);
        if($workflowdet['screen_id']=="0"){
            return "No Screen";
        }

        $classStream =[
            'class'        =>  $request['class'],
            'stream'       =>  $request['stream'],
            'status'       =>  $request['status'],
            'user_id'      =>  $this->userId() ,
        ];
        $response_data= $this->apiService->createData('emis/organization/establishment/saveClassStream', $classStream);
        // dd($response_data->data->applicationNo);
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$this->service_name,
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

    public function getClass(){
        $classInCheckbox = $this->apiService->listData('emis/organization/establishment/getClass');
        return $classInCheckbox;
    }

    public function getStream(){
        $streamInCheckbox = $this->apiService->listData('emis/organization/establishment/getStream' );
        return $streamInCheckbox;
    }

    public function loadOrganizationDetails(){        
        $loadOrganizationDetails = $this->apiService->listData('emis/organization/establishment/loadOrganizationDetails/'.$this->userId() );
        return $loadOrganizationDetails;
    }

    public function loadProprietorDetails(){  
        $loadProprietorDetails = $this->apiService->listData('emis/organization/establishment/loadProprietorDetails');
        return $loadProprietorDetails;
    }

    public function saveBasicDetails(Request $request){
        $rules = [
            'agencyType'          =>  'required',
            
        ];
        $customMessages = [
            'agencyType.required'         => 'Agency type is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $basicDetails =[
            'agencyCode'        =>  $request['agencyCode'],
            'agencyName'        =>  $request['agencyName'],
            'parentAgency'      =>  $request['parentAgency'],
            'dzongkhag'         =>  $request['dzongkhag'],
            'gewog'             =>  $request['gewog'],
            'chiwog'            =>  $request['chiwog'],
            'agencyType'        =>  $request['agencyType'],
            'status'            =>  $request['status'],
            'id'                =>  $request['id'],
            'user_id'           =>  $this->userId() ,
        ];
        $response_data= $this->apiService->createData('emis/organization/headQuater/saveBasicDetails', $basicDetails);
        return $response_data;
    }

    public function loadBasicDetails(){ 
        $loadBasicDetails = $this->apiService->listData('emis/organization/headQuater/loadBasicDetails/'.$this->userId() );
        return $loadBasicDetails;
    }

    public function saveContactDetails(Request $request){
        $contactDetails =[
            'organizationId'   =>  $request['organizationId'],
            'contactdetails'             =>  $request['contacts'],
            'user_id'           =>  $this->userId() ,
        ];
        $response_data= $this->apiService->createData('emis/organization/headQuater/saveContactDetails', $contactDetails);
        return $response_data;
    }

    public function loadEstbDetailsForVerification($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=$this->apiService->createData('emis/common/updateTaskDetails',$update_data); 
        $workflowstatus=$this->getCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/establishment/loadEstbDetailsForVerification/'.$appNo));
        $loadOrganizationDetails->app_stage=$workflowstatus;
        return json_encode($loadOrganizationDetails);
    }

    public function updateNewEstablishmentApplication(Request $request){
        $workflowdet=$this->getcurrentworkflowStatusForUpdate('new establishment');
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
        $response_data= $this->apiService->createData('emis/organization/establishment/updateEstablishment', $estd);
        return $work_response_data;
    }
    
    public function loadApprovedOrgs(){  
        $response_data = $this->apiService->listData('emis/organization/establishment/loadApprovedOrgs');
        return $response_data;
    }

    public function getApprovedOrgDetails($type="",$key=""){  
        if($type=="1"){
            //Invoke Zest for details
        }else{
            $response_data = $this->apiService->listData('emis/organization/establishment/getApprovedOrgDetails/'.$type.'/'.$key);
        }
        
        return $response_data;
    }
    
    public function registerOrganizationDetails(Request $request){
        $estd=[
            'category'                  =>$request->category,
            'yearestb'                  =>$request->yearestb,
            'zestcode'                  =>$request->zestcode,
            'organizationid'            =>$request->organizationid,
            'applicationNo'             =>$request->applicationNo,
            'application_date'          =>$request->application_date,
            'service'                   =>$request->service,
            'proposedName'              =>$request->proposedName,
            'dzongkhagId'               =>$request->dzongkhagId,
            'gewogId'                   =>$request->gewogId,
            'chiwogId'                  =>$request->chiwogId,
            'isColocated'               =>$request->isColocated,
            'levelId'                   =>$request->levelId,
            'locationId'                =>$request->locationId,
            'parentSchoolId'            =>$request->parentSchoolId,
            'isGeopoliticallyLocated'   =>$request->isGeopoliticallyLocated,
            'senSchool'                 =>$request->senSchool,
            'parentSchool'              =>$request->parentSchool,
            'coLocatedParent'           =>$request->coLocatedParent,
            'isSenSchool'               =>$request->isSenSchool,
            'remarks'                   =>$request->remarks,
            'proprietorList'            =>$request->proprietorList,
            'class_section'             =>$request->class_section,
            'sectionList'               =>$request->sectionList,
            'action_by'                 =>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/organization/establishment/registerOrganizationDetails', $estd);
        $estd =[
            'status'                       =>   'Registered',
            'application_number'           =>   $request->applicationNo,
            'remarks'                      =>   $request->remarks,
            'user_id'                      =>   $this->userId() 
        ];
        $estd_data= $this->apiService->createData('emis/organization/establishment/updateEstablishment', $estd);
        return $response_data;
    }
    
    public function getschoolDetials(){  
        $param=$this->getAccessLevel().'SSS'.$this->getUserDzoId().'SSS'.$this->getWrkingAgencyId();
        $response_data = $this->apiService->listData('emis/organization/establishment/getschoolDetials/'.$param);
        return $response_data;
    }
    public function getFullSchoolDetials($id=""){  
        if($id=="sessionDet"){
            $id=$this->getWrkingAgencyId();
        }
        $response_data = $this->apiService->listData('emis/organization/establishment/getFullSchoolDetials/'.$id);
        return $response_data;
    }
    
    public function checkPendingApplication($type=""){  
        $response_data = $this->apiService->listData('emis/common/checkPendingApplication/'.$type.'/'.$this->userId());
        return $response_data;
    }
    
    public function getsAgencyList(){ 
        $param=$this->getAccessLevel().'SSS'.$this->getUserDzoId().'SSS'.$this->getWrkingAgencyId();
        $loadBasicDetails = $this->apiService->listData('emis/organization/headQuater/getsAgencyList/'.$param);
        return $loadBasicDetails;
    }
    
    public function getHeadQuarterDetails($id=""){ 
        $response_data = $this->apiService->listData('emis/organization/headQuater/getHeadQuarterDetails/'.$id);
        return $response_data;
    }

}
