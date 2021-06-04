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
        
        switch($request['establishment_type']){
            case "public_school" : {
                    $this->service_name = "Public School";
                    $validation = $this->validatePublicSchoolFields($request);
                    $establishment_data = $this->setPublicSchoolFields($request);
                    break;
                }
            case "private_school" : {
                    $this->service_name = "Private School";
                    $validation = $this->validatePrivateSchoolFields($request);
                    $establishment_data = $this->setPrivateSchoolFields($request);
                    break;
                }
            case "public_eccd" : {
                    $this->service_name = "Public ECCD";
                    $validation = $this->validatePublicEccdFields($request);
                    $establishment_data = $this->setPublicEccdFields($request);
                    break;
                }
            case "private_eccd" : {
                    $this->service_name = "Private ECCD";
                    $validation = $this->validatePrivateEccdFields($request);
                    $establishment_data = $this->setPrivateEccdFields($request);
                    break;
                }
            case "public_ecr" : {
                    $this->service_name = "Public ECR";
                    $validation = $this->validatePublicEccdFields($request);
                    $establishment_data = $this->setPublicEccdFields($request);
                    break;
                }
            default : {
                
                break;
            }
        }

        $rules = $validation['rules'];
        $customMessages = $validation['messages'];

        $this->validate($request, $rules, $customMessages);
        $establishment_data=$establishment_data+[
            'app_id'                =>  $request['app_id'],
            'ap_estb_id'            =>  $request['ap_estb_id'],
        ];
        // dd($establishment_data);
        $response_data= $this->apiService->createData('emis/organization/establishment/saveEstablishment', $establishment_data);
        // dd($response_data);
        return $response_data;
    }

    public function saveUploadedFiles(Request $request){
        $application_number = $request->application_number;
        $files = $request->attachments;
        // dd($files);
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
                            // 'remark'                 =>  $remarks[$index]
                        )
                    );
                }
            }
        }

        $request_data =[
            'attachment_details'                =>  $attachment_details,
            'application_number'                =>  $application_number,
            'user_id'                           =>  $this->userId() 
        ];
        // dd( $request_data);
        $response_data= $this->apiService->createData('emis/organization/establishment/saveUploadedFiles', $request_data);
        return $response_data;
    }


    public function saveClassStream(Request $request){
        // $rules = [
        //     'class'          =>  'required',
        // ];
        // $customMessages = [
        //     'class.required'         => 'Class is required',
        // ];
        // $this->validate($request, $rules, $customMessages);
        $classStream =[
            'class'                 =>  $request['class'],
            'stream'                =>  $request['stream'],
            'proposed_establishment'    =>  $request['proposed_establishment'],
            'application_number'    =>  $request['application_number'],
            'status'                =>  $request['status'],
            'action_type'           =>  $request['action_type'],
            'user_id'               =>  $this->userId() ,
        ];
        // dd($classStream);
        $response_data= $this->apiService->createData('emis/organization/establishment/saveClassStream', $classStream);
        // dd( $response_data);
        //get submitter role
        if($request['action_type']!="edit"){
            $workflowdet=json_decode($this->apiService->listData('system/getRolesWorkflow/submitter/'.$this->getRoleIds('roleIds')));
            $screen_id="";
            $status="";
            $app_role="";
            $service_name=json_decode($response_data)->data->establishment_type;
            foreach($workflowdet as $work){
                if($work->Establishment_type==str_replace (' ', '_',strtolower($service_name))){
                    $screen_id=$work->SysSubModuleId;
                    $status=$work->Sequence;
                    $app_role=$work->SysRoleId;
                }
            }

            $workflow_data=[
                'db_name'           =>$this->database_name,
                'table_name'        =>$this->table_name,
                'service_name'      =>$service_name,//service name 
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
            $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
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

    public function loadOrgApplications($type=""){
        $loadOrgApplications = $this->apiService->listData('emis/organization/establishment/loadOrgApplications/'.$this->userId().'/'.$type );
        return $loadOrgApplications;
    }

    public function loadOrgChangeApplications($type=""){
        $loadOrgChangeApplications = $this->apiService->listData('emis/organization/establishment/loadOrgChangeApplications/'.$this->userId().'/'.$type );
        return $loadOrgChangeApplications;
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
        $service_name=$loadOrganizationDetails->data->establishment_type;
        if(isset($loadOrganizationDetails->data->app_verification_team) && sizeof($loadOrganizationDetails->data->app_verification_team)>0){
            foreach($loadOrganizationDetails->data->app_verification_team as $vteam){
                $response_data= json_decode($this->apiService->listData('emis/common_services/viewStaffDetails/by_id/'.$vteam->teamMember))->data;
                $vteam->name=$response_data->name;
                $vteam->cid=$response_data->cid_work_permit;
                $vteam->po_title=$response_data->position_title;
            } 
        }
        foreach($workflowdet as $work){
            if(strpos(strtolower($work->Status_Name),'establishment')===false && $work->Establishment_type==str_replace (' ', '_',strtolower($service_name))){
                $workflowstatus=$work->Status_Name;
            }
        }
        if($loadOrganizationDetails!=null){
            $loadOrganizationDetails->app_stage=$workflowstatus;
        }
        return json_encode($loadOrganizationDetails);
    }
    public function loadEstbDetailsForView($appNo=""){
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/establishment/loadEstbDetailsForVerification/'.$appNo));
        if(isset($loadOrganizationDetails->data->app_verification_team) && sizeof($loadOrganizationDetails->data->app_verification_team)>0){
            foreach($loadOrganizationDetails->data->app_verification_team as $vteam){
                $response_data= json_decode($this->apiService->listData('emis/common_services/viewStaffDetails/by_id/'.$vteam->teamMember))->data;
                $vteam->name=$response_data->name;
                $vteam->cid=$response_data->cid_work_permit;
                $vteam->po_title=$response_data->position_title;
            } 
        }
        return json_encode($loadOrganizationDetails);
    }

    public function updateNewEstablishmentApplication(Request $request){
        $work_status=json_decode($this->apiService->listData('system/getRolesWorkflow/verificationApproval/'.$this->getRoleIds('roleIds')));
        $w_status_screen=[];
        $screen_id="";
        $service_name=$request->servicename;

        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $remarks = $request->remarks;
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
            if($work->Establishment_type==str_replace (' ', '_',strtolower($request->servicename))){
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
            'applicaitondetails'        =>$request->applicaitondetails,
            
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
    
    /**
     * Validation function for various types of Establishments
     */

    private function validatePublicSchoolFields($request){

        $rules = [
            'initiatedBy'           =>  'required',
            'proposedName'          =>  'required',
            'level'                 =>  'required',
            'category'              =>  'required',
            'gewog'                 =>  'required',
            'chiwog'                =>  'required',
            'locationType'          =>  'required',
            'senSchool'             =>  'required',
        ];
        $customMessages = [
            'initiatedBy.required'          => 'Proposal Initiated By is required',
            'proposedName.required'         => 'Proposed Name is required',
            'level.required'                => 'Level is required',
            'category.required'             => 'Category is required',
            'dzongkhag.required'            => 'Dzongkhag is required',
            'gewog.required'                => 'Gewog is required',
            'chiwog.required'               => 'Chiwog is required',
            'locationType.required'         => 'Location Type  is required',
            'senSchool.required'            => 'Sen School is required',
            
        ];
        $validation = array();
        $validation['rules'] = $rules;
        $validation['messages'] = $customMessages;

        return ($validation);
    }

    private function validatePrivateSchoolFields($request){

        $rules = [
            'proprietorName'        =>  'required',
            'proprietorCid'         =>  'required|min:11|max:11',
            'proprietorPhone'       =>  'required|min:6|max:6',
            'proprietorMobile'      =>  'required|min:8|max:8',
            'proprietorEmail'       =>  'required|email',
            'totalLand'             =>  'required',
            'enrollmentBoys'        =>  'required',
            'enrollmentGirls'       =>  'required',
            'proposedName'          =>  'required',
            'proposedLocation'      =>  'required',
            'typeOfSchool'          =>  'required',
            'level'                 =>  'required',
            'category'              =>  'required',
            'dzongkhag'             =>  'required',
            'gewog'                 =>  'required',
            'chiwog'                =>  'required',
        ];
        $customMessages = [
            'proprietorName.required'       => 'Proprietor Name is required',
            'proprietorCid.required'        => 'Proprietor CID is required',
            'proprietorPhone.required'      => 'Phone No. is required',
            'proprietorMobile.required'     => 'Mobile No.  is required',
            'totalLand.required'            => 'Total Land proposed is required',
            'enrollmentBoys.required'       => 'Expected Enrollment is required',
            'enrollmentGirls.required'      => 'Expected Enrollment is required',
            'typeOfSchool.required'         => 'Type of School is required',
            'proposedName.required'         => 'Proposed Name is required',
            'proposedLocation.required'     => 'Proposed Location is required',
            'level.required'                => 'Level is required',
            'category.required'             => 'Category is required',
            'dzongkhag.required'            => 'Dzongkhag is required',
            'gewog.required'                => 'Gewog is required',
            'chiwog.required'               => 'Chiwog is required',
            
        ];
        $validation = array();
        $validation['rules'] = $rules;
        $validation['messages'] = $customMessages;

        return $validation;
    }

    private function validatePublicEccdFields($request){

        $rules = [
            'initiatedBy'           =>  'required',
            'proposedName'          =>  'required',
            'proposedLocation'      =>  'required',
            'category'              =>  'required',
            'gewog'                 =>  'required',
            'chiwog'                =>  'required'
        ];
        $customMessages = [
            'initiatedBy.required'          => 'Proposal Initiated By is required',
            'proposedName.required'         => 'Proposed Name is required',
            'proposedLocation.required'     => 'Proposed Location is required',
            'category.required'             => 'Category is required',
            'dzongkhag.required'            => 'Dzongkhag is required',
            'gewog.required'                => 'Gewog is required',
            'chiwog.required'               => 'Chiwog is required',
            
        ];
        $validation = array();
        $validation['rules'] = $rules;
        $validation['messages'] = $customMessages;

        return ($validation);
    }

    private function validatePrivateEccdFields($request){

        $rules = [
            'proprietorName'        =>  'required',
            'proprietorCid'         =>  'required|min:11|max:11',
            'proprietorPhone'       =>  'required|min:6|max:6',
            'proprietorMobile'      =>  'required|min:8|max:8',
            'proprietorEmail'       =>  'required|email',
            'proposedInfrastructure'    =>  'required',
            'proposedName'              =>  'required',
            'proposedLocation'          =>  'required',
            'category'                  =>  'required',
            'dzongkhag'                 =>  'required',
            'gewog'                     =>  'required',
            'chiwog'                    =>  'required'
        ];
        $customMessages = [
            'proprietorName.required'           => 'Proprietor Name is required',
            'proprietorCid.required'            => 'Proprietor CID is required',
            'proprietorPhone.required'          => 'Phone No. is required',
            'proprietorMobile.required'         => 'Mobile No.  is required',
            'proposedInfrastructure.required'   => 'Infrastructure to be housed in is required',
            'proposedName.required'             => 'Proposed Name is required',
            'proposedLocation.required'         => 'Proposed Location is required',
            'category.required'                 => 'Category is required',
            'dzongkhag.required'                => 'Dzongkhag is required',
            'gewog.required'                    => 'Gewog is required',
            'chiwog.required'                   => 'Chiwog is required'
            
        ];
        $validation = array();
        $validation['rules'] = $rules;
        $validation['messages'] = $customMessages;

        return ($validation);
    }

    /**
     * Setting the data fields to be saved
     */

    private function setPublicSchoolFields($request){

        $estd =[
            'initiatedBy'                  =>  $request['initiatedBy'],
            'proposedName'                 =>  $request['proposedName'],
            'level'                        =>  $request['level'],
            'category'                     =>  $request['category'],
            'dzongkhag'                    =>  $request['dzongkhag'],
            'gewog'                        =>  $request['gewog'],
            'chiwog'                       =>  $request['chiwog'],
            'locationType'                 =>  $request['locationType'],
            'senSchool'                    =>  $request['senSchool'],
            'isfeedingschool'              =>  $request['isfeedingschool'],
            'feeding'                      =>  $request['feeding'],
            'geopoliticallyLocated'        =>  $request['geopoliticallyLocated'],
            'status'                       =>  $request['status'],
            'establishment_type'           =>  $request['establishment_type'],
            'proposed_establishment'       =>  $this->service_name,
            'id'                           =>  $request['id'],
            'action_type'                  =>  $request['action_type'],
            'application_number'           =>  $request['application_number'],
            'user_id'                      =>  $this->userId() 
        ];

        return $estd;
    }

    private function setPrivateSchoolFields($request){

        $estd =[
            'proprietorName'               =>  $request['proprietorName'],
            'proprietorCid'                =>  $request['proprietorCid'],
            'proprietorPhone'              =>  $request['proprietorPhone'],
            'proprietorMobile'             =>  $request['proprietorMobile'],
            'proprietorEmail'              =>  $request['proprietorEmail'],
            'totalLand'                    =>  $request['totalLand'],
            'enrollmentBoys'               =>  $request['enrollmentBoys'],
            'enrollmentGirls'              =>  $request['enrollmentGirls'],
            'proposedLocation'             =>  $request['proposedLocation'],
            'typeOfSchool'                 =>  $request['typeOfSchool'],
            'proposedName'                 =>  $request['proposedName'],
            'level'                        =>  $request['level'],
            'category'                     =>  $request['category'],
            'dzongkhag'                    =>  $request['dzongkhag'],
            'gewog'                        =>  $request['gewog'],
            'chiwog'                       =>  $request['chiwog'],
            'status'                       =>  $request['status'],
            'establishment_type'           =>  $request['establishment_type'],
            'proposed_establishment'       =>  $this->service_name,
            'action_type'                  =>  $request['action_type'],
            'application_number'           =>  $request['application_number'],
            'id'                           =>  $request['id'],
            'user_id'                      =>  $this->userId() 
        ];

        return $estd;
    }

    private function setPublicEccdFields($request){

        $estd =[
            'initiatedBy'                  =>  $request['initiatedBy'],
            'proposedName'                 =>  $request['proposedName'],
            'category'                     =>  $request['category'],
            'dzongkhag'                    =>  $request['dzongkhag'],
            'gewog'                        =>  $request['gewog'],
            'chiwog'                       =>  $request['chiwog'],
            'proposedLocation'             =>  $request['proposedLocation'],
            'locationType'                 =>  $request['locationType'],
            'status'                       =>  $request['status'],
            'establishment_type'           =>  $request['establishment_type'],
            'coLocatedParent'              =>  $request['coLocatedParent'],
            'parentSchool'                 =>  $request['parentSchool'],
            'proposed_establishment'       =>  $this->service_name,
            'action_type'                  =>  $request['action_type'],
            'application_number'           =>  $request['application_number'],
            'id'                           =>  $request['id'],
            'user_id'                      =>  $this->userId() 
        ];

        return $estd;
    }

    private function setPrivateEccdFields($request){

        $estd =[
            'proprietorName'               =>  $request['proprietorName'],
            'proprietorCid'                =>  $request['proprietorCid'],
            'proprietorPhone'              =>  $request['proprietorPhone'],
            'proprietorMobile'             =>  $request['proprietorMobile'],
            'proprietorEmail'              =>  $request['proprietorEmail'],
            'proposedInfrastructure'       =>  $request['proposedInfrastructure'],
            'proposedName'                 =>  $request['proposedName'],
            'proposedLocation'             =>  $request['proposedLocation'],
            'category'                     =>  $request['category'],
            'dzongkhag'                    =>  $request['dzongkhag'],
            'gewog'                        =>  $request['gewog'],
            'chiwog'                       =>  $request['chiwog'],
            'status'                       =>  $request['status'],
            'establishment_type'           =>  $request['establishment_type'],
            'action_type'                  =>  $request['action_type'],
            'application_number'           =>  $request['application_number'],
            'proposed_establishment'       =>  $this->service_name,
            'id'                           =>  $request['id'],
            'user_id'                      =>  $this->userId() 
        ];

        return $estd;
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
