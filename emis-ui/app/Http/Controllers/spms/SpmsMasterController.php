<?php

namespace App\Http\Controllers\spms;

use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use App\Traits\AuthUser;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;

class SpmsMasterController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveSpmMasters(Request $request){
        if($request['record_type'] == 'domain') {
            $rules = [
                'name'   =>  'required',
                'status' =>  'required',
            ];
            $customMessages = [
                'name.required'   => 'This field is required',
                'status.required' => 'This field is required',
            ];
        }
        if($request['record_type'] == 'area') {
            $rules = [
                'name'   =>  'required',
                'spm_domain_id'   =>  'required',
                'status' =>  'required',
            ];
            $customMessages = [
                'name.required'   => 'This field is required',
                'spm_domain_id.required'   => 'This field is required',
                'status.required' => 'This field is required',
            ];
        }
        if($request['record_type'] == 'parameter') {
            $rules = [
                'name'   =>  'required',
                'spm_area_id' =>  'required',
                'status' =>  'required',
            ];
            $customMessages = [
                'name.required'   => 'This field is required',
                'spm_area_id.required'   => 'This field is required',
                'status.required' => 'This field is required',
            ];
        }
        if($request['record_type'] == 'parameter') {
            $rules = [
                'name'   =>  'required',
                'spm_area_id' =>  'required',
                'status' =>  'required',
            ];
            $customMessages = [
                'name.required'   => 'This field is required',
                'spm_area_id.required'   => 'This field is required',
                'status.required' => 'This field is required',
            ];
        }
        if($request['record_type'] == 'indicator') {
            $rules = [
                'name'   =>  'required',
                'spm_parameter_id' =>  'required',
                'status' =>  'required',
            ];
            $customMessages = [
                'name.required'   => 'This field is required',
                'spm_parameter_id.required'   => 'This field is required',
                'status.required' => 'This field is required',
            ];
        }
        if($request['record_type'] == 'rating') {
            $rules = [
                'score'   =>  'required',
                'description'   =>  'required',
                'spm_indicator_id' =>  'required',
                'status' =>  'required',
            ];
            $customMessages = [
                'score.required'   => 'This field is required',
                'description.required'   => 'This field is required',
                'spm_indicator_id.required'   => 'This field is required',
                'status.required' => 'This field is required',
            ];
        }
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/masters/saveSpmMasters', $data);
        return $response_data;

    }
    public function loadSpmMasters($param=""){
        $global_masters = $this->apiService->listData('emis/masters/loadSpmMasters/'.$param);
        return $global_masters;
    }
}
