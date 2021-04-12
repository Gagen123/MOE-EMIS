<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
use Session;

class CommonController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function viewFiles($full_path=""){
        $full_path=str_replace('SSS','/',$full_path);
        $headers = ['Content-Type: application/pdf'];
        $file_name = explode('/',$full_path);
        $finel_name = end($file_name);
        return response()->download($full_path, $finel_name, $headers);
        // $pdf = PDF::loadView('whateveryourviewname', $data);
        // return $pdf->stream('whateveryourviewname.pdf');
        
        // header("Content-type: application/pdf");
        // header("Content-Disposition: inline; filename=filename.pdf");
        // @readfile($full_path);
    }
    
    public function deleteFile($full_path="",$id=""){
        $full_path=str_replace('SSS','/',$full_path);
        $headers = ['Content-Type: application/pdf'];
        
        $file_name = explode('/',$full_path);
        $finel_name = end($file_name);
        $response_data="";
        if (file_exists($full_path)){
            unlink($full_path);
            $response_data = $this->apiService->deleteData("emis/staff/deleteFile", $id);
        }
        // dd($response_data);
        return $response_data;
    }
    
    public function getApplicationDetials($applicationId=""){
        return $this->apiService->getListData('emis/common/getApplicationDetials/'.$applicationId);
    }
    public function getTaskList($type=""){
        $work_status=$this->getVerificationApprovalWorkStatus();
        // dd($work_status);
        $param="";
        foreach($work_status as $work){
            $param.=$work.'OUTSEP';
        }
        // dd($param);
        $response_data=$this->apiService->getListData('emis/common/getTaskList/'.$type.'/'.$this->userId().'/'.$param);
        // dd($response_data);
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
    
}
