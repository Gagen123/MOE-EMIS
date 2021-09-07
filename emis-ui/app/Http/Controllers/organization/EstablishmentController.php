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

    public function saveEstablishment(Request $request){
        $this->validateSchoolFields($request);
        $request['user_id']=$this->userId();
        $response_data= $this->apiService->createData('emis/organization/establishment/saveEstablishment', $request->all());
        return $response_data;
    }

    /**
     * Validation function for various types of Establishments
     */
    private function validateSchoolFields($request){
        $rules = [
            'proposedName'          =>  'required',
            'level'                 =>  'required',
            'category'              =>  'required',
            'gewog'                 =>  'required',
            'chiwog'                =>  'required',
            // 'locationType'          =>  'required',
        ];
        $customMessages = [
            'proposedName.required'         => 'Proposed Name is required',
            'level.required'                => 'Level is required',
            'category.required'             => 'Category is required',
            'dzongkhag.required'            => 'Dzongkhag is required',
            'gewog.required'                => 'Gewog is required',
            'chiwog.required'               => 'Chiwog is required',
            // 'locationType.required'         => 'Location Type  is required',

        ];
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
                'proprietorName'        =>  'required',
                'proprietorCid'         =>  'required|min:11|max:11',
                'proprietorMobile'      =>  'required|min:8|max:8',
                'proprietorEmail'       =>  'required|email',
            ];
            $customMessages = $customMessages+[
                'proprietorName.required'       => 'Proprietor Name is required',
                'proprietorCid.required'        => 'Proprietor CID is required',
                'proprietorEmail.required'      => 'email. is required',
                'proprietorMobile.required'     => 'Mobile No.  is required',
            ];
        }
        $this->validate($request, $rules, $customMessages);
    }


    public function saveClassStream(Request $request){
        $rules = [
            'class'          =>  'required',
        ];
        $customMessages = [
            'class.required'         => 'Class is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id']=$this->userId();
        $response_data= $this->apiService->createData('emis/organization/establishment/saveClassStream', $request->all());
        return $response_data;
    }

    public function saveUploadedFiles(Request $request){
        $application_number = $request->application_number;
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
        // dd($request_data);
        $response_data= $this->apiService->createData('emis/organization/establishment/saveUploadedFiles', $request_data);
        // dd($response_data);
        if($request['action_type']!="edit"){
            $workflowdet=json_decode($this->apiService->listData('system/getRolesWorkflow/submitter/'.$this->getRoleIds('roleIds')));
            // dd($workflowdet);
            $screen_id="";
            $status="";
            $app_role="";
            foreach($workflowdet as $work){
                if(strtolower($work->screenName)==strtolower($request->service_name)){
                    $screen_id=$work->SysSubModuleId;
                    $status=$work->Sequence;
                    $app_role=$work->SysRoleId;
                }
            }
            if($request->submit_type=="reject"){
                $status='0__submitterRejects';
            }
            $workflow_data=[
                'db_name'           =>$this->database_name,
                'table_name'        =>$this->table_name,
                'service_name'      =>$request->service_name,//service name
                'name'              =>$request['proposedName'],//service name
                'application_number'=>$application_number,
                'screen_id'         =>$screen_id,
                'status_id'         =>$status,
                'remarks'           =>$request['remarks'],
                'app_role_id'       => $app_role,
                'user_dzo_id'       =>$this->getUserDzoId(),
                'access_level'      =>$this->getAccessLevel(),
                'working_agency_id' =>$this->getWrkingAgencyId(),
                'action_by'         =>$this->userId(),
            ];
            $app_type="";
            if(strpos($request->service_name,'Establishment of Public School')){
                $app_type="establishment_of_public_school";
            }
            if(strpos($request->service_name,'Establishment of Private School')){
                $app_type="establishment_of_private_school";
            }
            if(strpos($request->service_name,'Establishment of Private ECCD')){
                $app_type="establishment_of_private_eccd";
            }
            if(strpos($request->service_name,'Establishment of Public ECCD')){
                $app_type="establishment_of_public_eccd";
            }
            if(strpos($request->service_name,'Establishment of Public ECR')){
                $app_type="establishment_of_public_ecr";
            }
            // dd($workflow_data);
            $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);

            //Notification preparation
            $workflowdet=json_decode($this->apiService->getListData('system/getScreenAccess/workflow__'.$app_type.'/'.$this->getRoleIds('roleIds')));
            // dd($workflowdet[0]->SysSubModuleId,$workflowdet[0]->Sequence+1);
            $seq=((int) $workflowdet[0]->Sequence +1);
            $next_roleId=json_decode($this->apiService->listData('system/getRolesWorkflow/submittedTo/'.$workflowdet[0]->SysSubModuleId.'__'.$seq));
            $role_id=$next_roleId[0]->SysRoleId;
            $notification_data=[
                'notification_for'              =>  $request->service_name,
                'notification_appNo'            =>  $application_number,
                'notification_message'          =>  '',
                'notification_type'             =>  'role',
                'notification_access_type'      =>  'all',
                'call_back_link'                =>  'tasklist',
                'user_role_id'                  =>  $role_id,
                'dzo_id'                        =>  $this->getUserDzoId(),
                'working_agency_id'             =>  $this->getWrkingAgencyId(),
                'access_level'                  =>  $this->getAccessLevel(),
                'action_by'                     =>  $this->userId(),
            ];
            $this->apiService->createData('emis/common/insertNotification', $notification_data);
        }
        return $response_data;
    }


    public function getClass(){
        $classInCheckbox = $this->apiService->listData('emis/organization/establishment/getClass');
        // $response_data=json_decode($classInCheckbox);
        // $classInCheckbox = collect($response_data)->sortBy('sequence')->toArray();
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

    public function updateNewEstablishmentApplication(Request $request){
        $work_status=json_decode($this->apiService->listData('system/getRolesWorkflow/verificationApproval/'.$this->getRoleIds('roleIds')));
        $screen_id="";
        $service_name='New Establishment of '.$request->servicename;

        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'OrganizationVerification';
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
                            'application_number'     =>  $request->applicationNo,
                            // 'remark'                 =>  $remarks[$index]
                        )
                    );
                }
            }
        }

        foreach($work_status as $i=> $work){
            if($work->screenName==$service_name){
                $screen_id=$work->SysSubModuleId;
                $work_status=$work->Sequence;
            }
        }
        $org_status='Verified';
        if($request->actiontype=="reject"){
            $work_status=0;
            $org_status="Rejected";
        }
        if($request->actiontype=="approve"){
            $org_status="Approved";
        }
        if($request->actiontype!="update"){
            $workflow_data=[
                'service_name'      =>$service_name,//service name
                'screen_id'         =>$screen_id,
                'db_name'           =>$this->database_name,
                'table_name'        =>$this->table_name,
                'application_number'=>$request->applicationNo,
                'status_id'         =>$work_status,
                'remarks'           =>$request->remarks,
                'user_dzo_id'       =>$this->getUserDzoId(),
                'access_level'      =>$this->getAccessLevel(),
                'working_agency_id' =>$this->getWrkingAgencyId(),
                'action_by'         =>$this->userId(),
            ];
            // dd($workflow_data,$request->servicename);
            $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        }

        $estd =[
            'status'                       =>   $org_status,
            'application_number'           =>   $request->applicationNo,
            'id'                           =>   $request->id,
            'remarks'                      =>   $request->remarks,
            'verifying_agency'             =>   $request->verifying_agency,
            'tentative_date'               =>   $request->tentative_date,
            'update_type'                  =>   $request->update_type,
            'nomi_staffList'               =>   json_decode($request->nomi_staffList),
            'attachment_details'           =>  $attachment_details,
            'user_id'                      =>   $this->userId()
        ];
        // dd($estd,$request->actiontype);
        $response_data= $this->apiService->createData('emis/organization/establishment/updateEstablishment', $estd);
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

    public function loaddraftApplication($type=""){
        $response_data = $this->apiService->listData('emis/organization/establishment/loaddraftApplication/'.$type.'/'.$this->userId());
        // dd($response_data);
        return $response_data;
    }

    public function loadEstablishmentApplciaiton($record_id=""){
        $response_data = $this->apiService->listData('emis/organization/establishment/loadEstablishmentApplciaiton/'.$record_id);
        return $response_data;
    }

}
