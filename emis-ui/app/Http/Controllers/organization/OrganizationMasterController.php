<?php

namespace App\Http\Controllers\organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;

class OrganizationMasterController extends Controller{
    use AuthUser;
    use ServiceHelper;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveOrganizationMaster(Request $request){
        // dd($request);
        $rules = [
            'name'          =>  'required',
            'status'        =>  'required',
        ];
        $customMessages = [
            'name.required'         => 'This field is required',
            'status.required'       => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request_data =[
            'id'                        =>  $request->id,
            'name'                      =>  $request->name,
            'addfield_1'                =>  $request->addfield_1,
            'description'               =>  $request->description,
            'status'                    =>  $request->status,
            'action_type'               =>  $request->action_type,
            'model'                     =>  $request->model,
            'user_id'                   =>  $this->userId()
        ];
      //  dd($request_data);
        $response_data= $this->apiService->createData('emis/organization/organizationMasterController/saveOrganizationMaster', $request_data);
        return $response_data;
    }
    
    public function loadOrganizaitonmasters($type="",$model=""){
      //  dd('m here at UI');
        $type = $this->apiService->listData('emis/organization/organizationMasterController/loadOrganizaitonmasters/'.$type.'/'.$model);
        return $type;
    }
    public function loadFinacialtype(){
        $type = $this->apiService->listData('emis/organization/organizationMasterController/loadFinacialtype/');
        return $type;

    }
    public function loadincomeList(){
        $type = $this->apiService->listData('emis/organization/organizationMasterController/loadincomeList/');
        return $type;

    }
    
    
}
