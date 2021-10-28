<?php

namespace App\Http\Controllers\staff;
use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use App\Traits\AuthUser;
use Illuminate\Http\Request;

class StaffOfficeorderController extends Controller{
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function submitApplication(Request $request){
        $rules = [
            'reason'              =>  'required',
        ];
        $customMessages = [
            'reason.required'     => 'Please mention reason',
        ];
        $this->validate($request, $rules,$customMessages);

        $request['user_id'] = $this->userId();
        $response_data= $this->apiService->createData('emis/staff/staffOfficeorderController/submitApplication', $request->all());
        return $response_data;
    }

    public function checkOngoingApplication($type=""){
        $response_data= $this->apiService->listData('emis/staff/staffOfficeorderController/checkOngoingApplication/'.$type.'__'.$this->userId());
        return $response_data;
    }

    public function loadCreatedApplication($type=""){
        $response_data= $this->apiService->listData('emis/staff/staffOfficeorderController/loadCreatedApplication/'.$type.'__'.$this->userId());
        return $response_data;
    }

    public function loadCreatedApplicationForVerification($type=""){
        $response_data= $this->apiService->listData('emis/staff/staffOfficeorderController/loadCreatedApplicationForVerification/'.$type);
        return $response_data;
    }

    public function loadDetForVerification($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffOfficeorderController/loadDetForVerification/'.$id);
        return $response_data;
    }

    public function verifyApprove(Request $request){
        $request['user_id'] = $this->userId();
        $response_data= $this->apiService->createData('emis/staff/staffOfficeorderController/verifyApprove', $request->all());
        return $response_data;
    }
}
