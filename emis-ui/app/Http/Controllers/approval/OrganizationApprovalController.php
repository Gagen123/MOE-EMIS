<?php

namespace App\Http\Controllers\approval;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
use App\Traits\ServiceHelper;
use App\Helper\EmisService;

class OrganizationApprovalController extends Controller{
    use AuthUser;
    use ServiceHelper;
    public $apiService;
    public $database_name="organization_db";
    public $table_name="application_details";
    public $service_name;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveEstablishment(Request $request){
        $rules = [
            'proposedName'          =>  'required',
            'gewog'                 =>  'required',
            'chiwog'                =>  'required',
            'parentSchool'          =>  'required',
            'locationType'         =>  'required',
        ];
        $customMessages = [
            'proposedName.required'         => 'Proposed Name is required',
            'gewog.required'                => 'Gewog is required',
            'chiwog.required'               => 'Chiwog is required',
            'parentSchool.required'         => 'Parent school is required',
            'locationType.required'        => 'locationType is required',
        ];

        if($request->establishment_type=="Coorporate ECCD"){
            $rules =$rules+ [
                'parentAgency'          =>  'required',
            ];
            $customMessages = $customMessages+[
                'parentAgency.required'         => 'Parent agency is required',
            ];
        }
        if($request->establishment_type=="Public ECCD" || $request->establishment_type=="NGO ECCD"){
            $rules =$rules+ [
                'initiatedBy'          =>  'required',
            ];
            $customMessages = $customMessages+[
                'initiatedBy.required'         => 'Proposed initiated by is required',
            ];
        }
        if($request->establishment_type=="Private ECCD"){
            $rules =$rules+ [
                'proprietorCid'         =>  'required',
                'proprietorName'         =>  'required',
                'proprietorMobile'         =>  'required',
            ];
            $customMessages = $customMessages+[
                'proprietorCid.required'        => 'CID is required',
                'proprietorName.required'        => 'Name is required',
                'proprietorMobile.required'        => 'Mobile number is required',
            ];
        }
        $this->validate($request, $rules, $customMessages);
        $request['user_id']=$this->userId();
        $response_data= $this->apiService->createData('emis/organization/organizationApproval/saveEstablishment', $request->all());
        // dd($response_data);
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
        $request->user_id=$this->userId();
        $response_data= $this->apiService->createData('emis/organization/organizationApproval/saveClassStream', $request->all());
        return $response_data;
    }

    public function saveUploadedFiles(Request $request){
        return $request;
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
        $response_data= $this->apiService->createData('emis/organization/organizationApproval/saveUploadedFiles', $request_data);

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


    public function getScreenId($serviceName=""){
        $workflowdet=$this->apiService->listData('system/getRolesWorkflow/screenId/'.$serviceName.'__'.$this->getRoleIds('roleIds'));
        return $workflowdet;
    }

    public function loadOrgApplications($type=""){
        $loadOrgApplications = $this->apiService->listData('emis/organization/organizationApproval/loadOrgApplications/'.$this->userId().'/'.$type );
        return $loadOrgApplications;
    }

    public function loadEstbDetailsForView($appNo="",$type=""){
        // dd($this->apiService->listData('emis/organization/organizationApproval/loadEstbDetailsForVerification/'.$appNo));
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/organizationApproval/loadEstbDetailsForVerification/'.$appNo));
        $current_status=$this->apiService->listData('emis/common/getTaskDetials/'.$appNo);
        if(isset($loadOrganizationDetails->data->app_verification_team) && sizeof($loadOrganizationDetails->data->app_verification_team)>0){
            foreach($loadOrganizationDetails->data->app_verification_team as $vteam){
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

    public function loadEstbDetailsForVerification($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $tasks=json_decode($this->apiService->listData('emis/common/getTaskDetials/'.$appNo));

        //condition for the dzongkhag to update task
        if($type!="NA"){ //user by view page at location
            if($this->getAccessLevel()=="Dzongkhag"){
                if($tasks->status_id==1 || $tasks->status_id==4){
                    $this->apiService->createData('emis/common/updateTaskDetails',$update_data);
                }
            }else{
                $this->apiService->createData('emis/common/updateTaskDetails',$update_data);
            }
        }

        $taskDetails=json_decode($this->apiService->listData('emis/common/getTaskDetials/'.$appNo));
        // $workflowstatus="";
        // $workflowdet=json_decode($this->apiService->listData('system/getcurrentworkflowstatus/'.json_decode($updated_data)->data->screen_id.'/'.$this->getRoleIds('roleIds')));

        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/organizationApproval/loadEstbDetailsForVerification/'.$appNo));
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
        $loadOrganizationDetails->app_stage=$taskDetails;
        //update notification
        if($type!="NA"){ //user by view page at location
            $notification_data=[
                'notification_appNo'            =>  $appNo,
                'dzo_id'                        =>  $this->getUserDzoId(),
                'working_agency_id'             =>  $this->getWrkingAgencyId(),
                'access_level'                  =>  $this->getAccessLevel(),
                'action_by'                     =>  $this->userId(),
            ];
            // dd($notification_data);
            $this->apiService->createData('emis/common/visitedNotification', $notification_data);
        }

        return json_encode($loadOrganizationDetails);
    }

    public function updateNewEstablishmentApplication(Request $request){
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
                        )
                    );
                }
            }
        }

