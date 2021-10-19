<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use App\Traits\AuthUser;
use App\Helper\EmisService;
use Illuminate\Http\Request;
use App\Traits\ServiceHelper;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CommonController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function getRoles($param=""){
        $system = $this->apiService->listData('system/get_roles/'.$param);
        return $system;
    }

    public function viewFiles($full_path=""){
        $full_path=str_replace('SSS','/',$full_path);
        return response()->download($full_path);

    }

    public function deleteFile($full_path="",$id=""){
        $full_path=str_replace('SSS','/',$full_path);
        $headers = ['Content-Type: application/pdf'];
        $file_name = explode('/',$full_path);
        $finel_name = end($file_name);
        $response_data="";
        if (file_exists($full_path)){
            unlink($full_path);
            $response_data = $this->apiService->deleteData("emis/staff/hrdevelopment/deleteFile", $id);
        }
        return $response_data;
    }

    public function getApplicationDetials($applicationId=""){
        return $this->apiService->getListData('emis/common/getApplicationDetials/'.$applicationId);
    }
    public function getApprovalWorkStatus(){
        $work_status=json_decode($this->apiService->listData('system/getRolesWorkflow/verificationApproval/'.$this->getRoleIds('roleIds')));
        return $work_status;
    }
    public function getTaskList($type=""){
        $approval_response_data=$this->getApprovalWorkStatus();
        $data =[
            'access_level'          =>  $this->getAccessLevel(),
            'org'                   =>  $this->getWrkingAgencyId(),
            'dzongkhag'             =>  $this->getUserDzoId(),
            'user_id'               =>  $this->userId(),
            'type'                  =>  $type,
        ];
        // $response_data=$this->apiService->createData('emis/common/getTaskList',$data);
        $leave_config_data= json_decode($this->apiService->listData('emis/staff/staffServices/getLeaveConfigDetails/'.$this->getRoleIds('roleIds')));
        $tr_data= json_decode($this->apiService->listData('emis/staff/transfer/getTransferConfigDetails/'.$this->getRoleIds('roleIds')));

        if(config('services.constant.deo_role_id')!=null && strpos($this->getRoleIds('roleIds'),config('services.constant.deo_role_id'))!==false){
            $approved_transfer_data="Valid";

            //pull approved Transfer application only for DEO role
        }
        else{
            $approved_transfer_data="Invalid";
        }
        

        $leadership_data="Invalid";
        $approved_appeal_hrd_data="Invalid";
        $hrd_roles=config('services.constant.hrd_role_id');
        $hr_roles="";
        if(strpos($hrd_roles,',')!==false){
            $hr_roles=explode(',',$hrd_roles);
        }
        if(strpos($hrd_roles,',')!==false && sizeof($hr_roles)>1){
            foreach($hr_roles as $role){
                if($role!=null && strpos($this->getRoleIds('roleIds'),$role)!==false){
                    $leadership_data="Valid";
                    $approved_appeal_hrd_data="Valid"; //hrd appeal application
                }
            }
        }else{
            if($hrd_roles!=null && strpos($this->getRoleIds('roleIds'),$hrd_roles)!==false){
                $leadership_data="Valid";//pull leadership application only for HRD role
                $approved_appeal_hrd_data="Valid"; //hrd appeal application
            }
        }
        $task_data=$data+[
            'work_status'               =>  $approval_response_data,
            'leave_config_data'         =>  $leave_config_data,
            'tr_config_data'            =>  $tr_data,
            'approved_appeal_hrd_data'  =>  $approved_appeal_hrd_data,
            'leadership_config_data'    =>  $leadership_data,
            'approved_transfer_data'    =>  $approved_transfer_data,
            'access_level'              =>  $this->getAccessLevel(),
        ];
        $response_data=$this->apiService->createData('emis/common/getTaskList',$task_data);
        // dd($response_data);
        return $response_data;
    }

    public function getNotification(){
        $response_data=$this->apiService->getListData('emis/common/getNotification',$this->getRoleIds('roleIds').'/'.$this->userId());
        return $response_data;
    }
    public function getNotificationDetials($id=""){
        $response_data=$this->apiService->getListData('emis/common/getNotificationDetials',$id);
        $notification_data=[
            'notification_appNo'            =>  json_decode($response_data)->notification_appNo,
            'dzo_id'                        =>  $this->getUserDzoId(),
            'working_agency_id'             =>  $this->getWrkingAgencyId(),
            'access_level'                  =>  $this->getAccessLevel(),
            'action_by'                     =>  $this->userId(),
        ];
        $this->apiService->createData('emis/common/visitedNotification', $notification_data);
        return $response_data;
    }

    public function getSessionDetail($applicationId=""){
        if(Session::get('User_Details')!=""){
            return ['data' => Session::get('User_Details')];
        }
        else{
            $redirection_url=config('services.login.base_uri').'logout';
            return redirect()->away($redirection_url);
        }
    }

    public function getDzoNameById($id=""){
        return $this->apiService->getListData('emis/common/getDzoNameById/'.$id);
    }
    public function getGewogNameById($id=""){
        return $this->apiService->getListData('emis/common/getGewogNameById/'.$id);
    }

    public function getScreenAccess($type=""){
        $work_status=$this->apiService->getListData('system/getScreenAccess/'.$type.'/'.$this->getRoleIds('roleIds'));
        return $work_status;
    }

    public function releaseApplication($application_number=""){
        $work_status=$this->apiService->getListData('emis/common/releaseApplication/'.$application_number);
        return $work_status;
    }

    //Get Student List by orgId and OrgClassStream
    public function getStudentList($orgId,$orgClassStreamId){
        $data=$this->apiService->listData('emis/students/getStudentList/'.$orgId.'/'.$orgClassStreamId);
        return $data;
    }

    public function getscreens($type=""){
        $token =Session::get('User_Token');
        $headers['Authorization'] = 'bearer '. $token;
        $role_riv=$this->apiService->listData('getAllPrivilegesOnRoles/'.$type.'__'.$this->getRoleIds('roleIds').'__'.$this->currentUser()['system_id'], [], $headers);
        return $role_riv;
    }
    public function getEnvValues($type=""){
        return env($type);
    }

    //loading bifurcation organization
    public function loadRegisteredList($type){
        $response_data= $this->apiService->listData('emis/common_services/loadRegisteredList/'.$type);
        return $response_data;
    }

    public function loadParentOrgDetailOfRegistered($type="",$id=""){
        $response_data= $this->apiService->listData('emis/common_services/loadParentOrgDetailOfRegistered/'.$type.'/'.$id);
        return $response_data;
    }

    public function loadStaffList($org_id){
        $response_data= $this->apiService->listData('emis/common_services/loadStaffList/'.$org_id);
        return $response_data;
    }
    public function loadStudentListByOrgId($org_id){
        $response_data= $this->apiService->listData('emis/common_services/loadStudentListByOrgId/'.$org_id);
        return $response_data;
    }


}
