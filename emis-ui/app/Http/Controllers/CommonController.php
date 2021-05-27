<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

use App\Traits\AuthUser;
use Session;

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
        $w_status_screen=[];
        foreach($work_status as $i=> $work){
            if($work->Sequence>1){
                array_push($w_status_screen,$work->SysSubModuleId.'SSS'.($work->Sequence - 1));
            }
        }
        return $w_status_screen;
    }
    public function getTaskList($type=""){
        $work_status=$this->getApprovalWorkStatus();
        $param="NA";
        $param="";
        $param2="";
        if($type=="commonLeaveOthers"){
            $response_data= json_decode($this->apiService->listData('emis/staff/staffServices/getLeaveConfigDetails/'.$this->getRoleIds('roleIds')));
            // dd($response_data);
            if($response_data!=null){
                foreach($response_data as $work){
                    $param.=$work->role_id.'SSS'.$work->sequence.'SSS'.$work->leave_type_id.'SSS'.$work->submitter_role_id.'OUTSEP';
                }
            }
        }
        else{
            foreach($work_status as $work){
                $param.=$work.'OUTSEP';
            }
        }
        if($param!="NA"){
            $param2=$this->getAccessLevel().'SSS'.$this->getUserDzoId().'SSS'.$this->getWrkingAgencyId();
        }
        // dd($type.'/'.$this->userId().'/'.$param.'/'.$param2);
        $response_data=$this->apiService->getListData('emis/common/getTaskList/'.$type.'/'.$this->userId().'/'.$param.'/'.$param2);
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
}