        $org_status=$request->Status_Name;
        if($request->actiontype=="reject"){
            $org_status="Rejected";
        }
        if($request->actiontype=="approve"){
            $org_status="Approved";
        }
        if($request->update_type=="update_document"){
            $org_status="Updated Feasibility Study Report";
            $request->Status_Name=$org_status;
        }
        if($request->update_type=="final_update_document"){
            $org_status="Updated Final Assessment Report";
            $request->Status_Name=$org_status;
        }
        $estd =[
            'status'                       =>   $org_status,
            'application_number'           =>   $request->applicationNo,
            'id'                           =>   $request->id,
            'remarks'                      =>   $request->remarks,
            'verifying_agency'             =>   $request->verifying_agency,
            'verifying_agency_list'        =>   json_decode($request->verifying_agency_list),
            'final_verifying_agency_list'  =>   json_decode($request->final_verifying_agency_list),
            'tentative_date'               =>   $request->tentative_date,
            'final_tentative_date'         =>   $request->final_tentative_date,
            'feasibilityStudy_date'        =>   $request->feasibilityStudy_date,
            'final_assessment_date'         =>   $request->final_assessment_date,
            'update_type'                  =>   $request->update_type,
            'nomi_staffList'               =>   json_decode($request->nomi_staffList),
            'attachment_details'           =>   $attachment_details,
            'user_id'                      =>   $this->userId()
        ];
        // dd($estd);
        $response_data= $this->apiService->createData('emis/organization/organizationApproval/updateNewEstablishmentApplication', $estd);
        $workflow=$this->insertworkflow($request,$request->applicationNo);
        if($request->update_type!="update_document" && $request->update_type!="final_update_document"){
            if($request->update_type=="Notify_for_Tentative_Date_of_Feasibility_Study" || $request->update_type=="Update_Feasibility_Study_Report" || $request->update_type=="Notify_for_Approval_in_Principle"
            || $request->update_type=="Notify_for_Tentative_Date_of_Final_Assessment" || $request->update_type=="Update_Final_Assessment_Report" || strpos(strtolower($request->update_type),'final_approval')!==false || strpos(strtolower($request->update_type),'approve')!==false){
                $message='Notification for tentative date';
                $messat_to='creater';
                $message_type='user';
                $link='tasklist';
                $user_role_id=$request->created_by;
            }
            if($request->update_type=="Update_Sector_Clearance" || $request->update_type=="Request_for_Final_Assessment"){
                $seq=((int) $request->Sequence +1);
                // dd($this->apiService->listData('system/getRolesWorkflow/submittedTo/'.$request->screenId.'__'.$seq));
                $next_roleId=json_decode($this->apiService->listData('system/getRolesWorkflow/submittedTo/'.$request->screenId.'__'.$seq));
                $message='';
                $messat_to='role';
                $message_type='all';
                $link='tasklist';
                $user_role_id=$next_roleId[0]->SysRoleId;
            }
            $notification_data=[
                'notification_for'              =>  $request->service_name,
                'notification_appNo'            =>  $request->applicationNo,
                'notification_message'          =>  $message,
                'notification_type'             =>  $messat_to,
                'notification_access_type'      =>  $message_type,
                'call_back_link'                =>  $link,
                'user_role_id'                  =>  $user_role_id,
                'dzo_id'                        =>  $this->getUserDzoId(),
                'working_agency_id'             =>  $this->getWrkingAgencyId(),
                'access_level'                  =>  $this->getAccessLevel(),
                'action_by'                     =>  $this->userId(),
            ];
            // dd($notification_data);
            $this->apiService->createData('emis/common/insertNotification', $notification_data);
        }
        return $response_data;
    }

    public function updateTeamVerification(Request $request){
        $response_data= json_decode($this->apiService->listData('emis/common_services/StaffDetails/by_id/'.$request->staff_id));
        if($response_data!=null && $response_data!=""){
            $response_data=$response_data->data;
            $udpate_data =[
                'email'                         =>   $response_data->email,
                'type'                          =>   $request->type,
                'org_id'                        =>   $response_data->working_agency_id,
                'id'                            =>   $request->id,
                'name'                          =>   $response_data->name,
                'cid'                           =>   $response_data->cid_work_permit,
                'staff_type'                    =>   'Internal',
                'staff_id'                      =>   $request->staff_id,
                'applicationNo'                 =>   $request->applicationNo,
                'user_id'                       =>   $this->userId()
            ];
            $response_data= $this->apiService->createData('emis/organization/organizationApproval/updateTeamVerification', $udpate_data);
            return $response_data;
        }
    }

    public function loadTeamVerificationList($id=""){
        $response_data = $this->apiService->listData('emis/organization/organizationApproval/loadTeamVerificationList/'.$id);
        return $response_data;
    }

    public function saveLocationChange(Request $request){
        $rules = [
            'parentSchool'            =>  'required',
            'organizationId'          =>  'required',
            'gewog'                   =>  'required',
            'chiwog'                  =>  'required',
            'locationType'            =>  'required',
            'coLocatedParent'         =>  'required',

        ];
        $customMessages = [
            'parentSchool.required'    => 'Parent School is required',
            'organizationId.required'  => 'OrganizationId is required',
            'gewog.required'           => 'Gewog School is required',
            'chiwog.required'          => 'Chiwog School is required',
            'locationType.required'    => 'location Type is required',
            'coLocatedParent.required' => 'Co-Location with parent is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $application_number = $request->application_number;
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'LocationChange';
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
            'organizationId'                    =>  $request->organizationId,
            'dzongkhag'                         =>  $request->dzongkhag,
            'gewog'                             =>  $request->gewog,
            'chiwog'                            =>  $request->chiwog,
            'locationType'                      =>  $request->locationType,
            'category'                          =>  $request->category,
            'establishment_type'                =>  $request->establishment_type,
            'coLocatedParent'                   =>  $request->coLocatedParent,
            'parentSchool'                      =>  $request->parentSchool,
            'application_type'                  =>  $request->application_type,
            'status'                            =>  $request->status,
            'remarks'                           =>  $request->remarks,
            'attachment_details'                =>  $attachment_details,
            'user_id'                           =>  $this->userId()
        ];
        // dd($request_data);
        $response_data= $this->apiService->createData('emis/organization/organizationApproval/saveLocationChange', $request_data);
        $this->insertworkflow($request,json_decode($response_data)->application_no);
        $this->insertnotification($request,json_decode($response_data)->application_no);
        return $response_data;
    }
}
