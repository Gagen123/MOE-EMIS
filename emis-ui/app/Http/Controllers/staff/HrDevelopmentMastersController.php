<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
class HrDevelopmentMastersController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveHrDevelopmentMasters(Request $request){
        $rules = [
            'name'                  =>  'required',
            'code'                  =>  'required|numeric|digits:4',
            'status'                =>  'required',
        ];
        $customMessages = [
            'name.required'                 => 'This field is required',
            'code.required'                 => 'This field is required',
            'code.numeric'                  => 'The field must be numeric.',
            'code.digits'                   => 'The field should be of 4 digits.',
            'status.required'               => 'This field is required',
        ];
        if($request['record_type']=="project_donor_agency"){
            $rules=array_merge($rules,
                array('parent_field'  =>  'required',)
            );
            $customMessages=array_merge($customMessages,
                array('parent_field.required'  =>  'This field is required',)
            );
        }
        $this->validate($request, $rules,$customMessages);
        $data =[ 
            'id'                            =>  $request['id'],
            'parent_field'                  =>  $request['parent_field'],
            'name'                          =>  $request['name'],
            'status'                        =>  $request['status'],
            'code'                          =>  $request['code'],
            'actiontype'                    =>  $request['action_type'],
            'record_type'                   =>  $request['record_type'],
            'user_id'                       =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/masters/saveHrDevelopmentMasters', $data);
        return $response_data;
    }


    public function loadHrDevelopmentMastersData($type=""){
       
        $response_data= $this->apiService->listData('emis/masters/loadHrDevelopmentMastersData/'.$type);
        return $response_data;
    }
    
    public function loadHrDevelopmentDepedentMastersData($model="",$parent_id=""){
        $response_data = $this->apiService->listData('emis/masters/loadHrDevelopmentDepedentMastersData/'.$model."/".$parent_id);
        return $response_data;
    }
}
