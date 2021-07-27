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
        // // $headers = ['Content-Type: application/pdf'];
        // $headers = array(
        //     'Content-Type: application/pdf',
        // );
        // $file_name = explode('/',$full_path);
        // $finel_name = end($file_name);
        return response()->download($full_path);
        // header("Content-Disposition: inline; filename=filename.pdf");
        //@readfile($full_path);

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
        // $w_status_screen=[];
        // foreach($work_status as $i=> $work){
        //     if($work->Sequence>1){
        //         array_push($w_status_screen,$work->SysSubModuleId.'SSS'.($work->Sequence - 1).'SSS'.$work->Establishment_type);
        //     }
        // }
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
        $response_data=$this->apiService->createData('emis/common/getTaskList',$data);
        $leave_config_data= json_decode($this->apiService->listData('emis/staff/staffServices/getLeaveConfigDetails/'.$this->getRoleIds('roleIds')));
        $tr_data= json_decode($this->apiService->listData('emis/staff/transfer/getTransferConfigDetails/'.$this->getRoleIds('roleIds')));
        // $tr_data= json_decode($this->apiService->listData('emis/staff/staffServices/getTransferConfigDetails/'.$this->getRoleIds('roleIds')));

        if(config('services.constant.deo_role_id')!=null && strpos($this->getRoleIds('roleIds'),config('services.constant.deo_role_id'))!==false){
            $approved_transfer_data="Valid";//pull approved Transfer application only for DEO role
        }
        else{
            $approved_transfer_data="Invalid";
        }

        if(config('services.constant.hrd_role_id')!=null && strpos($this->getRoleIds('roleIds'),config('services.constant.hrd_role_id'))!==false){
            $leadership_data="Valid";//pull leadership application only for HRD role
        }
        else{
            $leadership_data="Invalid";
        }
        $task_data=$data+[
            'work_status'               =>  $approval_response_data,
            'leave_config_data'         =>  $leave_config_data,
            'tr_config_data'            =>  $tr_data,
            'leadership_config_data'    =>  $leadership_data,
            'approved_transfer_data'    =>  $approved_transfer_data,
        ];
        // dd( $task_data);
        $response_data=$this->apiService->createData('emis/common/getTaskList',$task_data);
        // dd($response_data);
        return $response_data;

    }

    public function getNotification(){
        // dd($this->getRoleIds('roleIds').'/'.$this->userId());
        $response_data=$this->apiService->getListData('emis/common/getNotification',$this->getRoleIds('roleIds').'/'.$this->userId());
        return $response_data;
    }
    public function getTaskcount(){
        $response_data= json_decode($this->apiService->listData('emis/staff/staffServices/getLeaveConfigDetails/'.$this->getRoleIds('roleIds')));
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

}
