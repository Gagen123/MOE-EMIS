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
            'code'          =>  'required',
        ];
        $customMessages = [
            'name.required'         => 'This field is required',
            'status.required'       => 'This field is required',
            'code.required'         => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request_data =[
            'id'                        =>  $request->id,
            'name'                      =>  $request->name,
            'code'                      =>  $request->code,
            'addfield_1'                =>  $request->addfield_1,
            'description'               =>  $request->description,
            'service_type'              =>  $request->service_type,
            'status'                    =>  $request->status,
            'action_type'               =>  $request->action_type,
            'model'                     =>  $request->model,
            'dzo_id'                    =>  $request->dzo_id,
            'type'                      =>  $request->type,
            'structureCategory'         =>  $request->structureCategory,
            'structuretype'             =>  $request->structuretype,
            'sportFacility'             =>  $request->sportFacility,
            'furnitureType'             =>  $request->furnitureType,
            'equipmentType'             =>  $request->equipmentType,
            'user_id'                   =>  $this->userId()
        ];
        //dd($request_data);
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
    public function saveNotificationConfigMasters(Request $request){
        $rules=[];
        $customMessages =[];
        $rules = [
            'service_id' => 'required',
            'submitter_role_id' => 'required',
            'notification_to_role_id' =>  'required',
        ];
        $customMessages = [
            'service_id.required' => 'This field is required',
            'submitter_role_id.required' => 'This field is required',
            'notification_to_role_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $data =[
            'id'                      =>  $request['id'],
            'service_id'              =>  $request['service_id'],
            'submitter_role_id'       =>  $request['submitter_role_id'],
            'notification_to_role_id' =>  $request['notification_to_role_id'],
            'action_type'             =>  $request['action_type'],
            'user_id'                 =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/organization/organizationMasterController/saveNotificationConfigMasters', $data);
        return $response_data;
    }


}
