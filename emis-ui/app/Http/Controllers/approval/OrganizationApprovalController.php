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
        ];
        $customMessages = [
            'proposedName.required'         => 'Proposed Name is required',
            'gewog.required'                => 'Gewog is required',
            'chiwog.required'               => 'Chiwog is required',
        ];
        if($request->establishment_type=="ngo_eccd" || $request->establishment_type=="coorporate_eccd"){
            $rules =$rules+ [
                'parentSchool'          =>  'required',
            ];
            $customMessages = $customMessages+[
                'parentSchool.required'         => 'Parent school is required',
            ];
        }
        if($request->establishment_type=="coorporate_eccd"){
            $rules =$rules+ [
                'parentAgency'          =>  'required',
            ];
            $customMessages = $customMessages+[
                'parentAgency.required'         => 'Parent agency is required',
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
            $status=$request->Sequence;
            if($request->submit_type=="reject"){
                $status='0__submitterRejects';
            }
            $workflow_data=[
                'db_name'           =>$this->database_name,
                'table_name'        =>$this->table_name,
                'service_name'      =>$request->service_name,
                'name'              =>$request['proposedName'],
                'application_number'=>$application_number,
                'screen_id'         =>$request->screenId,
                'status_id'         =>$status,
                'app_role_id'       =>$request->SysRoleId,
                'remarks'           =>$request['remarks'],
                'user_dzo_id'       =>$this->getUserDzoId(),
                'access_level'      =>$this->getAccessLevel(),
                'working_agency_id' =>$this->getWrkingAgencyId(),
                'action_by'         =>$this->userId(),
            ];
            $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);

            //Notification preparation
            $seq=((int) $request->Sequence +1);
            $next_roleId=json_decode($this->apiService->listData('system/getRolesWorkflow/submittedTo/'.$request->screenId.'__'.$seq));
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


    public function getScreenId($serviceName=""){
        $workflowdet=$this->apiService->listData('system/getRolesWorkflow/screenId/'.$serviceName.'__'.$this->getRoleIds('roleIds'));
        return $workflowdet;
    }

    public function loadOrgApplications($type=""){
        $loadOrgApplications = $this->apiService->listData('emis/organization/organizationApproval/loadOrgApplications/'.$this->userId().'/'.$type );
        return $loadOrgApplications;
    }

    public function loadEstbDetailsForView($appNo=""){
        // dd($this->apiService->listData('emis/organization/organizationApproval/loadEstbDetailsForVerification/'.$appNo));
        $loadOrganizationDetails = json_decode($this->apiService->listData('emis/organization/organizationApproval/loadEstbDetailsForVerification/'.$appNo));
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
    public function loadEstbDetailsForVerification($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=$this->apiService->createData('emis/common/updateTaskDetails',$update_data);
        $workflowstatus="";
        $workflowdet=json_decode($this->apiService->listData('system/getcurrentworkflowstatus/'.json_decode($updated_data)->data->screen_id.'/'.$this->getRoleIds('roleIds')));

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
}
