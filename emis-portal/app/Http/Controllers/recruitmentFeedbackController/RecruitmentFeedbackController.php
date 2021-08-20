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
            $response_data= $this->apiService->listData('emis/staff/staffLeadershipSerivcesController/getleadershipDetailsForFeedback/'.json_decode($appNo)->std_id);
            return $response_data;
        }
    }

    public function saveFeedback(Request $request){
        $request_data =[
            'feedback_id'               =>  $request->feedback_id,
            'application_number'        =>  $request->application_number,
            'selection_type_id'         =>  $request->selection_type_id,
            'position_title_id'         =>  $request->position_title_id,
            'questionList'              =>  $request->questionList,
            'user_id'                   =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/staffLeadershipSerivcesController/saveFeedback', $request_data);
        // $notification_data=[
        //     'notification_appNo'            =>  $request->application_number,
        //     'dzo_id'                        =>  $this->getUserDzoId(),
        //     'working_agency_id'             =>  $this->getWrkingAgencyId(),
        //     'access_level'                  =>  $this->getAccessLevel(),
        //     'action_by'                     =>  $this->userId(),
        // ];
        // $this->apiService->createData('emis/common/visitedNotification', $notification_data);
        return $response_data;
    }

}
