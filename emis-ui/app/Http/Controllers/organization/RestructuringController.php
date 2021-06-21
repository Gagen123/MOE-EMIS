<?php

namespace App\Http\Controllers\organization;

use Illuminate\Support\Facades\Storage;
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

    public $service_name="Change Details";
    public $service_name_closure="Closure";
    public $merge_service_name="Merger";
    public $bif_service_name="Bifurcation";

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveChangeBasicDetails(Request $request){
        $this->service_name = $request['application_for'];

        //File Upload
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').$request['application_type'];
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
                            'saveapplication_number'     =>  $request->applicationNo,
                        )
                    );
                }
            }
        }
        $request['attachment_details'] = $attachment_details;
        $establishment_data="";
        $validation ="";
        // dd($request['application_type']);
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
            case "downgradation" : {
                    $validation = $this->validateChangeInLevel($request);
                    $establishment_data = $this->setChangeInLevel($request);
                    break;
                }
            case "upgradation" : {
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
            case "autonomus_change" : {
                $validation = $this->validateGeneralChange($request);
                $establishment_data = $this->setAutonomous($request);
                break;
            }
            case "location_type_change" : {
                $validation = $this->validateGeneralChange($request);
                $establishment_data = $this->setLocationChange($request);
                break;
            }
            case "expension_change" : {
                $validation = $this->validateGeneralChange($request);
                $establishment_data = $this->setExtension($request);
                break;
            }
            case "fee_structure_change" : {
                $validation = $this->validateGeneralChange($request);
                $establishment_data = $this->setFeeStructure($request);
                break;
            }
            case "boarding_change" : {
                $validation = $this->validateGeneralChange($request);
                $establishment_data = $this->setBoarding($request);
                break;
            }
            case "stream_change" : {
                $validation = $this->validateGeneralChange($request);
                $establishment_data = $this->setchangeofstream($request);
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
        $establishment_data=$establishment_data+[
            'attachment_details'            =>   $attachment_details,
        ];
        // dd($establishment_data);
        $workflowdet=json_decode($this->apiService->listData('system/getRolesWorkflow/submitter/'.$this->getRoleIds('roleIds')));
        // dd($workflowdet,$request->application_for);
        $screen_id="";
        $status="";
        $app_role="";
        $screen_name="";
        foreach($workflowdet as $work){
            if($work->screenName==$request->application_for){
                $screen_id=$work->SysSubModuleId;
                $status=$work->Sequence;
                $app_role=$work->SysRoleId;
                $screen_name=$work->screenName;
            }
        }
        if($screen_id==null || $screen_id==""){
            return 'No Screen';
        }
        // dd($establishment_data);
        $response_data= $this->apiService->createData('emis/organization/changeDetails/saveBasicChangeDetails', $establishment_data);
        // dd($response_data,$workflowdet,$request->application_for);
        if($request->action_type!="edit"){
            $workflow_data=[
                'db_name'           =>$this->database_name,
                'table_name'        =>$this->table_name,
                'service_name'      =>$screen_name,//screen name
                'application_number'=>json_decode($response_data)->data->application_no,
                'name'              =>$request['application_for'], //Organizaiton Name
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
        // return $response_data;
    }
    public function deleteFile($full_path="",$id=""){
        $full_path=str_replace('SSS','/',$full_path);
        $headers = ['Content-Type: application/pdf'];
        $file_name = explode('/',$full_path);
        $finel_name = end($file_name);
        // dd($full_path);
        // $response_data = $this->apiService->deleteData("emis/organization/changeDetails/deleteFile", $id);
        $response_data="";
        if (file_exists($full_path)){
            unlink($full_path);
            $response_data = $this->apiService->deleteData("emis/organization/changeDetails/deleteFile", $id);
        }
        return $response_data;
    }

    public function getChangeBasicDetails($appId=""){
        $loadPriviousOrgDetails = $this->apiService->listData('emis/organization/changeDetails/getChangeBasicDetails/'.$appId);
        return $loadPriviousOrgDetails;
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

        // $workflowstatus=$this->getCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $workflowstatus="";
        $screen_id="";
        $sequence="";
        $workflowdet=json_decode($this->apiService->listData('system/getcurrentworkflowstatus/'.json_decode($updated_data)->data->screen_id.'/'.$this->getRoleIds('roleIds')));
        // dd($workflowdet);
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/changeDetails/loadChangeDetailForVerification/'.$appNo));
        // dd($this->apiService->listData('emis/organization/changeDetails/loadChangeDetailForVerification/'.$appNo));
        $service_name=$loadOrganizationDetails->data->establishment_type;//pulled category from existing organization details to match the data for verification
        // dd($service_name,$workflowdet);
        foreach($workflowdet as $work){
            //check with screen name and then type of organization
            // dd(strtolower($work->screenName),$work->Establishment_type,$service_name);
            if($work->Sequence!=1 && $work->screenName==$service_name){
                $workflowstatus=$work->Status_Name;
                $screen_id=$work->SysSubModuleId;
                $sequence=$work->Sequence;
            }
        }
        if($loadOrganizationDetails!=null){
            $loadOrganizationDetails->app_stage=$workflowstatus;
            $loadOrganizationDetails->screen_id=$screen_id;
            $loadOrganizationDetails->sequence=$sequence;
        }
        // dd($loadOrganizationDetails);
        // $loadOrganizationDetails->app_stage=$workflowstatus;
        return json_encode($loadOrganizationDetails);
    }
    public function loadPriviousOrgDetails($orgId=""){
        $loadPriviousOrgDetails = json_decode($this->apiService->listData('emis/organization/changeDetails/loadPriviousOrgDetails/'.$orgId));
        return json_encode($loadPriviousOrgDetails);
    }

    public function updateChangeBasicDetailApplication(Request $request){
        // $workflowdet=$this->getcurrentworkflowStatusForUpdate('change');
        // $work_status=json_decode($this->apiService->listData('system/getRolesWorkflow/verificationApproval/'.$this->getRoleIds('roleIds')));
        // $w_status_screen=[];
        // $screen_id="";
        // foreach($work_status as $i=> $work){
        //     if($work->Establishment_type==$request->category){
        //         $screen_id=$work->SysSubModuleId;
        //         $work_status=$work->Sequence;
        //     }
        // }

        $org_status='Verified';
        $work_status=$request->sequence;
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
            'service_name'      =>$request->service_name,
            'application_number'=>$request->applicationNo,
            'screen_id'         =>$request->screen_id,//pulled while loading details for verification
            'status_id'         =>$work_status,//pulled while loading details for verification
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        // dd($workflow_data);
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);

        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $remarks = $request->remarks;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'ChangeVerification';
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
                            'saveapplication_number'     =>  $request->applicationNo,
                            // 'remark'                 =>  $remarks[$index]
                        )
                    );
                }
            }
        }

        $estd =[
            'status'                        =>   $org_status,
            'calssXIXII'                    =>   $request->calssXIXII,
            'application_number'            =>   $request->applicationNo,
            'remarks'                       =>   $request->remarks,
            'attachment_details'            =>   $attachment_details,
            'user_id'                       =>   $this->userId()
        ];
        // dd($estd);
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
        ];
        $customMessages = [
            'proposedName.required' =>  'Name is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $merger =[
            'orgId1'                   =>       $request['orgId1'],
            'orgId2'                   =>       $request['orgId2'],
            'proposedName'             =>       $request['proposedName'],
            'id'                       =>       $request['id'],
            'user_id'                  =>       $this->userId()
        ];

        $response_data= $this->apiService->createData('emis/organization/merger/saveMerger', $merger);
        // dd($response_data);

        //Work Flow Process (based on Public School Establishment)
        //get submitter role
        if($request['action_type']!="edit"){
            $workflowdet=json_decode($this->apiService->listData('system/getRolesWorkflow/submitter/'.$this->getRoleIds('roleIds')));
            // dd($workflowdet);
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
            if($request->submit_type=="reject"){
                $status='0__submitterRejects';
            }

            $workflow_data=[
                'db_name'           =>$this->database_name,
                'table_name'        =>$this->table_name,
                'service_name'      =>'Merger',//service name
                'name'              =>'Merger',//service name
                'application_number'=>json_decode($response_data)->data->application_no,
                'screen_id'         =>$screen_id,
                'status_id'         =>$status,
                'remarks'           =>$request['remarks'],
                'app_role_id'       => $app_role,
                'user_dzo_id'       =>$this->getUserDzoId(),
                'access_level'      =>$this->getAccessLevel(),
                'working_agency_id' =>$this->getWrkingAgencyId(),
                'action_by'         =>$this->userId(),
            ];
            // dd($workflow_data);
            $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        }

        // $workflowdet=json_decode($this->apiService->listData('system/getRolesWorkflow/submitter/'.$this->getRoleIds('roleIds')));
        // dd($workflowdet);
        // $screen_id="";
        // $status="";
        // $app_role="";
        // foreach($workflowdet as $work){
        //     if(strpos(strtolower($work->screenName),'merge')!==false){
        //         $screen_id=$work->SysSubModuleId;
        //         $status=$work->Sequence;
        //         $app_role=$work->SysRoleId;
        //     }
        // }
        // // $workflowdet=$this->getsubmitterStatus('merge');
        // $workflow_data=[
        //     'db_name'           =>$this->database_name,
        //     'table_name'        =>$this->bif_table_name,
        //     'service_name'      =>'Merger',
        //     'application_number'=>json_decode($response_data)->data->application_no,
        //     'screen_id'         => $screen_id,
        //     'status_id'         =>$status,
        //     'app_role_id'       => $app_role,
        //     'remarks'           =>null,
        //     'user_dzo_id'       =>$this->getUserDzoId(),
        //     'access_level'      =>$this->getAccessLevel(),
        //     'working_agency_id' =>$this->getWrkingAgencyId(),
        //     'action_by'         =>$this->userId(),
        // ];
        // // dd($workflow_data);
        // $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        return $response_data;
    }

    public function loadMergerForVerification($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=$this->apiService->createData('emis/common/updateTaskDetails',$update_data);

        // $workflowstatus=$this->getCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $workflowstatus="";
        $screen_id="";
        $sequence="";
        $workflowstatus="";
        $workflowdet=json_decode($this->apiService->listData('system/getcurrentworkflowstatus/'.json_decode($updated_data)->data->screen_id.'/'.$this->getRoleIds('roleIds')));
        // dd($workflowdet);
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/merger/loadMergerForVerification/'.$appNo));
        //dd($this->apiService->listData('emis/organization/merger/loadMergerForVerification/'.$appNo));
        $service_name=$loadOrganizationDetails->data->category;//pulled category from existing organization details to match the data for verification
        // dd($service_name,$workflowdet);
        foreach($workflowdet as $work){
            //check with screen name and then type of organization
            if($work->Sequence!=1 && strpos(strtolower($work->screenName),'merge')!==false && $work->Establishment_type==str_replace (' ', '_',strtolower($service_name))){
                $workflowstatus=$work->Status_Name;
                $screen_id=$work->SysSubModuleId;
                $sequence=$work->Sequence;
            }
        }
        if($loadOrganizationDetails!=null){
            $loadOrganizationDetails->app_stage=$workflowstatus;
            $loadOrganizationDetails->screen_id=$screen_id;
            $loadOrganizationDetails->sequence=$sequence;
        }
        // dd($loadOrganizationDetails);
        // $loadOrganizationDetails->app_stage=$workflowstatus;
        return json_encode($loadOrganizationDetails);
    }

    public function updateMergerApplication(Request $request){
        //updating the work flow and status

        $org_status='Verified';
        $work_status=$request->sequence;
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
            'service_name'      =>$request->service_name,
            'application_number'=>$request->applicationNo,
            'screen_id'         =>$request->screen_id,//pulled while loading details for verification
            'status_id'         =>$work_status,//pulled while loading details for verification
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        // dd($workflow_data);
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);

        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $remarks = $request->remarks;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'MergerVerification';
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
                            'saveapplication_number'     =>  $request->applicationNo,
                            // 'remark'                 =>  $remarks[$index]
                        )
                    );
                }
            }
        }


        //change the following for each type of application

        $estd =[
            'status'                       =>   $org_status,
            'application_number'           =>   $request->applicationNo,
            'remarks'                      =>   $request->remarks,
            'user_id'                      =>   $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/organization/merger/updateMergerDetails', $estd);
        return $work_response_data;
    }

    public function saveClosure(Request $request){
        // dd($request);
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $remarks = $request->remarks;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'closure';
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
                            'saveapplication_number'     =>  $request->applicationNo,
                            // 'remark'                 =>  $remarks[$index]
                        )
                    );
                }
            }
        }

        $rules = [
            'reason'          =>  'required',
            'organizationId'  =>   'required'
        ];
        $customMessages = [
            'reason.required'           => 'Reason is required',
            'organizationId.required'   => 'Organization is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $closure =[
            'organizationId'    =>$request['organizationId'],
            'reason'            =>$request['reason'],
            'remark'            =>$request['remark'],
            'id'                =>$request['id'],
            'attachment_details'       =>$attachment_details,
            'user_id'           =>$this->userId()
        ];
        // dd($closure);
        $response_data= $this->apiService->createData('emis/organization/closure/saveClosure', $closure);
        // dd($response_data);
        //Work Flow Process (based on Public School Establishment)
        //get submitter role
        if($request['action_type']!="edit"){
            $workflowdet=json_decode($this->apiService->listData('system/getRolesWorkflow/submitter/'.$this->getRoleIds('roleIds')));
            // dd($workflowdet,$request->application_for);
            $screen_id="";
            $status="";
            $screen_name="";
            $app_role="";
            foreach($workflowdet as $work){
                if($work->screenName==$request->application_for){
                    $screen_id=$work->SysSubModuleId;
                    $status=$work->Sequence;
                    $app_role=$work->SysRoleId;
                    $screen_name=$work->screenName;
                }
            }
            if($request->submit_type=="reject"){
                $status='0__submitterRejects';
            }
            $workflow_data=[
                'db_name'           =>$this->database_name,
                'table_name'        =>$this->table_name,
                'service_name'      =>$screen_name,//service name
                'name'              =>'Closure',//service name
                'application_number'=>json_decode($response_data)->data->application_no,
                'screen_id'         =>$screen_id,
                'status_id'         =>$status,
                'remarks'           =>$request['remarks'],
                'app_role_id'       =>$app_role,
                'user_dzo_id'       =>$this->getUserDzoId(),
                'access_level'      =>$this->getAccessLevel(),
                'working_agency_id' =>$this->getWrkingAgencyId(),
                'action_by'         =>$this->userId(),
            ];
            // dd($workflow_data);
            $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
            // dd(json_decode($response_data));
        }

        return $response_data;
    }

    public function loadClosureForVerification($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=$this->apiService->createData('emis/common/updateTaskDetails',$update_data);

        // $workflowstatus=$this->getCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $workflowstatus="";
        $screen_id="";
        $sequence="";
        $workflowstatus="";
        $workflowdet=json_decode($this->apiService->listData('system/getcurrentworkflowstatus/'.json_decode($updated_data)->data->screen_id.'/'.$this->getRoleIds('roleIds')));
        // dd($workflowdet);
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/closure/loadClosureForVerification/'.$appNo));
        //dd($this->apiService->listData('emis/organization/closure/loadClosureForVerification/'.$appNo));
        $service_name=$loadOrganizationDetails->data->category;//pulled category from existing organization details to match the data for verification
        // dd($service_name,$workflowdet);
        foreach($workflowdet as $work){
            //check with screen name and then type of organization
            if($work->Sequence!=1 && strpos(strtolower($work->screenName),'closure')!==false && $work->Establishment_type==str_replace (' ', '_',strtolower($service_name))){
                $workflowstatus=$work->Status_Name;
                $screen_id=$work->SysSubModuleId;
                $sequence=$work->Sequence;
            }
        }
        if($loadOrganizationDetails!=null){
            $loadOrganizationDetails->app_stage=$workflowstatus;
            $loadOrganizationDetails->screen_id=$screen_id;
            $loadOrganizationDetails->sequence=$sequence;
        }
        // dd($loadOrganizationDetails);
        // $loadOrganizationDetails->app_stage=$workflowstatus;
        return json_encode($loadOrganizationDetails);
    }


    /**
     * Old function written by Ugyen
     * Delete if not used
     */

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
        //updating the work flow and status

        $org_status='Verified';
        $work_status=$request->sequence;
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
            'service_name'      =>$request->service_name,
            'application_number'=>$request->applicationNo,
            'screen_id'         =>$request->screen_id,//pulled while loading details for verification
            'status_id'         =>$work_status,//pulled while loading details for verification
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        // dd($workflow_data);
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);

        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $remarks = $request->remarks;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'ClosureVerification';
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
                            'saveapplication_number'     =>  $request->applicationNo,
                            // 'remark'                 =>  $remarks[$index]
                        )
                    );
                }
            }
        }


        //change the following for each type of application

        $estd =[
            'status'                        =>   $org_status,
            'application_number'            =>   $request->applicationNo,
            'remarks'                       =>   $request->yourRemark,
            'attachment_details'            =>   $attachment_details,
            'user_id'                       =>   $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/organization/closure/updateClosureDetails', $estd);
        // dd($response_data);
        return $work_response_data;

        //Ugyen's old route

        // // dd($closure);
        // $response_data= $this->apiService->createData('emis/organization/closure/updateClosure', $closure);
        // return $work_response_data;
    }

    public function saveBifurcation(Request $request){
        $rules = [
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

        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').$request['application_type'];
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
                            'saveapplication_number'     =>  $request->applicationNo,
                        )
                    );
                }
            }
        }
        $bifurcation =[
            'appId'                     =>  $request['appId'],
            'id'                        =>  $request['id'],
            'name'                      =>  $request['name'],
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
            'class1'                    =>  $request['class'],
            'stream1'                   =>  $request['stream'],
            'parent_id'                 =>  $request['parent_id'],
            'application_for'           =>  $request['application_for'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'],
            'application_type'          =>  $request['application_type'],
            'action_by'                 =>$this->userId(),
            'attachment_details'        =>   $attachment_details,
        ];
        // dd($bifurcation);
        $response_data= $this->apiService->createData('emis/organization/bifurcation/saveBifurcation', $bifurcation);

        //Work Flow Process (based on Public School Establishment)
        //get submitter role
        if($request['action_type']!="edit"){
            $workflowdet=json_decode($this->apiService->listData('system/getRolesWorkflow/submitter/'.$this->getRoleIds('roleIds')));
            // dd($workflowdet,$response_data);
            $screen_id="";
            $status="";
            $screen_name="";
            $app_role="";
            $service_name=json_decode($response_data)->data->establishment_type;

            foreach($workflowdet as $work){
                if($work->screenName==$request->application_for){
                    $screen_id=$work->SysSubModuleId;
                    $status=$work->Sequence;
                    $app_role=$work->SysRoleId;
                    $screen_name=$work->screenName;
                }
            }
            if($request->submit_type=="reject"){
                $status='0__submitterRejects';
            }

            $workflow_data=[
                'db_name'           =>$this->database_name,
                'table_name'        =>$this->table_name,
                'service_name'      =>'Bifurcation',//service name
                'name'              =>'Bifurcation',//service name
                'application_number'=>json_decode($response_data)->data->application_no,
                'screen_id'         =>$screen_id,
                'status_id'         =>$status,
                'remarks'           =>$request['remarks'],
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

    public function loadBifurcationForVerification($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=$this->apiService->createData('emis/common/updateTaskDetails',$update_data);

        //to check the data from the micro service
        //return $this->apiService->listData('emis/organization/bifurcation/loadBifurcationForVerification/'.$appNo);

        // $workflowstatus=$this->getCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $workflowstatus="";
        $screen_id="";
        $sequence="";
        $workflowstatus="";
        $workflowdet=json_decode($this->apiService->listData('system/getcurrentworkflowstatus/'.json_decode($updated_data)->data->screen_id.'/'.$this->getRoleIds('roleIds')));
        // dd($workflowdet);
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/bifurcation/loadBifurcationForVerification/'.$appNo));
        //dd($this->apiService->listData('emis/organization/bifurcation/loadBifurcationForVerification/'.$appNo));
        $service_name=$loadOrganizationDetails->data->establishment_type;
        // dd($service_name,$workflowdet);
        foreach($workflowdet as $work){
            //check with screen name and then type of organization
            // if($work->Sequence!=1 && strpos(strtolower($work->screenName),'merge')!==false && $work->Establishment_type==str_replace (' ', '_',strtolower($service_name))){
            //     $workflowstatus=$work->Status_Name;
            //     $screen_id=$work->SysSubModuleId;
            //     $sequence=$work->Sequence;
            // }
            if($work->Sequence!=1 && $work->screenName==$service_name){
                $workflowstatus=$work->Status_Name;
                $screen_id=$work->SysSubModuleId;
                $sequence=$work->Sequence;
            }
        }
        if($loadOrganizationDetails!=null){
            $loadOrganizationDetails->app_stage=$workflowstatus;
            $loadOrganizationDetails->screen_id=$screen_id;
            $loadOrganizationDetails->sequence=$sequence;
        }
        // dd($loadOrganizationDetails);
        // $loadOrganizationDetails->app_stage=$workflowstatus;
        return json_encode($loadOrganizationDetails);
    }

    public function updateBifurcationApplication(Request $request){
        //updating the work flow and status

        $org_status='Verified';
        $work_status=$request->sequence;
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
            'service_name'      =>$request->service_name,
            'application_number'=>$request->applicationNo,
            'screen_id'         =>$request->screen_id,//pulled while loading details for verification
            'status_id'         =>$work_status,//pulled while loading details for verification
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        // dd($workflow_data);
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);

        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $remarks = $request->remarks;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'BifurcationVerification';
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
                            'saveapplication_number'     =>  $request->applicationNo,
                            // 'remark'                 =>  $remarks[$index]
                        )
                    );
                }
            }
        }


        //change the following for each type of application

        $estd =[
            'status'                       =>   $org_status,
            'application_number'           =>   $request->applicationNo,
            'remarks'                      =>   $request->remarks,
            'user_id'                      =>   $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/organization/bifurcation/updateBifurcationDetails', $estd);
        // dd($response_data);
        return $work_response_data;

        // //Ugyen's old route
        // $response_data= $this->apiService->createData('emis/organization/bifurcation/updateBifurcation', $bifurcation);
        // return $work_response_data;
    }

    /**
     * Reopening
     */

    public function saveReopening(Request $request){
        $rules = [
            'name1'              =>  'required',
            'level1'             =>  'required',
            'category1'          =>  'required',
            'dzongkhag1'         =>  'required',
            'gewog1'             =>  'required',
            'chiwog1'            =>  'required',
            'location1'          =>  'required',
            // 'senSchool1'         =>  'required',
        ];
        $customMessages = [
            'name1.required'         => 'Name is required',
            'level1.required'        => 'Level is required',
            'category1.required'     => 'Category is required',
            'dzongkhag1.required'    => 'Dzongkhag is required',
            'gewog1.required'        => 'Gewog is required',
            'chiwog1.required'       => 'Chiwog is required',
            'location1.required'     => 'Location Type is required',
            // 'senSchool1.required'    => 'SEN School is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $remarks = $request->remarks;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'re_opening';
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
                            'saveapplication_number'     =>  $request->applicationNo,
                            // 'remark'                 =>  $remarks[$index]
                        )
                    );
                }
            }
        }
        $reopening =[
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
            'class1'                    =>  $request['class'],
            'stream1'                   =>  $request['stream'],
            'parent_id'                 =>  $request['parent_id'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'],
            'application_type'          =>  $request['application_type'],
            'application_for'           =>  $request['application_for'],
            'attachment_details'        =>  $attachment_details,
            'action_by'                 =>$this->userId(),

        ];
        // dd($reopening);
        $response_data= $this->apiService->createData('emis/organization/reopening/saveReopening', $reopening);
        // dd($response_data);
        if($request['action_type']!="edit"){
            $workflowdet=json_decode($this->apiService->listData('system/getRolesWorkflow/submitter/'.$this->getRoleIds('roleIds')));
            // dd($workflowdet);
            $screen_id="";
            $status="";
            $screen_name="";
            $app_role="";

            foreach($workflowdet as $work){
                if($work->screenName==$request->application_for){
                    $screen_id=$work->SysSubModuleId;
                    $status=$work->Sequence;
                    $app_role=$work->SysRoleId;
                    $screen_name=$work->screenName;
                }
            }
            if($request->submit_type=="reject"){
                $status='0__submitterRejects';
            }

            $workflow_data=[
                'db_name'           =>$this->database_name,
                'table_name'        =>$this->table_name,
                'service_name'      =>$screen_name,
                'name'              =>'Reopening',//service name
                'application_number'=>json_decode($response_data)->data->application_no,
                'screen_id'         =>$screen_id,
                'status_id'         =>$status,
                'remarks'           =>$request['remarks'],
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

    public function loadReopeningForVerification($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=$this->apiService->createData('emis/common/updateTaskDetails',$update_data);

        // $workflowstatus=$this->getCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $workflowstatus="";
        $screen_id="";
        $sequence="";
        $workflowstatus="";
        $workflowdet=json_decode($this->apiService->listData('system/getcurrentworkflowstatus/'.json_decode($updated_data)->data->screen_id.'/'.$this->getRoleIds('roleIds')));
        // dd($workflowdet);
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/reopening/loadReopeningForVerification/'.$appNo));
        // dd($loadOrganizationDetails,$workflowdet);
        $service_name=$loadOrganizationDetails->data->establishment_type;
        foreach($workflowdet as $work){
            //check with screen name and then type of organization
            // if($work->Sequence!=1 && strpos(strtolower($work->screenName),'reopening')!==false && $work->Establishment_type==str_replace (' ', '_',strtolower($service_name))){
            //     $workflowstatus=$work->Status_Name;
            //     $screen_id=$work->SysSubModuleId;
            //     $sequence=$work->Sequence;
            // }
            if($work->Sequence!=1 && $work->screenName==$service_name){
                $workflowstatus=$work->Status_Name;
                $screen_id=$work->SysSubModuleId;
                $sequence=$work->Sequence;
            }
        }
        if($loadOrganizationDetails!=null){
            $loadOrganizationDetails->app_stage=$workflowstatus;
            $loadOrganizationDetails->screen_id=$screen_id;
            $loadOrganizationDetails->sequence=$sequence;
        }
        // dd($loadOrganizationDetails);
        // $loadOrganizationDetails->app_stage=$workflowstatus;
        return json_encode($loadOrganizationDetails);
    }

    /**
     * function to update the re-opening verification process
     */

    public function updateReopeningApplication(Request $request){
        //updating the work flow and status

        $org_status='Verified';
        $work_status=$request->sequence;
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
            'service_name'      =>$request->service_name,
            'application_number'=>$request->applicationNo,
            'screen_id'         =>$request->screen_id,//pulled while loading details for verification
            'status_id'         =>$work_status,//pulled while loading details for verification
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        // dd($workflow_data);
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);

        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $remarks = $request->remarks;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'ReopeningVerification';
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
                            'saveapplication_number'     =>  $request->applicationNo,
                            // 'remark'                 =>  $remarks[$index]
                        )
                    );
                }
            }
        }


        //change the following for each type of application

        $estd =[
            'status'                       =>   $org_status,
            'application_number'           =>   $request->applicationNo,
            'remarks'                      =>   $request->remarks,
            'attachment_details'           =>   $attachment_details,
            'user_id'                      =>   $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/organization/reopening/updateReopeningDetails', $estd);
        // dd($response_data);
        return $work_response_data;
    }

    public function loadOrganizationDetails(){
        $loadBifurcationDetails = $this->apiService->listData('emis/organization/bifurcation/loadBifurcation');
        return $loadBifurcationDetails;
    }

    // public function getOrgList(){
    //     $loadBifurcationDetails = $this->apiService->listData('emis/organization/getOrgList/'.$this->getUserDzoId());
    //     return $loadBifurcationDetails;
    // }


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
            // 'level'                       =>  'required',
            'organizationId'              =>  'required'
        ];
        $customMessages = [
            // 'level.required'                => 'New Level is required',
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
            'app_level_change_id'       =>  $request['app_level_change_id'],
            'user_id'                   =>  $this->userId()
        ];

        return $change;
    }

    private function setchangeofstream($request){
        $change =[
            'organizationId'            =>  $request['organizationId'],
            // 'level_change'              =>  $request['level_change'],
            // 'level'                     =>  $request['level'],
            // 'class'                     =>  $request['class'],
            'stream'                    =>  $request['streams'],
            'application_type'          =>  $request['application_type'],
            'application_for'           =>  $request['application_for'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'],
            'id'                        =>  $request['id'],
            'app_level_change_id'       =>  $request['app_level_change_id'],
            'changetype'                =>   $request->changetype,
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
            'change_id'                        =>  $request['change_id'],
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

    private function setAutonomous($request){
        $change =[
            'organizationId'            =>  $request['organizationId'],
            'isAutonomy'                =>  $request['isAutonomy'],
            'application_type'          =>  $request['application_type'],
            'application_for'           =>  $request['application_for'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];

        return $change;
    }

    private function setLocationChange($request){
        $change =[
            'organizationId'            =>  $request['organizationId'],
            'autonomuos'                =>  $request['autonomuos'],
            'locationType'              =>  $request['locationType'],
            'application_type'          =>  $request['application_type'],
            'application_for'           =>  $request['application_for'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];

        return $change;
    }

    private function setExtension($request){
        $change =[
            'organizationId'            =>  $request['organizationId'],
            'autonomuos'                =>  $request['autonomuos'],
            'currentCapacity'           =>  $request['currentCapacity'],
            'proposedCapacity'          =>  $request['proposedCapacity'],
            'application_for'           =>  $request['application_for'],
            'application_type'          =>  $request['application_type'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];

        return $change;
    }

    private function setFeeStructure($request){
        $change =[
            'organizationId'            =>  $request['organizationId'],
            'fees'                      =>  $request['fees'],
            'application_for'           =>  $request['application_for'],
            'application_type'          =>  $request['application_type'],
            'action_type'               =>  $request['action_type'],
            'status'                    =>  $request['status'],
            'id'                        =>  $request['id'],
            'user_id'                   =>  $this->userId()
        ];

        return $change;
    }

    private function setBoarding($request){
        $change =[
            'organizationId'            =>  $request['organizationId'],
            'isFeedingSchool'           =>  $request['isFeedingSchool'],
            'application_for'           =>  $request['application_for'],
            'application_type'          =>  $request['application_type'],
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
