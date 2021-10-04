<?php

namespace App\Http\Controllers\staff;

use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
class StaffMasterController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStaffMasters(Request $request){
        $rules = [
            'name'                  =>  'required',
            'status'                =>  'required',
        ];
        $customMessages = [
            'name.required'                 => 'This field is required',
            'status.required'               => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $request['user_id'] = $this->userId();
        $response_data= $this->apiService->createData('emis/staff/staffMasterController/saveStaffMasters', $request->all());
        return $response_data;
    }

    public function loadStaffMasters($type="",$model=""){
        $response_data= $this->apiService->listData('emis/staff/staffMasterController/loadStaffMasters/'.$type.'/'.$model);
        return $response_data;
    }
}
