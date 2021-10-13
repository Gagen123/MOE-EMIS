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

class EstablishmentController extends Controller{
    use AuthUser;
    use ServiceHelper;
    public $apiService;
    public $database_name="organization_db";
    public $table_name="application_details";
    public $service_name;
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

    public function saveprivatepublicschoolEstablishment(Request $request){
        $rules = [
            'proposedName'          =>  'required',
            'category'              =>  'required',
            'gewog'                 =>  'required',
            'chiwog'                =>  'required',
            'proposedLocation'      =>  'required',
        ];
        $customMessages = [
            'proposedName.required'         => 'Proposed Name is required',
            'category.required'             => 'Category is required',
            'gewog.required'                => 'Gewog is required',
            'chiwog.required'               => 'Chiwog is required',
            'proposedLocation.required'     => 'Select location type',
        ];
        if(strpos($request->establishment_type,'ECR')===false){
            $rules = $rules+[
                'level'                 =>  'required',
            ];
            $customMessages = $customMessages+[
                'level.required'                => 'Level is required',
            ];
        }
        if(strpos($request->establishment_type,'Public')!==false){
            $rules = $rules+[
                'initiatedBy'           =>  'required',
            ];
            $customMessages = $customMessages+[
                'initiatedBy.required'          => 'Proposal Initiated By is required',
            ];
        }
        if(strpos($request->establishment_type,'Private')!==false){
            $rules = $rules+[
                'typeOfSchool'          =>  'required',
                'proprietorName'        =>  'required',
                'proprietorCid'         =>  'required|min:11|max:11',
                'proprietorMobile'      =>  'required|min:8|max:8',
                'proprietorEmail'       =>  'required|email',
            ];
            $customMessages = $customMessages+[
                'typeOfSchool.requrired'        => 'choose type of school',
                'proprietorName.required'       => 'Proprietor Name is required',
                'proprietorCid.required'        => 'Proprietor CID is required',
                'proprietorEmail.required'      => 'email. is required',
                'proprietorMobile.required'     => 'Mobile No.  is required',
            ];
        }
        $this->validate($request, $rules,$customMessages);

        $request['user_id']=$this->userId();
        $response_data= $this->apiService->createData('emis/organization/establishment/saveprivatepublicschoolEstablishment', $request->all());
        return $response_data;
    }

    public function saveClassStream(Request $request){
        $request['user_id']=$this->userId();
        $response_data= $this->apiService->createData('emis/organization/establishment/saveClassStream', $request->all());
        return $response_data;
    }

