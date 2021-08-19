<?php

namespace App\Http\Controllers\recruitmentFeedbackController;

use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use App\Traits\AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RecruitmentFeedbackController extends Controller{
    public $apiService;
    use AuthUser;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function loadData($param=""){
        $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/loadData/'.$param);
        return $response_data;
    }
    public function getapplicationDetailsForFeedback(){
        if(Session::get('User_details')!=null && Session::get('User_details')->id!=""){
            $appNo=$this->apiService->listData('getProtalUserDetails/'.$this->userId());
            $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/getleadershipDetailsForFeedback/'.json_decode($appNo)->appNo);
            return $response_data;
        }

    }
}
