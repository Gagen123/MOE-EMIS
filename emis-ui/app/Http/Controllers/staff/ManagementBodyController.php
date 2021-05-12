<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
class ManagementBodyController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveManagementBody(Request $request){
        $rules = [
            'body_type'                =>  'required',
            'from_date'                =>  'required',
            'to_date'                  =>  'required',
        ];
        $customMessages = [
            'body_type.required'      => 'This field is required',
            'from_date.required'      => 'This field is required',
            'to_date.required'        => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $mgmn_details =[
            'id'                =>  $request->id,
            'type'                =>  $request->type,
            'body_type'         =>  $request->body_type,
            'from_date'         =>  $request->from_date,
            'to_date'           =>  $request->to_date,
            'org'               =>  $this->getWrkingAgencyId(),
            'dzongkhag'         =>  $this->getUserDzoId(),
            'remarks'           =>  $request->remarks,
            'user_id'           =>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/managementBody/saveManagementBody', $mgmn_details);
        return $response_data;
    }


    public function saveManagementBodyComposition(Request $request){
        $rules = [
            'nonstaffname'                =>  'required',
            'designation'                =>  'required',
            'phone'                  =>  'required',
        ];
        $customMessages = [
            'nonstaffname.required'      => 'This field is required',
            'designation.required'      => 'This field is required',
            'phone.required'        => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $mgmn_details =[
            'management_id'      =>  $request->management_id,
            'emptye'            =>  $request->emptye,
            'nonstaffname'         =>  $request->nonstaffname,
            'designation'           =>  $request->designation,
            'phone'           =>  $request->phone,
            'email'           =>  $request->email,
            'address'           =>  $request->address,
            'fromdate'           =>  $request->fromdate,
            'todate'           =>  $request->todate,
            'org'               =>  $this->getWrkingAgencyId(),
            'dzongkhag'         =>  $this->getUserDzoId(),
            'user_id'           =>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/managementBody/saveManagementBodyComposition', $mgmn_details);
        return $response_data;
    }

    public function saveManagementMeeting(Request $request){
        $rules = [
            'meeting_date'   =>'required',
            'start_time'     =>'required',
            'end_time'       =>'required',
            'venue'          =>'required',
        ];
        $customMessages = [
            'meeting_date.required' =>'This field is required',
            'start_time.required'   =>'This field is required',
            'end_time.required'     =>'This field is required',
            'venue.required'        =>'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);

        $meeting_data =[
            'meeting_date'  =>$request->meeting_date,
            'start_time'    =>$request->start_time,
            'end_time'      =>$request->end_time,
            'venue'         =>$request->venue,
            'created_by'    =>$this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/managementBody/saveManagementMeeting', $meeting_data);
        return $response_data;
    }

    public function loadCurrentMeeting(){
        $response_data= $this->apiService->listData('emis/staff/managementBody/loadCurrentMeeting/'.$this->userId());
        return $response_data;
    }

    public function loadManagementBodyComposition($id=""){
        $response_data= $this->apiService->listData('emis/staff/managementBody/loadManagementBodyComposition/'.$id);
        return $response_data;
    }
    public function deleteManagementBodyComposition($id="",$itemId=""){
        $response_data= $this->apiService->listData('emis/staff/managementBody/deleteManagementBodyComposition/'.$id.'/'.$itemId);
        return $response_data;
    }

    public function updateManagementBody(Request $request){
        $mgmn_details =[
            'id'      =>  $request->id,
        ];
        $response_data= $this->apiService->createData('emis/staff/managementBody/updateManagementBody', $mgmn_details);
        return $response_data;
    }

    public function loadcreatedManagementBodyComposition(){
        $param=$this->getUserDzoId().'SSS'.$this->getWrkingAgencyId();
        $response_data= $this->apiService->listData('emis/staff/managementBody/loadcreatedManagementBodyComposition/'.$param);
        return $response_data;
    }

    public function loadcurrentbaord($id="",$itemId=""){
        $response_data= $this->apiService->listData('emis/staff/managementBody/loadcurrentbaord/'.$id);
        return $response_data;
    }


}