    public function saveUploadedFiles(Request $request){
        $application_number = $request->application_number;
        $files = $request->attachments;
        $filenames = $request->attachmentname;
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
                            'application_number'     =>  $application_number,
                        )
                    );
                }
            }
        }

        $form_status=$request['status'];
        if($request->submit_type=="reject"){
            $form_status='Rejected';
        }
        $request_data =[
            'attachment_details'                =>  $attachment_details,
            'application_number'                =>  $application_number,
            'status'                            =>  $form_status,
            'update_type'                       =>  $request['update_type'],
            'action_type'                       =>  $request['action_type'],
            'remarks'                           =>  $request->remarks,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/organization/establishment/saveUploadedFiles', $request_data);
        if($request['action_type']!="edit"){
            $workflow=$this->insertworkflow($request,$application_number);
            $notification=$this->insertnotification($request,$application_number);
        }
        return $response_data;
    }
    private function insertworkflow($request,$application_number=""){
        $status=$request->Sequence;
        $w_status=$request->Status_Name;
        if(isset($request->submit_type) && $request->submit_type=="reject"){
            $status='0__submitterRejects';
        }
        if(isset($request->actiontype) && $request->actiontype=="reject"){
            $status=0;
        }
        if(isset($request->update_type) && (strpos(strtolower($request->update_type),'approved')!==false || strpos(strtolower($request->update_type),'final_approval')!==false)){
            $status=10;
            $w_status="Approved";
        }
        // dd($request->SysRoleId,$w_status,$status,$request->screenId);
        if($request->screenId==null){
            $tasks=json_decode($this->apiService->listData('emis/common/getTaskDetials/'.$application_number));
            $request->screenId=$tasks->screen_id;
            $status=$tasks->status_id+1;
            $request->SysRoleId=$this->getRoleIds('roleIds');
        }

        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$request->service_name,
            'name'              =>$request->proposedName,
            'application_number'=>$application_number,
            'screen_id'         =>$request->screenId,
            'w_config_status'   =>$w_status,
            'status_id'         =>$status,
            'app_role_id'       =>$request->SysRoleId,
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        return $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
    }
    private function insertnotification($request,$application_number=""){
        $seq=((int) $request->Sequence +1);
        $next_roleId=json_decode($this->apiService->listData('system/getRolesWorkflow/submittedTo/'.$request->screenId.'__'.$seq));
        $role_id=$next_roleId[0]->SysRoleId;
        $notification_data=[
            'notification_for'              =>  $request->service_name,
            'notification_appNo'            =>  $application_number,
            'notification_message'          =>  '',
            'notification_type'             =>  'role',//user
            'notification_access_type'      =>  'all',
            'call_back_link'                =>  'tasklist',
            'user_role_id'                  =>  $role_id,
            'dzo_id'                        =>  $this->getUserDzoId(),
            'working_agency_id'             =>  $this->getWrkingAgencyId(),
            'access_level'                  =>  $this->getAccessLevel(),
            'action_by'                     =>  $this->userId(),
        ];
        return $this->apiService->createData('emis/common/insertNotification', $notification_data);
    }

    public function loaddraftApplication($type=""){
        $response_data = $this->apiService->listData('emis/organization/establishment/loaddraftApplication/'.$type.'/'.$this->userId());
        return $response_data;
    }

    public function loadEstablishmentApplciaiton($record_id=""){
        $response_data = $this->apiService->listData('emis/organization/establishment/loadEstablishmentApplciaiton/'.$record_id);
        return $response_data;
    }

    public function getClass(){
        $classInCheckbox = $this->apiService->listData('emis/organization/establishment/getClass');
        return $classInCheckbox;
    }

    public function getStream(){
        $streamInCheckbox = $this->apiService->listData('emis/organization/establishment/getStream' );
        return $streamInCheckbox;
    }
    public function getClassMappingDetails($mapping_id=""){
        $classmappiongdetails = $this->apiService->listData('emis/organization/establishment/getClassMappingDetails/'.$mapping_id );
        return $classmappiongdetails;
    }


    public function loadOrgApplications($type=""){
        $loadOrgApplications = $this->apiService->listData('emis/organization/establishment/loadOrgApplications/'.$this->userId().'/'.$type );
        return $loadOrgApplications;
    }

    public function loadOrgChangeApplications($type=""){
        $loadOrgChangeApplications = $this->apiService->listData('emis/organization/establishment/loadOrgChangeApplications/'.$this->userId().'/'.$type );
        return $loadOrgChangeApplications;
    }

    public function loadMergerApplications(){
        $dzo_id = $this->getUserDzoId();
        $loadMergerApplications = $this->apiService->listData('emis/organization/establishment/loadMergerApplications/'.$this->userId().'/'.$dzo_id );
        return $loadMergerApplications;
    }

    public function loadClosureApplications(){
        $dzo_id = $this->getUserDzoId();
        $loadMergerApplications = $this->apiService->listData('emis/organization/establishment/loadClosureApplications/'.$this->userId().'/'.$dzo_id );
        return $loadMergerApplications;
    }

    public function loadBifurcationApplications(){
        $dzo_id = $this->getUserDzoId();
        $loadMergerApplications = $this->apiService->listData('emis/organization/establishment/loadBifurcationApplications/'.$this->userId().'/'.$dzo_id );
        return $loadMergerApplications;
    }

    public function loadReopeningApplications(){
        $dzo_id = $this->getUserDzoId();
        $loadMergerApplications = $this->apiService->listData('emis/organization/establishment/loadReopeningApplications/'.$this->userId().'/'.$dzo_id );
        return $loadMergerApplications;
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
            'department'        =>  $request['department'],
            'agencyName'        =>  $request['agencyName'],
            'parentAgency'      =>  $request['parentAgency'],
            'dzongkhag'         =>  $request['dzongkhag'],
            'gewog'             =>  $request['gewog'],
            'chiwog'            =>  $request['chiwog'],
            'agencyType'        =>  $request['agencyType'],
            'action_type'       =>  $request['action_type'],
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

    public function loadheadQuarterDetails($id=""){
        $orgDetails = $this->apiService->listData('emis/organization/headQuater/loadheadQuarterDetails/'.$id);
        return $orgDetails;
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
        // $workflowstatus=$this->getCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $workflowstatus="";
        $workflowdet=json_decode($this->apiService->listData('system/getcurrentworkflowstatus/'.json_decode($updated_data)->data->screen_id.'/'.$this->getRoleIds('roleIds')));

        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/establishment/loadEstbDetailsForVerification/'.$appNo));
        // dd($loadOrganizationDetails);
        if(isset($loadOrganizationDetails->data->app_verification_team) && sizeof($loadOrganizationDetails->data->app_verification_team)>0){
            foreach($loadOrganizationDetails->data->app_verification_team as $vteam){
                $response_data= json_decode($this->apiService->listData('emis/common_services/viewStaffDetails/by_id/'.$vteam->teamMember));
                if($response_data!=null && $response_data!=""){
                    $response_data=$response_data->data;
                    $vteam->name=$response_data->name;
                    $vteam->cid=$response_data->cid_work_permit;
                    $vteam->po_title=$response_data->position_title;
                }
            }
        }
        foreach($workflowdet as $work){
            if(strpos(strtolower($work->Status_Name),'establishment')===false ){
                $workflowstatus=$work->Status_Name;
            }
        }
        // dd($workflowdet);
        if($loadOrganizationDetails!=null){
            $loadOrganizationDetails->app_stage=$workflowstatus;
        }

        //update notification
        $notification_data=[
            'notification_appNo'            =>  $appNo,
            'dzo_id'                        =>  $this->getUserDzoId(),
            'working_agency_id'             =>  $this->getWrkingAgencyId(),
            'access_level'                  =>  $this->getAccessLevel(),
            'action_by'                     =>  $this->userId(),
        ];
        $this->apiService->createData('emis/common/visitedNotification', $notification_data);
        return json_encode($loadOrganizationDetails);
    }
    public function loadEstbDetailsForView($appNo=""){
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/establishment/loadEstbDetailsForVerification/'.$appNo));
        if(isset($loadOrganizationDetails->data->app_verification_team) && sizeof($loadOrganizationDetails->data->app_verification_team)>0){
            foreach($loadOrganizationDetails->data->app_verification_team as $vteam){
                // dd($vteam->teamMember);
                if($vteam->teamMember=="Internal"){
                    $response_data= json_decode($this->apiService->listData('emis/common_services/viewStaffDetails/by_id/'.$vteam->teamMember))->data;
                    if($response_data!=null && $response_data!=""){
                        $vteam->name=$response_data->name;
                        $vteam->cid=$response_data->cid_work_permit;
                        $vteam->po_title=$response_data->position_title;
                    }
                }
            }
        }
        return json_encode($loadOrganizationDetails);
    }

    public function updateTeamVerification(Request $request){
        $udpate_data =[
            'email'                         =>   $request->email,
            'org_id'                        =>   $request->working_agency_id,
            'id'                            =>   $request->id,
            'name'                          =>   $request->name,
            'cid'                           =>   $request->cid,
            'staff_type'                    =>   $request->staff_type,
            'staff_id'                      =>   $request->staff_id,
            'applicationNo'                 =>   $request->applicationNo,
            'user_id'                       =>   $this->userId()
        ];
        // dd($udpate_data);
        $response_data= $this->apiService->createData('emis/organization/establishment/updateTeamVerification', $udpate_data);
        return $response_data;
    }

    public function loadTeamVerificationList($id=""){
        $response_data = $this->apiService->listData('emis/organization/establishment/loadTeamVerificationList/'.$id);
        return $response_data;
    }

    public function loadApprovedOrgs($type=""){
        $response_data = $this->apiService->listData('emis/organization/establishment/loadApprovedOrgs/'.$type);
        return $response_data;
    }

    public function getApprovedOrgDetails($type="",$key=""){

        $response_data ="";
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
            'Applicationdetails'        =>$request->Applicationdetails,

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
        // dd($estd);
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

    public function getschoolList($dzoid=""){
        $param='MinistrySSS'.$dzoid.'SSS'.$this->getWrkingAgencyId();
        $response_data = $this->apiService->listData('emis/organization/establishment/getschoolDetials/'.$param);
        return $response_data;
    }
    public function getFullSchoolDetials($id=""){
        if($id=="sessionDet"){
            $id=$this->getWrkingAgencyId();
        }
        $response_data = $this->apiService->listData('emis/organization/establishment/getFullSchoolDetials/'.$id);
        // dd($response_data);
        return $response_data;
    }

    public function checkPendingApplication($type=""){
        $response_data = $this->apiService->listData('emis/common/checkPendingApplication/'.$type.'/'.$this->userId());
        return $response_data;
    }

    public function getsAgencyList($param=""){
        if($param=="session"){
            $param=$this->getAccessLevel().'SSS'.$this->getUserDzoId().'SSS'.$this->getWrkingAgencyId();
        }
        $loadBasicDetails = $this->apiService->listData('emis/organization/headQuater/getsAgencyList/'.$param);
        return $loadBasicDetails;
    }

    public function getHeadQuarterDetails($id=""){
        $response_data = $this->apiService->listData('emis/organization/headQuater/getHeadQuarterDetails/'.$id);
        return $response_data;
    }

    public function getLocationDetails($id=""){
        $response_data = $this->apiService->listData('emis/organization/establishment/getLocationDetails/'.$id);
        // dd($response_data);
        return $response_data;
    }

    public function getConnectivityDetails($id=""){
        $response_data = $this->apiService->listData('emis/organization/establishment/getConnectivityDetails/'.$id);
        return $response_data;
    }

    public function getSectionDetails($id=""){
        $response_data = $this->apiService->listData('emis/organization/establishment/getSectionDetails/'.$id);
        return $response_data;
    }





}
