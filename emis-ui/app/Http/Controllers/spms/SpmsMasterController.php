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
                'spm_domain_category_id' =>'required',
                'sequence_no' =>  'required',
                'status' =>  'required',
                'name' =>'required',
                'status' =>  'required',
            ];
            $customMessages = [
                'spm_domain_category_id.required' => 'This field is required',
                'name.required' => 'This field is required',
                'status.required' => 'This field is required',
                'sequence_no.required' => 'This field is required',
            ];
        }
        if($request['record_type'] == 'area') {
            $rules = [
                'sequence_no' =>  'required',
                'name'   =>  'required',
                'spm_domain_id'   =>  'required',
                'status' =>  'required',
            ];
            $customMessages = [
                'sequence_no.required'   => 'This field is required',
                'name.required'   => 'This field is required',
                'spm_domain_id.required'   => 'This field is required',
                'status.required' => 'This field is required',
            ];
        }
        if($request['record_type'] == 'parameter') {
            $rules = [
                'sequence_no' =>  'required',
                'name'   =>  'required',
                'spm_area_id' =>  'required',
                'status' =>  'required',
            ];
            $customMessages = [
                'sequence_no.required'   => 'This field is required',
                'name.required'   => 'This field is required',
                'spm_area_id.required'   => 'This field is required',
                'status.required' => 'This field is required',
            ];
        }
        if($request['record_type'] == 'parameter') {
            $rules = [
                'sequence_no' =>  'required',
                'name'   =>  'required',
                'spm_area_id' =>  'required',
                'status' =>  'required',
            ];
            $customMessages = [
                'sequence_no.required'   => 'This field is required',
                'name.required'   => 'This field is required',
                'spm_area_id.required'   => 'This field is required',
                'status.required' => 'This field is required',
            ];
        }
        if($request['record_type'] == 'indicator') {
            $rules = [
                'sequence_no' =>  'required',
                'name'   =>  'required',
                'spm_parameter_id' =>  'required',
                'status' =>  'required',
            ];
            $customMessages = [
                'sequence_no.required'   => 'This field is required',
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
    public function saveDzoEMO(Request $request){
        $rules = [
            'data.*.staff_id' => 'required',
            'data.*.dzon_id' => 'required'

        ];
        $customMessages = [
            'data.*.staff_id.required' => 'This field is required',
            'data.*.dzon_id.required' => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/masters/saveDzoEMO', $data);
        return $response_data;
    }
    public function getDzoEMO(){
        $global_masters = $this->apiService->listData('emis/masters/getDzoEMO');
        return $global_masters;
    }
    public function saveSchoolDEO(Request $request){
        $rules = [
                'dzon_id' => 'required',
                'data.*.staff_id' => 'required',
                'data.*.school_id' => 'required'

            ];
            $customMessages = [
                'data.*.staff_id.required' => 'This field is required',
                'data.*.school_id.required' => 'This field is required',
                'dzon_id.required' => 'This field is required',
            ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/masters/saveSchoolDEO', $data);
        return $response_data;
    }
    public function getSchoolDEO(){
        $global_masters = $this->apiService->listData('emis/masters/getSchoolDEO');
        return $global_masters;
    }
    // public function loadEmdUsers(){
    //     $role_id=config('services.constant.emd_role_id');
    //     $emd_user = $this->apiService->listData('system/getemdusers/'.$role_id);
    //     return $emd_user;
    // }
}

