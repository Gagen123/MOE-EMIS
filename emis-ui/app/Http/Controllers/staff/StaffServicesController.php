<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
class StaffServicesController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStaffAward(Request $request){
        $rules = [
            'staff'             =>  'required',
            'award_category'    =>  'required',
            'award_given_by'    =>  'required',
            'award_type_id'     =>  'required',
            'place'             =>  'required',
            'date'              =>  'required',
        ];
        $customMessages = [
            'staff.required'            => 'This field is required',
            'award_category.required'   => 'This field is required',
            'award_given_by.required'   => 'This field is required',
            'award_type_id.required'    => 'This field is required',
            'date.required'             => 'This field is required',
            'place.required'            => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $staff_data =[
            'id'                         =>  $request->id,
            'staff'                      =>  $request->staff,
            'award_category'             =>  $request->award_category,
            'award_given_by'             =>  $request->award_given_by,
            'award_type_id'              =>  $request->award_type_id,
            'date'                       =>  $request->date,
            'place'                      =>  $request->place,
            'remarks'                    =>  $request->remarks,
            'coursetitle'                =>  $request->coursetitle,
            'action_type'                =>  $request->action_type,
            'user_id'                    =>  $this->userId() 
        ];
        // dd($staff_data);
        $response_data= $this->apiService->createData('emis/staff/staffServices/saveStaffAward', $staff_data);
        return $response_data;
    }
    
    public function loadStaffAward(){
        $response_data= $this->apiService->listData('emis/staff/staffServices/loadStaffAward/'.$this->userId());
        return $response_data;
    }
    
    public function deleteStaffServices($type="",$id=""){
        $response_data= $this->apiService->listData('emis/staff/staffServices/deleteStaffServices/'.$type.'/'.$id);
        return $response_data;
    }
    
    public function saveStaffResponsibility(Request $request){
        $rules = [
            'staff'             =>  'required',
            'responsibility'    =>  'required',
        ];
        $customMessages = [
            'staff.required'            => 'This field is required',
            'responsibility.required'   => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $staff_data =[
            'id'                         =>  $request->id,
            'staff'                      =>  $request->staff,
            'responsibility'             =>  $request->responsibility,
            'remarks'                    =>  $request->remarks,
            'action_type'                =>  $request->action_type,
            'user_id'                    =>  $this->userId() 
        ];
        // dd($staff_data);
        $response_data= $this->apiService->createData('emis/staff/staffServices/saveStaffResponsibility', $staff_data);
        return $response_data;
    }
    
    public function loadStaffResponsibility(){
        $response_data= $this->apiService->listData('emis/staff/staffServices/loadStaffResponsibility/'.$this->userId());
        return $response_data;
    }
    
    public function saveStaffDisaplinary(Request $request){
        $rules = [
            'staff'                 =>  'required',
            'offence_date'          =>  'required',
            'offence_type_id'       =>  'required',
            'offence_severity_id'   =>  'required',
            'offence_action_id'     =>  'required',
        ];
        $customMessages = [
            'staff.required'                => 'This field is required',
            'offence_date.required'         => 'This field is required',
            'offence_type_id.required'      => 'This field is required',
            'offence_severity_id.required'  => 'This field is required',
            'offence_action_id.required'    => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $staff_data =[
            'id'                         =>  $request->id,
            'staff'                      =>  $request->staff,
            'offence_date'               =>  $request->offence_date,
            'offence_type_id'            =>  $request->offence_type_id,
            'offence_severity_id'        =>  $request->offence_severity_id,
            'offence_action_id'          =>  $request->offence_action_id,
            'offence_description'        =>  $request->offence_description,
            'description_on_action'      =>  $request->description_on_action,
            'action_type'                =>  $request->action_type,
            'user_id'                    =>  $this->userId() 
        ];
        // dd($staff_data);
        $response_data= $this->apiService->createData('emis/staff/staffServices/saveStaffDisaplinary', $staff_data);
        return $response_data;
    }
    
    public function loadStaffdisaplinary(){
        $response_data= $this->apiService->listData('emis/staff/staffServices/loadStaffdisaplinary/'.$this->userId());
        return $response_data;
    }
    
    public function saveStaffAttendance(Request $request){
        $staff_data =[
            'id'                        =>  $request->id,
            'year'                      =>  $request->year,
            'month'                     =>  $request->month,
            'remarks'                   =>  $request->remarks,
            'staffList'                 =>  $request->staffList,
            'org'                       =>  $this->getWrkingAgencyId(),
            'dzongkhag'                 =>  $this->getUserDzoId(),
            'action_type'                =>  $request->action_type,
            'user_id'                    =>  $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/staff/staffServices/saveStaffAttendance', $staff_data);
        return $response_data;
    }
    
    public function loadStaffattendance($dzo_id=""){
        // $param=$this->getAccessLevel().'SSS'.$this->getUserDzoId().'SSS'.$this->getWrkingAgencyId();
        $param=$dzo_id;
        $response_data= $this->apiService->listData('emis/staff/staffServices/loadStaffattendance/'.$param);
        return $response_data;
    }

    public function loadattendanceDetails($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffServices/loadattendanceDetails/'.$id);
        return $response_data;
    }
    public function checkAttendanceDetailsByDate($year="",$month=""){
        $response_data= $this->apiService->listData('emis/staff/staffServices/checkAttendanceDetailsByDate/'.$year."/".$month.'/'.$this->getWrkingAgencyId());
        return $response_data;
    }
    
}